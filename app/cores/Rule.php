<?php

namespace App\cores;

class Rule
{
    protected $key;
    protected $value;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->sanitize();
    }

    public function sanitize()
    {
        $this->value = strip_tags($this->value);
        $this->value = htmlspecialchars($this->value);
        $this->value = stripcslashes($this->value);
        $this->value = trim($this->value);
    }
}