<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-up', [UserController::class, 'getSignUpForm']);
Route::get('/login', [UserController::class, 'getSignUpForm']);

Route::post('/sign-up', [UserController::class, 'signUp']);
