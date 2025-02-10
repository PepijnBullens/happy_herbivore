<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['id', 'order_id', 'order_started', 'order_successful', 'order_preparing', 'order_ready', 'order_picked_up'];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
