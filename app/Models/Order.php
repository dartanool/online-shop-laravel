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

}
