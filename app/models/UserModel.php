<?php

namespace App\models;

class UserModel extends Model
{

    private $table_name = 'users';

    public function get($ID)
    {
        try {
            $response = $this->db
                ->query("SELECT * FROM {$this->table_name} WHERE id = {$ID}")
                ->fetch();

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function insert($data)
    {
        try {
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
                ->execute($data);

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->db
                ->query("DELETE * FROM {$this->table_name} WHERE id = {$id}")
                ->execute(array($id));

            return $response;
        } catch (\Exception $error) {
            die(print_r($error));
        }
    }
}