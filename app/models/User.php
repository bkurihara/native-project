<?php

namespace App\models;

use PDO;

class User extends Model
{

    protected $table_name = 'users';

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function authenticate($credentials)
    {
        try {
            $user = $this->db
                ->query("SELECT * FROM {$this->table_name} WHERE email = '{$credentials['email']}'")
                ->fetchObject();

            if ($user) {
                if (password_verify($credentials['password'], $user->password)) {
                    $_SESSION['CREATED'] = time();
                    $_SESSION['user_id'] = $user->id;

                    return true; // user logged in
                } else
                    return false; // password doesn't match, user is not logged in
            } else
                return false; // user not found

        } catch (\Exception $error) {
            die(print_r($error));
        }
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

//            $response = $this->db
//                ->query("SELECT * FROM {$this->table_name} WHERE id = {$id}")
//                ->fetchObject();
            return $searchQuery->fetchObject();
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

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
                ->prepare("SELECT * FROM {$this->table_name} 
                                {$whereClause}
                                LIMIT {$data['start']},{$data['length']}");

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
        try {
            // remove password_confirmation from array and encrypt the pasword
            if (isset($data['password']) && isset($data['password_confirmation'])) {
                unset($data['password_confirmation']);
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            // prepare sql query for pdo to use
            // array('param1'=>'value1', 'param2'=>'value2') => 'param1, param2'
            $columnString = implode(',', array_keys($data));

            // array('param1'=>'value1', 'param2'=>'value2') => '?,?'
            $valueString = implode(',', array_fill(0, count($data), '?'));
            $response = $this->db->prepare("INSERT INTO {$this->table_name} ({$columnString}) VALUES ({$valueString})")
                ->execute(array_values($data));

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function update($id, $data)
    {
        try {
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
}