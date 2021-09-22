<?php

namespace App\controllers;

use App\cores\Controller;
use App\models\User;
use App\requests\rules\Alpha;
use App\requests\rules\Boolean;
use App\requests\rules\Email;
use App\requests\rules\Numeric;
use App\requests\UserFormRequest;

class TestController extends Controller
{
    public function index()
    {
        echo $this->blade->render('errors.405');
    }
}