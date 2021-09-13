<?php

use App\controllers\HomeController;
use App\controllers\UserController;
use App\cores\Route;


//GET URLs
Route::add('/', HomeController::class, 'index');
Route::add('/login', HomeController::class, 'login');
Route::add('/dashboard', HomeController::class, 'index');

Route::add('/users', UserController::class, 'create');
Route::add('/user/([0-9]*)', UserController::class, 'show');

// POST URLs
Route::add('/login', HomeController::class, 'login', 'post');

Route::add('/users', UserController::class, 'insert', 'post');
Route::add('/user/([0-9]*)/edit', UserController::class, 'update', 'post');
Route::add('/users/([0-9]*)/delete', UserController::class, 'destroy', 'post');


// Handle Page Not Found
Route::pathNotFound(function ($path) {
    header('HTTP/1.0 404 Not Found');
    echo 'Error 404 Path Not Found <br>';
});

// Handle Method Not Allowed
Route::methodNotAllowed(function ($path) {
    header('HTTP/1.0 405 Method Not Allowed');
    echo 'Error 405 Method Not Allowed<br>';
});

// Search For Matching URLs with Base URL /native-project
Route::run('/native-project');
