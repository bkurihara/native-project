<?php

namespace App\requests\rules;

class MatchPassword extends \App\cores\Rule
{
    public $message = null;

    public function check()
    {
        return $this->value === $_POST['password'];
    }

    public function getErrorMsg()
    {
        return "password does not match, please re-enter your password";
    }
}