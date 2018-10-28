<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class RecommendedProduct extends Model
{
    protected $guarded = [];
    protected $dates   = ['date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function getProducts()
    {
        return self::all()->map(function ($recommendedProduct) {
            return $recommendedProduct->product;
        });
    }
}
