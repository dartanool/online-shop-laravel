<?php

namespace App\Http\Services;

use App\Models\UserProduct;

class CartService
{
    public function getSum(): int
    {
        $user = auth()->user();
        $total = 0;
        $userProducts = $user->userProducts()->get();
        foreach ($userProducts as $userProduct) {
            $total += $userProduct->amount * $userProduct->product->price;
        }
        return $total;
    }
}
