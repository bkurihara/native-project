<?php

namespace App\models;

use PDO;

class Model
{
    protected $db;

    protected static $instance;

    public function __construct()
    {
        $this->db = conn();
    }

}