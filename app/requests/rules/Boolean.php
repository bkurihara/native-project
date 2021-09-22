<?php

namespace App\requests\rules;

class Boolean extends \App\cores\Rule
{

    public function check()
    {
        return ($this->value == 1 || $this->value == 2) ?? false;
    }

    public function getErrorMsg()
    {
        return "The " . $this->key . " Value Is Not Correct";
    }
}