<?php

namespace Tests;

use App\Billing\StripePaymentGateway;
use App\Bundle;
use App\Cart;
use App\Payment;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group online
 */
class PaymentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canPayAndReturnOrder()
    {
        $product = factory(Product::class)->create(['price' => 5.50]);
        $bundle  = factory(Bundle::class)->create(['price' => 10.00]);

        $this->post('/cart/add', ['type' => 'product', 'qty' => 1, 'itemId' => $product->hashed_id]);
        $this->post('/cart/add', ['type' => 'bundle', 'qty' => 2, 'itemId' => $bundle->hashed_id]);

        $paymentGateway = new StripePaymentGateway(config('services.stripe.secret'));

        $input = [
            'first_name'           => "John",
            'last_name'            => "Doe",
            'phone'                => 0411222333,
            'email'                => 'example@gmail.com',
            'delivery_address_1'   => "George St 123",
            'delivery_address_2'   => null,
            'delivery_suburb'      => "Brisbane",
            'delivery_state'       => "QLQ",
            'delivery_postcode'    => "4000",
            'read_policy'          => true,
            'use_delivery_address' => true,
            'cc_name'              => "JOHN DOE",
            'cc_number'            => "4242424242424242",
            'cc_expiration-mm'     => "01",
            'cc_expiration-yy'     => "25",
            'cc_cvv'               => "123",
        ];

        $payment = (new Payment())->setCart(new Cart(session('cart')));
        $order   = $payment->pay($paymentGateway, $paymentGateway->getValidTestToken(), $input);

        $this->assertEquals($order->total_price, 25.50);
        $this->assertEquals($order->first_name, 'John');
        $this->assertEquals($order->last_name, 'Doe');
        $this->assertEquals($order->phone, 0411222333);
        $this->assertEquals($order->email, 'example@gmail.com');
        $this->assertEquals($order->delivery_address_1, "George St 123");
        $this->assertEquals($order->delivery_address_2, "");
        $this->assertEquals($order->delivery_suburb, "Brisbane");
        $this->assertEquals($order->delivery_state, "QLQ");
        $this->assertEquals($order->delivery_postcode, "4000");
        $this->assertEquals($order->billing_address_1, "George St 123");
        $this->assertEquals($order->billing_address_2, "");
        $this->assertEquals($order->billing_suburb, "Brisbane");
        $this->assertEquals($order->billing_state, "QLQ");
        $this->assertEquals($order->billing_postcode, "4000");

        $this->assertEquals($order->orderItems->count(), 3);
    }
}
