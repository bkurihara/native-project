<?php

namespace App\cores;

use App\middlewares\Auth;
use App\models\User;
use Jenssegers\Blade\Blade;

class Controller
{
    public $blade;

    public function __construct()
    {
        $this->blade = new Blade('views', 'cache');
    }

}