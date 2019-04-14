<?php

namespace Tests;

use App\Order;
use App\OrderItem;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canGetOrderSummary()
    {
        $orderItemA1 = factory(OrderItem::class)->create(['price' => 5.50, 'stock_id' => 1, 'type' => 'product']);
        $orderItemA2 = factory(OrderItem::class)->create(['price' => 5.50, 'stock_id' => 1, 'type' => 'product']);
        $orderItemB  = factory(OrderItem::class)->create(['price' => 8.00, 'stock_id' => 2, 'type' => 'product']);
        $orderItemC  = factory(OrderItem::class)->create(['price' => 50.00, 'stock_id' => 3, 'type' => 'bundle']);
        $order       = factory(Order::class)->create();
        $order->orderItems()->saveMany([$orderItemA1, $orderItemA2, $orderItemB, $orderItemC]);
        $orderSummary = $order->getOrderSummary();

        $this->assertEquals($orderSummary[0]->name, $orderItemA1->name);
        $this->assertEquals($orderSummary[0]->total_price, $orderItemA1->price * 2);
        $this->assertEquals($orderSummary[0]->qty, 2);

        $this->assertEquals($orderSummary[1]->name, $orderItemB->name);
        $this->assertEquals($orderSummary[1]->total_price, $orderItemB->price);
        $this->assertEquals($orderSummary[1]->qty, 1);

        $this->assertEquals($orderSummary[2]->name, $orderItemC->name);
        $this->assertEquals($orderSummary[2]->total_price, $orderItemC->price);
        $this->assertEquals($orderSummary[2]->qty, 1);
    }

    /** @test */
    public function canGetTotalPrice()
    {
        $orderItemA1 = factory(OrderItem::class)->create(['price' => 5.50, 'stock_id' => 1, 'type' => 'product']);
        $orderItemA2 = factory(OrderItem::class)->create(['price' => 5.50, 'stock_id' => 1, 'type' => 'product']);
        $orderItemB  = factory(OrderItem::class)->create(['price' => 8.00, 'stock_id' => 2, 'type' => 'product']);
        $orderItemC  = factory(OrderItem::class)->create(['price' => 50.00, 'stock_id' => 3, 'type' => 'bundle']);
        $order       = factory(Order::class)->create();
        $order->orderItems()->saveMany([$orderItemA1, $orderItemA2, $orderItemB, $orderItemC]);

        $expected = $orderItemA1->price + $orderItemA2->price + $orderItemB->price + $orderItemC->price;
        $this->assertEquals($order->getTotalPrice(), $expected);
    }
}
