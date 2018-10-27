<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $guarded = [];
    protected $dates   = ['date'];

    public function user()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
