<?php

namespace Tests;

use App\Jobs\SendOrderConfirmationEmail;
use App\Mail\OrderConfirmationEmail;
use App\Order;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendOrderConfirmationEmailTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canQueueOrderConfirmationEmail()
    {
        Mail::fake();
        $order = factory(Order::class)->create(['email' => 'blahblah@gmail.com']);

        SendOrderConfirmationEmail::dispatch($order);

        Mail::assertQueued(OrderConfirmationEmail::class, function ($mail) use ($order) {
            return $mail->hasTo('blahblah@gmail.com')
            && $mail->order->id === $order->id;
        });
    }
}
