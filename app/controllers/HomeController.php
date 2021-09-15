<?php

namespace App\controllers;

use App\middlewares\Auth;
use App\models\User;
use Jenssegers\Blade\Blade;

class HomeController
{
    public $blade;
    public $authenticated = false;
    public $userTable;

    public function __construct($calledFunction)
    {
        $this->authenticated = Auth::requireLogin(array(
            'index', 'logout'), $calledFunction
        );
        $this->blade = new Blade('views', 'cache');
        $this->userTable = User::getInstance();
    }

    public function index()
    {
        $regions = $this->userTable->getRegions();
        echo $this->blade->render('dashboard', ['regions'=>$regions]);
    }

    public function login()
    {
        if ($this->authenticated) {
            redirect(base_url('dashboard'));
        }

        echo $this->blade->render('login');
    }

    public function handle_login()
    {
        if ($this->authenticated) {
            redirect(base_url('dashboard'));
        }

        $logged_in = $this->userTable->authenticate(array(
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ));

        if ($logged_in) {
            redirect(base_url('dashboard'));
        } else{
            redirect(base_url('login'));
        }
    }

    public function logout()
    {
        if ($this->authenticated) {
            session_destroy();
            redirect(base_url('login'));
        }
    }
}