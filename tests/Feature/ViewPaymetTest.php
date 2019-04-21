<?php

namespace Tests;

use App\Billing\StripePaymentGateway;
use App\Order;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group online
 */
class ViewPaymetTest extends TestCase
{
    use DatabaseMigrations;

    private function validParams($overrides = [])
    {
        return array_merge([
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
            'payment_token'        => (new StripePaymentGateway(config('services.stripe.secret')))->getValidTestToken(),
        ], $overrides);
    }

    private function addItemToCart($type, $hashedId, $qty)
    {
        $this->post('/cart/add', [
            'type'   => $type,
            'itemId' => $hashedId,
            'qty'    => $qty,
        ]);
    }

    /** @test */
    public function canSubmit()
    {
        $this->withoutExceptionHandling();
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $this->addItemToCart('product', $product1->hashed_id, 2);
        $this->addItemToCart('product', $product2->hashed_id, 1);

        $response = $this->from('/payment')->post('/payment', $this->validParams());
        $response->assertStatus(302);

        $order      = Order::find(1);
        $orderItemA = $order->orderItems->first();
        $orderItemB = $order->orderItems->last();

        $response->assertRedirect("/confirmation/$order->hashedId");

        $this->assertEquals($order->total_price, 2 * $product1->price + $product2->price);
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
        $this->assertEquals($order->orderItems->count(), 3);

        $this->assertEquals($orderItemA->name, $product1->name);
        $this->assertEquals($orderItemA->type, 'product');
        $this->assertEquals($orderItemA->price, $product1->price);
        $this->assertEquals($orderItemA->stock_id, $product1->id);

        $this->assertEquals($orderItemB->name, $product2->name);
        $this->assertEquals($orderItemB->type, 'product');
        $this->assertEquals($orderItemB->price, $product2->price);
        $this->assertEquals($orderItemB->stock_id, $product2->id);

        $this->assertEquals(session('cart'), null);
    }

    /** @test */
    public function UseDeliveryOrBillingAddressIsRequired()
    {
        $product1 = factory(Product::class)->create();
        $this->addItemToCart('product', $product1->hashed_id, 2);

        $response = $this->from('/payment')->post('/payment', $this->validParams([
            'use_delivery_address' => null,
        ]));

        $response->assertRedirect('/payment');
        $this->assertEquals(session('cart'), ['product' => [$product1->hashed_id => 2]]);
    }

    /** @test */
    public function readPolicyIsRequired()
    {
        $product1 = factory(Product::class)->create();
        $this->addItemToCart('product', $product1->hashed_id, 2);

        $response = $this->from('/payment')->post('/payment', $this->validParams([
            'read_policy' => null,
        ]));

        $response->assertRedirect('/payment');
        $this->assertEquals(session('cart'), ['product' => [$product1->hashed_id => 2]]);
    }
}
