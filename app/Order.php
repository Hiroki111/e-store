<?php

namespace App;

use App\OrderItem;
use Carbon\Carbon;
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

    public function getOrderedDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('jS M Y');
    }

    public function getDeliveryDueAttribute()
    {
        return Carbon::parse($this->created_at)->addDays(5)->format('jS M Y');
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

    public function getBillingAddress1()
    {
        return ($this->use_delivery_address) ? $this->delivery_address_1 : $this->billing_address_1;
    }

    public function getBillingAddress2()
    {
        return ($this->use_delivery_address) ? $this->delivery_address_2 : $this->billing_address_2;
    }

    public function getBillingSuburb()
    {
        return ($this->use_delivery_address) ? $this->delivery_suburb : $this->billing_suburb;
    }

    public function getBillingState()
    {
        return ($this->use_delivery_address) ? $this->delivery_state : $this->billing_state;
    }

    public function getBillingPostcode()
    {
        return ($this->use_delivery_address) ? $this->delivery_postcode : $this->billing_postcode;
    }
}
