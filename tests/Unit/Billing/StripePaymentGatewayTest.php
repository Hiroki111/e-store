<?php

namespace Tests;

use App\Billing\StripePaymentGateway;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

/**
 * @group online
 */
class StripePaymentGatewayTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function canChargeWithAValidPaymentToken()
    {
        $paymentGateway = new StripePaymentGateway(config('services.stripe.secret'));

        $charge = $paymentGateway->charge(2500, $paymentGateway->getValidTestToken());

        $this->assertEquals(2500, $charge['amount']);
    }
}
