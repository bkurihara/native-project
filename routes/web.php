<?php

use App\controllers\HomeController;
use App\controllers\UserController;
use App\cores\Route;

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
$page = getURISegment() ?? '/';

$routes = array(
    'GET' => array(
        '/' => HomeController::class,
        'login' => HomeController::class,
        'dashboard' => HomeController::class,
        'users' => [UserController::class, 'index']
    ),
    'POST' => array(
        'login' => HomeController::class,
        'users/edit' => [
            'class' => UserController::class,
            'method' => 'edit'
        ]
    )
);

if ($routes[$request_method][$page] ?? null) {
    Route::handleRequest($routes[$request_method][$page]);
} else
    echo 'Page Not Found';
