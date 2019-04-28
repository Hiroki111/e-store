<?php

namespace Tests;

use App\Mail\OrderConfirmationEmail;
use App\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrderConfirmationEmailTest extends TestCase
{
    use DatabaseMigrations;

    private function render($mailable)
    {
        $mailable->build();
        return view($mailable->view, $mailable->buildViewData())->render();
    }

    /** @test */
    public function hasTheCustomerAndOrderDetails()
    {
        $order    = factory(Order::class)->create();
        $email    = new OrderConfirmationEmail($order);
        $rendered = $this->render($email);

        $this->assertContains($order->formatted_total_price, $rendered);
        $this->assertContains($order->first_name, $rendered);
        $this->assertContains($order->last_name, $rendered);
        $this->assertContains($order->delivery_address_1, $rendered);
        $this->assertContains($order->delivery_address_2, $rendered);
        $this->assertContains($order->delivery_suburb, $rendered);
        $this->assertContains($order->delivery_state, $rendered);
        $this->assertContains($order->delivery_postcode, $rendered);
        $this->assertContains($order->getBillingAddress1(), $rendered);
        $this->assertContains($order->getBillingAddress2(), $rendered);
        $this->assertContains($order->getBillingSuburb(), $rendered);
        $this->assertContains($order->getBillingState(), $rendered);
        $this->assertContains($order->getBillingPostcode(), $rendered);
    }

    /** @test */
    public function hasTheRightSubject()
    {
        $order = factory(Order::class)->make();
        $email = new OrderConfirmationEmail($order);
        $this->assertEquals("Order Confirmation from Hiroki's Liquor", $email->build()->subject);
    }
}
