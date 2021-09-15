<?php

namespace App\requests\rules;

use App\cores\Rule;

class KanjiKana extends Rule
{
    public function check()
    {
        return preg_match('/^[ぁ-んァ-ン一-龥]/', $this->value);
    }

    public function getErrorMsg()
    {
        return "This field only allows Kanjis and Kana";
    }
}