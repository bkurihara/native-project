<?php

namespace App\controllers;

use Jenssegers\Blade\Blade;

class UserController
{
    public $blade;

    public function __construct()
    {
        $this->blade = new Blade('views', 'cache');
    }

    public function index()
    {
        echo $this->blade->render('users.add');
    }

    public function create()
    {
        echo $this->blade->render('users.add');
    }

    public function show($request, $id)
    {
        echo $this->blade->render('users.edit', ['id' => $id]);
    }

    public function update()
    {
        echo $this->blade->render('users.edit');
    }

}