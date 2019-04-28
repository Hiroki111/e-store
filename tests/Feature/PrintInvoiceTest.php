<?php

namespace Tests;

use App\Order;
use App\OrderItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PrintInvoiceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canPrintInvoice()
    {

        $expectedPdf = file_get_contents(base_path('tests/__fixtures__/order-confirmation.pdf'));

        $orderItemA = factory(OrderItem::class)->create([
            'price' => 63.50,
            'name'  => 'Aussie Wines',
            'type'  => 'bundle',
        ]);
        $orderItemB = factory(OrderItem::class)->create([
            'price' => 56.30,
            'name'  => 'Elna Whiskey',
            'type'  => 'product',
        ]);
        $orderItemC1 = factory(OrderItem::class)->create([
            'price' => 73.70,
            'name'  => 'Kenyon Whiskey',
            'type'  => 'product',
        ]);
        $orderItemC2 = factory(OrderItem::class)->create([
            'price' => 73.70,
            'name'  => 'Kenyon Whiskey',
            'type'  => 'product',
        ]);

        $order = factory(Order::class)->create([
            'first_name'         => 'John',
            'last_name'          => 'Doe',
            'delivery_address_1' => '123 Example St',
            'delivery_address_2' => 'Example Hills',
            'delivery_suburb'    => 'Brisbane',
            'delivery_state'     => 'QLD',
            'delivery_postcode'  => '4000',
            'billing_address_1'  => '123 Example St',
            'billing_address_2'  => 'Example Hills',
            'billing_suburb'     => 'Brisbane',
            'billing_state'      => 'QLD',
            'billing_postcode'   => '4000',
        ]);
        $order->orderItems()->saveMany([$orderItemA, $orderItemB, $orderItemC1, $orderItemC2]);

        $res = $this->get("/confirmation/$order->hashed_id/pdf");

        $res->assertStatus(200);
        // $expectedPdf = file_get_contents(base_path('tests/__fixtures__/order-confirmation.pdf'));
        // $actualPdf   = PDF::loadView('www.pdf.orderconfirmation', ['order' => $order])->stream('order-confirmation.pdf');
        // $this->assertSame(0, strcmp($expectedPdf, $actualPdf));
    }
}
