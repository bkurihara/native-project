<?php

namespace App\models;

use App\cores\interfaces\CanAuthenticate;
use App\cores\interfaces\CanUploadImage;
use PDO;
use stdClass;

class User extends Model implements CanAuthenticate, CanUploadImage
{

    protected $table_name = 'users';

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getWhere($whereClauses)
    {
        try {
            $query = "SELECT * FROM {$this->table_name} WHERE ";
            foreach ($whereClauses as $clause) {
                $query = "{$query} {$clause[0]} {$clause[1]} '{$clause[2]}'";
            }
            $searchQuery = $this->db->prepare($query);
            $searchQuery->execute();

            return $searchQuery->fetchObject();
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    // Specifically for DataTables
    public function getAll($data)
    {
        try {
            $whereClause = "WHERE name LIKE '%{$data['name']}%' 
                        AND email LIKE '%{$data['email']}%'
                        AND gender LIKE '%{$data['gender']}%'
                        AND address1 LIKE '%{$data['address1']}%'";

            $countDataQuery = $this->db->prepare("SELECT count(*) FROM users");
            $countDataQuery->execute();
            $recordsTotal = $countDataQuery->fetchColumn();

            $countFilteredDataQuery = $this->db->prepare("SELECT count(*) FROM users {$whereClause}");
            $countFilteredDataQuery->execute();
            $recordsFiltered = $countFilteredDataQuery->fetchColumn();

            $query = $this->db
                ->prepare("SELECT id, name, gender, email, address1 FROM {$this->table_name}
                                {$whereClause}
                                ORDER BY {$data['column']} {$data['direction']} LIMIT {$data['start']},{$data['length']}");

            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_OBJ);

            return array("data" => $data,
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered);

        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function insert($data)
    {
        // remove password_confirmation from array and encrypt the pasword
        if (isset($data['password']) && isset($data['password_confirmation'])) {
            unset($data['password_confirmation']);
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        try {
            if (isset($data['photo'])) {
                $data['photo'] = $this->uploadImageAndGetPath($data['photo']);
            }
            $columnString = implode(',', array_keys($data));

            $valueString = implode(',', array_fill(0, count($data), '?'));
            $response = $this->db->prepare("INSERT INTO {$this->table_name} ({$columnString}) VALUES ({$valueString})")
                ->execute(array_values($data));
        } catch (\Exception $error) {
            $data['photo'] = "";

            $columnString = implode(',', array_keys($data));

            $valueString = implode(',', array_fill(0, count($data), '?'));
            $response = $this->db->prepare("INSERT INTO {$this->table_name} ({$columnString}) VALUES ({$valueString})")
                ->execute(array_values($data));
        }

        return $response;
    }

    public function update($id, $data)
    {
        try {
            $user = $this->getWhere(array(['id', '=', $id]));

            if (isset($data['password']) && isset($data['password_confirmation'])) {
                unset($data['password_confirmation']);
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            if (isset($data['photo'])) {
                $data['photo'] = $this->uploadImageAndGetPath($data['photo']);
                if (isset($user->photo)) {
                    unlink($user->photo);
                }
            }

            // prepare sql query for pdo to use
            // array('param1'=>'value1', 'param2'=>'value2') => 'param1=?, param2=?'
            $set = implode('=?, ', array_keys($data)) . '=?';
            $response = $this->db
                ->prepare("UPDATE {$this->table_name} SET {$set} WHERE id = {$id}")
                ->execute(array_values($data));

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function delete($id)
    {
        try {
            $user = $this->getWhere(array(['id', '=', $id]));
            if (isset($user->photo)) {
                unlink($user->photo);
            }
            $response = $this->db
                ->query("DELETE FROM {$this->table_name} WHERE id = {$id}");

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function getRegions()
    {
        return $this->db->query('select address1 from users group by address1')->fetchAll();
    }


    // INTERFACE IMPLEMENTATIONS


    public function authenticate($credentials)
    {
        $result = new stdClass();
        $result->authenticated = false;

        try {
            $user = $this->db
                ->query("SELECT * FROM {$this->table_name} WHERE email = '{$credentials['email']}'")
                ->fetchObject();

            // user with mentioned email found
            if ($user) {
                if (!isset($_SESSION['login_attempts'])) {
                    $_SESSION['login_attempts'] = 0;
                }
                $login_attempts = auth_session_mode() ? $_SESSION['login_attempts'] : $user->login_attempts;
                if ($login_attempts >= 3) {
                    if (auth_session_mode()) {
                        $result->error_message = 'Please close your browser and retry again';
                    } else {
                        $minutesPassed = floor((time() - strtotime($user->last_attempt)) / 60);
                        // clear login attempts and last attempt
                        if ($minutesPassed > 5) {
                            $user->login_attempts = 0;
                            $sql = 'UPDATE users SET login_attempts = 0, last_attempt = :last_attempt WHERE ( email = :email )';
                            $prepStatement = $this->db->prepare($sql);
                            $prepStatement->execute(array(':last_attempt' => null, ':email' => $user->email));
                        } else if ($minutesPassed < 5) {
                            $countdown = 5 - $minutesPassed;
                            $result->error_message = "Please try again $countdown minutes later";
                        }
                    }
                }
                if ($login_attempts < 3) {
                    // verify user password if password matches generate session for current user
                    if (password_verify($credentials['password'], $user->password)) {
                        $_SESSION['CREATED'] = time();
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                        $result->authenticated = true; // user logged in
                    } // password doesn't match, increment login attempt
                    else {
                        $sql = 'UPDATE users SET login_attempts = login_attempts + 1, last_attempt = :last_attempt WHERE ( email = :email )';
                        $prepStatement = $this->db->prepare($sql);
                        $prepStatement->execute(array(':last_attempt' => date("Y-m-d H:i:s"), ':email' => $user->email));
                        $_SESSION['login_attempts'] += 1;
                        $result->error_message = 'User not found';
                    }
                }
            } else
                $result->error_message = 'User not found';
            return $result;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function uploadImageAndGetPath($image)
    {
        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
        $fileNameAndPath = "public/images/" . time() . '.' . $extension;
        move_uploaded_file($image["tmp_name"], $fileNameAndPath);
        return $fileNameAndPath;
    }
}