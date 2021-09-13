<?php

namespace App\controllers;

use App\models\UserModel;
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
//        echo $this->blade->render('users.add');
    }

    public function insert()
    {
        $data = [
            'name' => $_POST['name'],
            'name_kana' => $_POST['name_kana'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'postal_code1' => $_POST['postal_code1'],
            'postal_code2' => $_POST['postal_code2'],
            'address1' => $_POST['address1'] ?? null,
            'address2' => $_POST['address2'] ?? null,
            'address3' => $_POST['address3'] ?? null,
            'phone' => $_POST['phone'] ?? null,
        ];

        $res = (new UserModel())->insert($data);
        redirect(base_url());
    }

    public function show($id)
    {
        $user = (new UserModel())->get($id);
        echo $this->blade->render('users.edit', ['user' => $user]);
    }

    public function update($id)
    {
        $user = (new UserModel());

        $userData = $user->get($id);

        $data = [
            'name' => $_POST['name'],
            'name_kana' => $_POST['name_kana'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'postal_code1' => $_POST['postal_code1'],
            'postal_code2' => $_POST['postal_code2'],
            'address1' => $_POST['address1'] ?? $userData['address1'],
            'address2' => $_POST['address2'] ?? $userData['address2'],
            'address3' => $_POST['address3'] ?? $userData['address3'],
            'phone' => $_POST['phone'] ?? $userData['phone'],
            'photo' => $_POST['photo'] ?? $userData['photo'],
        ];

        $user->update($id, $data);

        redirect(base_url());

    }

    public function destroy($id)
    {
        (new UserModel())->delete($id);

        redirect(base_url());
    }
}