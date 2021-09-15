<?php

namespace App\requests\rules;

class Boolean extends \App\cores\Rule
{

    public function check()
    {
        return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
    }

    public function getErrorMsg()
    {
        return "The " . $this->key . " Value Is Not Correct";
    }
}