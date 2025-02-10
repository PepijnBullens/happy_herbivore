<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderContent extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
