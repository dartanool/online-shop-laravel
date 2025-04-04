<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class, 'product_id');
    }
}
