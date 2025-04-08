<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
// лена короли 2
// алина 5
class ProductController
{
    public function getCatalog()
    {
        $user = Auth::user();
        $products = Product::all();

        return view('catalogPage', ['products' => $products]);
    }

    public function getProduct(int $productId)
    {
        $product = Product::query()->find($productId);

        $reviews = Review::query()->where('product_id', $productId)->get();

        return view('productPage', ['product' => $product, 'reviews' => $reviews]);
    }

    public function addReview(ReviewRequest $request)
    {
        $userId = auth()->user()->id;

        Review::query()->create([
            'user_id' => $userId,
            'product_id' => $request->productId,
            'review_text' => $request->reviewText,
            'score' => $request->score
        ]);

        return response()->redirectTo('catalog');
    }
}
