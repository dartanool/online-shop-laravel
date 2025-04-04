<?php

namespace App\Http\Controllers;


use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController
{

    public function getCart()
    {
        if(Auth::check()){
            $user = Auth::id();
            $userProducts = UserProduct::with('product')->where('user_id', $user)->get();

            return view('cartPage', compact('userProducts'));
        } else {
            redirect()->route('login');
        }
    }

    public function addToCart(Request $request)
    {
        if(Auth::check()) {
            $productId = $request->input('product_id');

            $userProduct = UserProduct::query()->where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($userProduct) {
                $userProduct->increment('amount');
            } else
                UserProduct::query()->create([
                    'user_id' => auth()->id(),
                    'product_id' => $productId,
                    'amount' => 1,
                ]);
            return response()->redirectTo('catalog');
        } else {

            redirect()->route('login');
        }
    }

    public function removeFromCart(Request $request)
    {
        if(Auth::check()) {
            $productId = $request->input('product_id');

            $userProduct = UserProduct::query()->where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->first();

            if ($userProduct['amount'] !== 1) {
                UserProduct::query()->where('user_id', auth()->id())->decrement('amount');
            } else {
                UserProduct::query()->where('user_id', auth()->id())->delete();
            }

            return response()->redirectTo('catalog');

        } else {
            redirect()->route('login');
        }
    }
}
