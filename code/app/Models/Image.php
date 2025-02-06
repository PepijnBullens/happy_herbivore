<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'path',
        'alt',
    ];

    protected $hidden = [
        'id',
        'imageable_id',
        'imageable_type',
        'updated_at',
        'created_at',
    ];

    public function imageable() 
    {
        return $this->morphTo();
    }
}
