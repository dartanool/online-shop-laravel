<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Http\Services\CartService;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

    public function addToCart(ProductRequest $request)
    {
        $dto = $request->getDto();
        $this->cartService->addToCart($dto);

        return response()->redirectTo('catalog');
    }

    public function removeFromCart(ProductRequest $request)
    {
        $dto = $request->getDto();

        $this->cartService->removeFromCart($dto);

        return response()->redirectTo('catalog');


    }
}
