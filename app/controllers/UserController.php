<?php

namespace App\controllers;

use App\middlewares\Auth;
use App\models\User;
use App\requests\rules\Alpha;
use App\requests\rules\Boolean;
use App\requests\rules\Email;
use App\requests\rules\Kana;
use App\requests\rules\KanjiKana;
use App\requests\rules\MatchPassword;
use App\requests\rules\Numeric;
use App\requests\rules\Password;
use App\requests\rules\Unique;
use App\requests\rules\UniqueExceptOwner;
use App\requests\UserFormRequest;
use Jenssegers\Blade\Blade;

class UserController
{
    public $blade;

    protected $userTable;

    public function __construct($calledFunction)
    {
        Auth::requireLogin('*', $calledFunction);
        $this->blade = new Blade('views', 'cache');
        $this->userTable = User::getInstance();
    }

    public function index()
    {
        $whereClause = array(
            'name' => $_POST['name'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'email' => $_POST['email'] ?? '',
            'address1' => $_POST['address1'] ?? '',
            'start' => $_POST['start'] ?? '',
            'length' => $_POST['length'] ?? '',
        );

        echo json_encode($this->userTable->getAll($whereClause));
    }

    public function create()
    {
        echo $this->blade->render('users.add');
    }

    public function insert()
    {
        $validation = UserFormRequest::getInstance()->validate([
            'name' => [KanjiKana::class],
            'name_kana' => [Kana::class],
            'gender' => [Boolean::class],
            'email' => [Email::class, Unique::class],
            'password' => [Password::class],
            'password_confirmation' => [MatchPassword::class],
            'postal_code1' => [Numeric::class, 'nullable'],
            'postal_code2' => [Numeric::class, 'nullable'],
            'address1' => [KanjiKana::class, 'nullable'],
            'address2' => [KanjiKana::class, 'nullable'],
            'address3' => [KanjiKana::class, 'nullable'],
            'phone' => [Numeric::class, 'nullable'],
        ]);

        if ($validation->errors()) {
            echo $this->blade->render('users.add', [
                'errors' => $validation->errors(),
                'old_data' => $_POST
            ]);
        } else {
            $this->userTable->insert($validation->validatedData());
            redirect(base_url());
        }
    }

    public function show($id)
    {
        $user = $this->userTable->getWhere(array(['id', '=', $id]));
        echo $this->blade->render('users.edit', ['user' => $user]);
    }

    public function update($id)
    {
        $validation = UserFormRequest::getInstance()->validate([
            'name' => [KanjiKana::class],
            'name_kana' => [Kana::class],
            'gender' => [Boolean::class],
            'email' => [Email::class, UniqueExceptOwner::class],
            'password' => [Password::class, 'nullable'],
            'password_confirmation' => [MatchPassword::class, 'nullable'],
            'postal_code1' => [Numeric::class, 'nullable'],
            'postal_code2' => [Numeric::class, 'nullable'],
            'address1' => [KanjiKana::class, 'nullable'],
            'address2' => [KanjiKana::class, 'nullable'],
            'address3' => [KanjiKana::class, 'nullable'],
            'phone' => [Numeric::class, 'nullable'],
        ]);

        if ($validation->errors()) {
            $user = $this->userTable->getWhere(array(['id', '=', $id]));
            echo $this->blade->render('users.edit', [
                'errors' => $validation->errors(),
                'old_data' => $_POST,
                'user' => $user
            ]);
        } else {
            $this->userTable->update($id, $validation->validatedData());
            redirect(base_url());
        }
    }

    public function destroy($id)
    {
        $this->userTable->delete($id);
    }
}