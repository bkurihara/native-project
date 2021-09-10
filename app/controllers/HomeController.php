<?php
namespace App\controllers;

use Jenssegers\Blade\Blade;

class HomeController
{
    public $blade;

    public function __construct()
    {
        $this->blade = new Blade('views', 'cache');
    }

    public function index()
    {
        echo $this->blade->render('dashboard');
    }

    public function login()
    {
        echo $this->blade->render('login');
    }
}