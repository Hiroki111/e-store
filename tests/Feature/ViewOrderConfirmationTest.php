<?php

namespace Tests;

use App\Billing\StripePaymentGateway;
use App\Bundle;
use App\Cart;
use App\Payment;
use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViewOrderConfirmationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canSeeTheOrderDetailsOnlyOnce()
    {
        $product = factory(Product::class)->create(['price' => 5.50]);
        $bundle  = factory(Bundle::class)->create(['price' => 10.00]);

        $this->post('/cart/add', [
            'type' => 'product', 'qty' => 1, 'itemId' => $product->hashed_id,
        ]);
        $this->post('/cart/add', [
            'type' => 'bundle', 'qty' => 2, 'itemId' => $bundle->hashed_id,
        ]);

        $paymentGateway = new StripePaymentGateway(config('services.stripe.secret'));

        $input = [
            'first_name'         => "John",
            'last_name'          => "Doe",
            'phone'              => "0411222333",
            'email'              => 'example@gmail.com',
            'delivery_address_1' => "George St 123",
            'delivery_address_2' => null,
            'delivery_suburb'    => "Brisbane",
            'delivery_state'     => "QLQ",
            'delivery_postcode'  => "4000",
            'billing_address_1'  => "King St 456",
            'billing_address_2'  => "Example Hills",
            'billing_suburb'     => "Sydney",
            'billing_state'      => "NSW",
            'billing_postcode'   => "2000",
            'read_policy'        => true,
            'cc_name'            => "JOHN DOE",
            'cc_number'          => "4242424242424242",
            'cc_expiration-mm'   => "01",
            'cc_expiration-yy'   => "25",
            'cc_cvv'             => "123",
        ];

        $cart    = (new Cart())->setItems(session('cart'));
        $payment = (new Payment())->setCart($cart);
        $order   = $payment->pay($paymentGateway, $paymentGateway->getValidTestToken(), $input);

        session(['justCompletedOrder' => true]);

        $res = $this->get("/confirmation/$order->hashed_id");

        $res->assertSee("$order->confirmation_number");
        $res->assertSee("$product->name");
        $res->assertSee("$" . $product->price);
        $res->assertSee("× 1");
        $res->assertSee($bundle->name);
        $res->assertSee("$" . $bundle->price * 2);
        $res->assertSee("× 2");
        $res->assertSee("Total: $" . $order->formatted_total_price);

        $res->assertSee("John Doe");
        $res->assertSee("0411222333");
        $res->assertSee("example@gmail.com");
        $res->assertSee("George St 123");
        $res->assertSee("Brisbane");
        $res->assertSee("QLQ");
        $res->assertSee("4000");
        $res->assertSee("King St 456");
        $res->assertSee("Example Hills");
        $res->assertSee("Sydney");
        $res->assertSee("NSW");
        $res->assertSee("2000");

        $res = $this->get("/confirmation/$order->hashed_id");
        $res->assertRedirect("/");
    }
}
