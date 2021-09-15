<?php

namespace App\requests\rules;

use App\cores\Rule;

class Password extends Rule
{
    public $message = null;

    public function check()
    {
        if (strlen($this->value) <= '8') {
            $this->message = "Your Password Must Contain At Least 8 Characters!";
        } elseif (!preg_match("#[0-9]+#", $this->value)) {
            $this->message = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $this->value)) {
            $this->message = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif (!preg_match("#[a-z]+#", $this->value)) {
            $this->message = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }

        return (!isset($this->message)) ?? false;
    }

    public function getErrorMsg()
    {
        return $this->message;
    }
}
