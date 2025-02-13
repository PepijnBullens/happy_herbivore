<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_english',
        'name_dutch',
        'name_german',
    ];

    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
