<?php

namespace App;

use App\Cart;
use App\Order;

class Payment
{
    private $cart;

    public function setCart(Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function pay($paymentGateway, $paymentToken, $input)
    {
        $charge = $paymentGateway->charge($this->cart->getTotalPriceInCents(), $paymentToken);
        $amount = $this->cart->getTotalPriceInCents() / 100;

        if (isset($input['use_delivery_address'])) {
            $input['billing_address_1'] = array_get($input, 'delivery_address_1', '');
            $input['billing_address_2'] = array_get($input, 'delivery_address_2', '');
            $input['billing_suburb']    = array_get($input, 'delivery_suburb', '');
            $input['billing_state']     = array_get($input, 'delivery_state', '');
            $input['billing_postcode']  = array_get($input, 'delivery_postcode', '');
        }

        $order = Order::create([
            'first_name'           => array_get($input, 'first_name', ''),
            'last_name'            => array_get($input, 'last_name', ''),
            'phone'                => array_get($input, 'phone', ''),
            'email'                => array_get($input, 'email', ''),
            'delivery_address_1'   => array_get($input, 'delivery_address_1', ''),
            'delivery_address_2'   => array_get($input, 'delivery_address_2', ''),
            'delivery_suburb'      => array_get($input, 'delivery_suburb', ''),
            'delivery_state'       => array_get($input, 'delivery_state', ''),
            'delivery_postcode'    => array_get($input, 'delivery_postcode', ''),
            'billing_address_1'    => array_get($input, 'billing_address_1', ''),
            'billing_address_2'    => array_get($input, 'billing_address_2', ''),
            'billing_suburb'       => array_get($input, 'billing_suburb', ''),
            'billing_state'        => array_get($input, 'billing_state', ''),
            'billing_postcode'     => array_get($input, 'billing_postcode', ''),
            'read_policy'          => (array_get($input, 'read_policy')) ? 1 : 0,
            'use_delivery_address' => (array_get($input, 'use_delivery_address')) ? 1 : 0,
            'payment_id'           => $charge['id'],
            'total_price'          => $amount,
        ]);
        $order->orderItems()->saveMany($this->cart->toOrderItems());
        return $order;
    }
}
