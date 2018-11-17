<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
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
        return str_replace(" ", "_", $this->name);
    }

    public static function getIdsFromUrlSafeNames($brandNames)
    {
        if (!$brandNames) {
            return null;
        }
        $urlSafeNames = explode(',', $brandNames);
        $names        = array_map(function ($name) {
            return str_replace("_", " ", $name);
        }, $urlSafeNames);

        return self::whereIn('name', $names)->pluck('id');
    }

    public static function getWithQtyOfProducts($ids)
    {
        $mapBrandIdToQty = Product::whereIn('id', $ids)
            ->get()
            ->groupBy('brand_id')
            ->map(function ($products) {
                return $products->count();
            });

        return self::whereIn('id', $mapBrandIdToQty->keys())
            ->orderBy('name')
            ->get()
            ->map(function ($brand) use ($mapBrandIdToQty) {
                $brand->qty = $mapBrandIdToQty[$brand->id];
                return $brand;
            });
    }
}
