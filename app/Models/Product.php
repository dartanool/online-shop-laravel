<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function getAverageScore()
    {
        $sum = 0;
        $count = 0;
        foreach ($this->reviews()->get() as $review) {
            $sum += $review->score;
            $count++;
        }
        if ($count !== 0){
            $averageScore = $sum/$count;
        } else {
            $averageScore = $sum;
        }

        return round($averageScore,2);

    }
}
