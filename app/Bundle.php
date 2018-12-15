<?php

namespace App;

use App\Product;
use App\Traits\HashedId;
use App\Traits\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bundle extends Model
{
    use SoftDeletes;
    use Price;
    use HashedId;

    protected $guarded = [];
    protected $dates   = ['date'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_bundle', 'bundle_id', 'product_id');
    }

    public function getProductList()
    {
        return $this->products->groupBy('id')
            ->values()
            ->map(function ($products) {
                $qty       = $products->count();
                $packaging = $products->first()->packaging;
                return (object) [
                    'qty'         => $qty,
                    'packaging'   => ($qty > 1) ? $packaging . 's' : $packaging,
                    'src'         => $products->first()->src,
                    'name'        => $products->first()->name,
                    'description' => $products->first()->description,
                    'alcohol'     => $products->first()->alcohol,
                    'volume'      => $products->first()->volume,
                    'brand'       => $products->first()->brand,
                    'country'     => $products->first()->country,
                ];
            });
    }
}
