<?php

namespace App\cores\interfaces;

interface CanAuthenticate
{
    public function authenticate($credentials);
}