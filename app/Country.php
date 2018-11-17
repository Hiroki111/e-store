<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    protected $dates   = ['date'];
    protected $appends = ['qty', 'url_safe_name'];

    public function getQtyAttribute()
    {
        return $this->attributes['qty'];
    }

    public function getUrlSafeNameAttribute()
    {
        return str_replace(" ", "-", $this->name);
    }

    public static function getIdsFromUrlSafeNames($countryNames)
    {
        $urlSafeNames = explode(',', $countryNames);
        $names        = array_map(function ($name) {
            return str_replace("-", " ", $name);
        }, $urlSafeNames);

        return self::whereIn('name', $names)->pluck('id');
    }

    public static function getWithQtyOfProducts($productTypeId)
    {
        $mapCountryIdToQty = Product::where('product_type_id', $productTypeId)
            ->get()
            ->groupBy('country_id')
            ->map(function ($products) {
                return $products->count();
            });

        return self::whereIn('id', $mapCountryIdToQty->keys())
            ->orderBy('name')
            ->get()
            ->map(function ($country) use ($mapCountryIdToQty) {
                $country->qty = $mapCountryIdToQty[$country->id];
                return $country;
            });
    }
}
