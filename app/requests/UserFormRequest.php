<?php

$errors = [];
$inputs = [];

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

if ($request_method === 'GET') {
    // show the form
    require __DIR__ . '/inc/get.php';
} elseif ($request_method === 'POST') {

// sanitize and validate name
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $inputs['name'] = $name;

    if ($name) {
        $name = trim($name);
        if ($name === '') {
            $errors['name'] = 'NAME_REQUIRED';
        }
    } else {
        $errors['name'] = 'NAME_REQUIRED';
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    echo test_input($_POST['name']);

// sanitize & validate email
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $inputs['email'] = $email;
    if ($email) {
        // validate email
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            $errors['email'] = 'EMAIL_INVALID';
        }
    } else {
        $errors['email'] = 'EMAIL_REQUIRED';
    }