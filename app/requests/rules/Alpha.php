<?php

namespace App\requests\rules;

use App\cores\Rule;

class Alpha extends Rule
{
    public function check()
    {
        return ctype_alpha($this->value);
    }

    public function getErrorMsg()
    {
        return "The " . $this->key . " Only Allows Alphabet Characters";
    }
}