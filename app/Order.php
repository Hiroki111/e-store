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

    public function getOrderSummary()
    {
        return collect($this->orderItems)
            ->groupBy('stock_id')
            ->map(function ($orderItems, $stockId) {
                $item = $orderItems->first();
                $qty  = $orderItems->count();

                return (object) [
                    'name'        => $item->name,
                    'price'       => $item->price,
                    'qty'         => $qty,
                    'total_price' => number_format((double) $item->price * $qty, 2),
                ];
            })->values()->all();
    }

    public function getTotalPrice()
    {
        return collect($this->orderItems)->sum('price');
    }
}
