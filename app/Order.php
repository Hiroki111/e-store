<?php

namespace App;

use App\OrderItem;
use App\Traits\HashedId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    use HashedId;

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
            ->groupBy('type')
            ->map(function ($orderItems, $type) {
                return $orderItems
                    ->groupBy('stock_id')
                    ->map(function ($orderItems, $stockId) use ($type) {
                        $item = $orderItems->first();
                        $qty  = $orderItems->count();

                        return (object) [
                            'name'        => $item->name,
                            'price'       => $item->price,
                            'qty'         => $qty,
                            'type'        => $type,
                            'total_price' => number_format((double) $item->price * $qty, 2),
                        ];
                    });
            })->flatten()->values()->all();
    }

    public function getTotalItemPrice()
    {
        return collect($this->orderItems)->sum('price');
    }

    public function getFormattedTotalPriceAttribute()
    {
        return number_format((double) $this->total_price, 2);
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
