<?php

namespace App\requests\rules;

use App\cores\Rule;
use App\models\User;

class Unique extends Rule
{
    public $message = null;

    public function check()
    {
        $data = User::getInstance()->getWhere(array(
            [$this->key, '=', $this->value]
        ));

        if ($data)
            return false; // data exists, therefore not unique
        else
            return true; // data doesn't exist, therefore unique
    }

    public function getErrorMsg()
    {
        return "{$this->key} already exists";
    }
}