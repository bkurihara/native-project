<?php

namespace App\controllers;

use App\cores\Controller;
use App\middlewares\Auth;
use App\models\User;

class HomeController extends Controller
{
    public $userTable;

    public function __construct($calledFunction)
    {
        parent::__construct();
        Auth::requireLogin(array(
            'index', 'logout'), $calledFunction
        );
        $this->userTable = User::getInstance();
    }

    public function index()
    {
        $regions = $this->userTable->getRegions();
        echo $this->blade->render('dashboard', ['regions' => $regions]);
    }

    public function login()
    {
        if (Auth::isLoggedIn()) {
            redirect(base_url('dashboard'));
        }

        echo $this->blade->render('login');
    }

    public function authenticate()
    {
        $user = $this->userTable->authenticate(array(
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ));

        if ($user->authenticated) {
            redirect(base_url('dashboard'));
        } else {
            echo $this->blade->render('login', ['error' => $user->error_message]);
        }
    }

    public function logout()
    {
        Auth::destroySession();
        redirect(base_url('login'));
    }
}