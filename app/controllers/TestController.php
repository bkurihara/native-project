<?php

namespace App\controllers;

use App\models\User;
use App\requests\rules\Alpha;
use App\requests\rules\Boolean;
use App\requests\rules\Email;
use App\requests\rules\Numeric;
use App\requests\UserFormRequest;

class TestController
{
    public function index()
    {
        $data = User::getInstance()->getWhere(array(
            ['id', '=', '34']
        ));



//        $validation = UserFormRequest::getInstance()->validate([
//            'name' => [Alpha::class],
//            'name_kana' => [Alpha::class],
//            'gender' => [Boolean::class],
//            'email' => [Email::class],
//            'postal_code1' => [Numeric::class, 'nullable'],
//            'postal_code2' => [Numeric::class, 'nullable'],
//            'address1' => [Alpha::class, 'nullable'],
//            'address2' => [Alpha::class, 'nullable'],
//            'address3' => [Alpha::class, 'nullable'],
//            'phone' => [Numeric::class, 'nullable'],
//        ]);
//        if ($validation->errors())
//            print_r($validation->errors());
//        else
//            print_r($validation->validatedData());
    }
}