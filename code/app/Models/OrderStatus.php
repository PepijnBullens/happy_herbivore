<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $fillable = ['order_started', 'order_successful', 'order_preparing', 'order_ready', 'order_picked_up'];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
