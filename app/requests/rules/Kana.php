<?php

namespace App\requests\rules;

class Kana extends \App\cores\Rule
{

    public function check()
    {
        return preg_match('/^[ぁ-んァ-ン]+$/', $this->value);
    }

    public function getErrorMsg()
    {
        return "This field only allows Kana";
    }
}