<?php

namespace App;

use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use Price;

    protected $guarded = [];
    protected $dates   = ['date'];

    public static function getPriceRanges($ids)
    {
        return self::whereIn('id', $ids)
            ->get()
            ->groupBy(function ($product) {
                return bcdiv($product->price, 10);
            })
            ->sortKeys()
            ->values()
            ->map(function ($products) {
                return (object) [
                    'min' => bcdiv($products->first()->price, 10) * 10,
                    'max' => bcdiv($products->first()->price, 10) * 10 + 9.99,
                    'qty' => $products->count(),
                ];
            });

    }
}
