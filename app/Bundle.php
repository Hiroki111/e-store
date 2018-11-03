<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bundle extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates   = ['date'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_bundle', 'bundle_id', 'product_id');
    }

    public function getDollarsAttribute()
    {
        return (int) $this->price;
    }

    public function getSentsAttribute()
    {
        return ($this->price - $this->dollars) * 100;
    }
}
