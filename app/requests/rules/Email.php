<?php

namespace App\requests\rules;

use App\cores\Rule;

class Email extends Rule
{

    public function check()
    {
        return filter_var($this->value, FILTER_VALIDATE_EMAIL);
    }

    public function getErrorMsg()
    {
        return "The " . $this->value . " is not a valid email address";
    }
}