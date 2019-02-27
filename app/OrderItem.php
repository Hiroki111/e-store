<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates   = ['date'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
