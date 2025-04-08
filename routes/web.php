<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/sign-up', [UserController::class, 'getSignUpForm'])->name('get.sign-up');
Route::get('/login', [UserController::class, 'getLoginForm'])->name('login');
Route::get('/catalog', [ProductController::class, 'getCatalog']);
Route::middleware('auth')->get('/cart', [CartController::class, 'getCart']);
Route::get('/logout', [UserController::class, 'logOut']);
Route::middleware('auth')->get('/user-profile', [UserController::class, 'getProfile']);
Route::middleware('auth')->get('/edit-user-profile', [UserController::class, 'getEditForm']);
Route::middleware('auth')->get('/create-order', [OrderController::class, 'getOrderForm']);
Route::middleware('auth')->get('/user-orders', [OrderController::class, 'getOrders']);

Route::post('/sign-up', [UserController::class, 'signUp'])->name('post.sign-up');
Route::post('/login', [UserController::class, 'logIn']);
Route::middleware('auth')->post('/add-product', [CartController::class, 'addToCart']);
Route::middleware('auth')->post('/decrease-product', [CartController::class, 'removeFromCart']);
Route::middleware('auth')->post('/edit-user-profile', [UserController::class, 'editProfile']);
Route::middleware('auth')->post('/product/{id}', [ProductController::class, 'getProduct']);
Route::middleware('auth')->post('/add-review', [ProductController::class, 'addReview']);
Route::middleware('auth')->post('/create-order', [OrderController::class, 'create'])->name('post.createOrder');
