<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'pickup_number'];

    public static function rules()
    {
        return [
            'pickup_number' => ['required', 'integer', 'between:1,99', 'regex:/^\d{2}$/'],
        ];
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderContents()
    {
        return $this->hasMany(OrderContent::class);
    }
}
