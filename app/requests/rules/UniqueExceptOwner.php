<?php

namespace App\requests\rules;

use App\models\User;

class UniqueExceptOwner extends \App\cores\Rule
{
    public $message = null;

    public function check()
    {
        $data = User::getInstance()->getWhere(array(
            [$this->key, '=', $this->value]
        ));

        if ($data) {
            if ($data->id == $_POST['user_id'])
                return true; // the updating user owns the email
            else
                return false; // data exists, therefore not unique
        } else
            return true; // data doesn't exist, therefore unique
    }

    public function getErrorMsg()
    {
        return "{$this->key} already exists";
    }
}