<?php

namespace App\requests\rules;

use App\cores\Rule;

class Numeric extends Rule
{

    /** @var string */
    protected $message = "The :attribute must be numeric";

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return Boolean
     */
    public function check()
    {
        return ctype_digit($this->value);
    }

    public function getErrorMsg(){
        return "The " . $this->key . " only allows numerical number";
    }
}