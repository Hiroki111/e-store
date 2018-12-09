<?php

namespace App;

use App\Brand;
use App\Country;
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

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function getRelevantItems($id)
    {
        $product = self::find($id);

        return self::where('product_type_id', $product->product_type_id)
            ->where('country_id', $product->country_id)
            ->where('id', '!=', $product->id)
            ->take(6)
            ->get();
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
