<?php

namespace Tests;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class viewPaymetTest extends TestCase
{
    use DatabaseMigrations;

    private function validParams($overrides = [])
    {
        return array_merge([
            'first-name'           => "John",
            'last-name'            => "Doe",
            'phone'                => 0411222333,
            'email'                => 'example@gmail.com',
            'delivery-address-1'   => "George St 123",
            'delivery-suburb'      => "Brisbane",
            'delivery-state'       => "QLQ",
            'delivery-postcode'    => "4000",
            'read-policy'          => true,
            'use-delivery-address' => true,
            'cc-name'              => "JOHN DOE",
            'cc-number'            => "4242424242424242",
            'cc-expiration-mm'     => "01",
            'cc-expiration-yy'     => "25",
            'cc-cvv'               => "123",
        ], $overrides);
    }

    /** @test */
    public function canSubmit()
    {
        $product1 = factory(Product::class)->create();

        $this->post('/cart/add', [
            'type'   => 'products',
            'itemId' => $product1->hashed_id,
            'qty'    => 2,
        ]);
        $expected = ['products' => [$product1->hashed_id => 2]];
        $this->assertEquals(session('cart'), $expected);

        $response = $this->from('/payment')->post('/payment', $this->validParams());

        $response->assertRedirect('/confirmation');
        $order = Order::find(1);
        $this->assertEquals($order->total_price, 2 * $product->price);
        $this->assertEquals($order->first_name, 'John');
        $this->assertEquals($order->last_name, 'Doe');
        $this->assertEquals($order->phone, 0411222333);
        $this->assertEquals($order->email, 'example@gmail.com');
        $this->assertEquals($order->delivery_address_1, "George St 123");
        $this->assertEquals($order->delivery_suburb, "Brisbane");
        $this->assertEquals($order->delivery_state, "QLQ");
        $this->assertEquals($order->delivery_postcode, "4000");
        $this->assertEquals($order->billing_address_1, "George St 123");
        $this->assertEquals($order->billing_suburb, "Brisbane");
        $this->assertEquals($order->billing_state, "QLQ");
        $this->assertEquals($order->billing_postcode, "4000");

        $this->assertEquals(session('cart'), []);
    }

    /** @test */
    public function UseDeliveryOrBillingAddressIsRequired()
    {
        $product1 = factory(Product::class)->create();
        $this->post('/cart/add', [
            'type'   => 'products',
            'itemId' => $product1->hashed_id,
            'qty'    => 2,
        ]);
        $expected = ['products' => [$product1->hashed_id => 2]];
        $this->assertEquals(session('cart'), $expected);

        $response = $this->from('/payment')->post('/payment', $this->validParams([
            'use-delivery-address' => null,
        ]));

        $response->assertRedirect('/payment');
        $this->assertEquals(session('cart'), $expected);
    }

}
