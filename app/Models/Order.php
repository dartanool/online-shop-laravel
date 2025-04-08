<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'contact_name',
        'contact_phone',
        'comment',
        'user_id',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getSum() : int
    {
        $sum = 0;
        foreach($this->orderProducts()->get() as $orderProduct)
        {
            $sum += $orderProduct->amount * $orderProduct->product->price;
        }

        return $sum;
    }

}
