<?php

namespace App;

use App\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates   = ['date'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
