<?php

namespace App;

use App\Brand;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

class Product extends Model
{
    use SoftDeletes;
    use Price;

    protected $guarded = [];
    protected $dates   = ['date'];
    protected $appends = ['hashed_id'];

    public function getHashedIdAttribute()
    {
        return Hashids::encode($this->id);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

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

    public static function getByHashedId($hashedId)
    {
        if (empty(Hashids::decode($hashedId))) {
            return null;
        }
        return self::find(Hashids::decode($hashedId)[0]);
    }

}
