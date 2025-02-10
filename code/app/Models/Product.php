<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name_dutch',
        'description_dutch',
        'name_english',
        'description_english',
        'name_german',
        'description_german',
        'price',
        'kcal',
        'available',
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
