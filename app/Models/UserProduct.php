<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class UserProduct extends Model
{
    /**
     * @property int $user_id
     * @property int $product_id
     * @property int $amount
     * @property int $totalSum
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'amount',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public static function addProductToCart(int $userId, int $productId, int $amount)
//    {
//        $userProduct = UserProduct::query()->where('user_id', $userId)->where('product_id', $productId)->first();
//
//        if ($userProduct) {
//            $userProduct->amount += $amount;
//            $userProduct->save();
//        } else {
//            $userProduct = UserProduct::query()->create([
//                'user_id' => $userId,
//                'product_id' => $productId,
//                'amount' => $amount,
//            ]);
//        }
//    }
}
