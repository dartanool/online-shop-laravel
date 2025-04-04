<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-up', [UserController::class, 'getSignUpForm']);
Route::get('/login', [UserController::class, 'getLoginForm']);
Route::get('/catalog', [ProductController::class, 'getCatalog']);
Route::get('/cart', [CartController::class, 'getCart']);
Route::get('/logout', [UserController::class, 'logOut']);
Route::get('/user-profile', [UserController::class, 'getProfile']);
Route::get('/edit-user-profile', [UserController::class, 'getEditForm']);

Route::post('/sign-up', [UserController::class, 'signUp']);
Route::post('/login', [UserController::class, 'logIn']);
Route::post('/add-product', [CartController::class, 'addToCart']);
Route::post('/decrease-product', [CartController::class, 'removeFromCart']);
Route::post('/edit-user-profile', [UserController::class, 'editProfile']);
Route::post('/product/{id}', [ProductController::class, 'getProduct']);
Route::post('/add-review', [ProductController::class, 'addReview']);
