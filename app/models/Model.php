<?php

namespace App\models;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = conn();
    }

    public function dbBoundQuery($sql, $values, $types = false) {
        $stmt = $this->db->prepare($sql);

        foreach($values as $key => $value) {
            if($types) {
                $stmt->bindValue(":$key",$value,$types[$key]);
            } else {
                if(is_int($value))        { $param = PDO::PARAM_INT; }
                elseif(is_bool($value))   { $param = PDO::PARAM_BOOL; }
                elseif(is_null($value))   { $param = PDO::PARAM_NULL; }
                elseif(is_string($value)) { $param = PDO::PARAM_STR; }
                else { $param = FALSE;}

                if($param) $stmt->bindValue(":$key",$value,$param);
            }
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}