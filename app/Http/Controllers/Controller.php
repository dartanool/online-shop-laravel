<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\OrderService;

abstract class Controller
{
    protected CartService $cartService;
    protected OrderService $orderService;

    public function __construct()
    {
        $this->cartService = new CartService();
        $this->orderService = new OrderService();
    }
}
