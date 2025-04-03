<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-up', [UserController::class, 'getSignUpForm']);
Route::get('/login', [UserController::class, 'getLoginForm']);
Route::get('/catalog', [ProductController::class, 'getCatalog']);

Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/login', [UserController::class, 'logIn']);
