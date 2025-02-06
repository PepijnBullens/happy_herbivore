<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderContent extends Model
{
    protected $table = 'order_content';
    protected $fillable = ['order_id', 'product_id', 'product_quantity', 'with_dip', 'extra_choices'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
