<?php

namespace App\Http\Services;

use App\DTO\IncrDecrAmountDTO;
use App\Models\UserProduct;

class CartService
{
    public function addToCart (IncrDecrAmountDTO $data)
    {
        $userId = auth()->id();
        $productId = $data->getProductId();

        $userProduct = UserProduct::query()->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($userProduct) {
            $userProduct->increment('amount');
        } else
            UserProduct::query()->create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => 1,
            ]);
    }

    public function removeFromCart(IncrDecrAmountDTO $data)
    {
        $productId = $data->getProductId();
        $userId = auth()->id();

        $userProduct = UserProduct::query()->where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

//        print_r($userProduct->amount);
//
//        exit();

        if ($userProduct->amount !== 1) {
            UserProduct::query()->where('user_id', $userId)
                ->where('product_id', $productId)->decrement('amount');
        } else {
            UserProduct::query()->where('user_id', $userId)
                ->where('product_id', $productId)->delete();
        }

    }

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
