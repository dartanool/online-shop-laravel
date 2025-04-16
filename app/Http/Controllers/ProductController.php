<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProductController
{
    public function index()
    {
        $products = Cache::remember('products_all', 3600, function () {
            return Product::all();
        });

        return view('productsPage', compact('products'));
    }

    public function store(Request $request)
    {
        Product::create($request->all());
        Cache::forget('products_all');

        return redirect()->route('productsPage')
            ->with('success', 'Продукт создан и кэш сброшен');
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        Cache::forget('products_all');

        return redirect()->route('productsPage')
            ->with('success', 'Продукт обновлён и кэш сброшен');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        Cache::forget('products_all');

        return redirect()->route('productsPage')
            ->with('success', 'Продукт удалён и кэш сброшен');
    }
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
