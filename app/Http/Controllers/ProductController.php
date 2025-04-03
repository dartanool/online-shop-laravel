<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController
{
    public function getCatalog()
    {

        $user = Auth::user();

        $products = Product::all();

//        print_r($products);

        return view('catalogPage', ['products' => $products]);


//        view('catalogPage');
    }
}
