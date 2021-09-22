<?php

use App\controllers\HomeController;
use App\controllers\TestController;
use App\controllers\UserController;
use App\cores\Route;
use Jenssegers\Blade\Blade;


//GET URLs
Route::addGet('/', HomeController::class, 'index');
Route::addGet('/login', HomeController::class, 'login');
Route::addGet('/logout', HomeController::class, 'logout');
Route::addGet('/dashboard', HomeController::class, 'index');

Route::addGet('/user', UserController::class, 'create');
Route::addGet('/user/([0-9]*)/edit', UserController::class, 'show');
Route::addGet('/user/([0-9]*)/delete', UserController::class, 'destroy');

// POST URLs
Route::addPost('/login', HomeController::class, 'authenticate');

Route::addPost('/user', UserController::class, 'insert');
Route::addPost('/users/get', UserController::class, 'index');
Route::addPost('/user/([0-9]*)/update', UserController::class, 'update');

Route::addGet('/test', TestController::class, 'index');


// Handle Page Not Found
Route::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    $blade = new Blade('views', 'cache');
    echo $blade->render('errors.405');
});

// Handle Method Not Allowed
Route::methodNotAllowed(function ($path) {
    header('HTTP/1.0 405 Method Not Allowed');
    $blade = new Blade('views', 'cache');
    echo $blade->render('errors.405');
});

// Search For Matching URLs with Base URL /native-project
Route::run('/native-project');
