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
}
