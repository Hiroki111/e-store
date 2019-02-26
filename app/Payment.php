<?php

namespace App;

use App\Bundle;
use App\Product;

class Payment
{
    private $items;

    public function setCart($items)
    {
        $this->items = $items;
        return $this;
    }

    public function setRequestInput($input)
    {
        $this->first_name           = array_get($input, 'first_name', '');
        $this->last_name            = array_get($input, 'last_name', '');
        $this->phone                = array_get($input, 'phone', '');
        $this->email                = array_get($input, 'email', '');
        $this->delivery_address_1   = array_get($input, 'delivery_address_1', '');
        $this->delivery_address_2   = array_get($input, 'delivery_address_2', '');
        $this->delivery_suburb      = array_get($input, 'delivery_suburb', '');
        $this->delivery_state       = array_get($input, 'delivery_state', '');
        $this->delivery_postcode    = array_get($input, 'delivery_postcode', '');
        $this->read_policy          = array_get($input, 'read_policy', '');
        $this->use_delivery_address = array_get($input, 'use_delivery_address', '');
        return $this;
    }

    public function pay($paymentGateway, $paymentToken)
    {
        $charge = $paymentGateway->charge($this->getTotalPrice(), $paymentToken);
    }

    public function getTotalPrice()
    {
        return collect($this->items)->map(function ($items, $type) {
            return collect($items)->map(function ($qty, $hashedId) use ($type) {
                $class = ($type === 'product') ? Product::class : Bundle::class;
                $item  = $class::find(decode_hash($hashedId));
                return $item->price * $qty * 100;
            })->sum();
        })->sum();
    }
}
