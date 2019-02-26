<?php

namespace Tests;

use App\Billing\PaymentFailedException;
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

    /**
     * @test
     * @doesNotPerformAssertions
     */
    public function cannotChargeWithAnInvalidPaymentToken()
    {
        $paymentGateway = new StripePaymentGateway(config('services.stripe.secret'));

        try {
            $paymentGateway->charge(2500, 'invalid');
        } catch (PaymentFailedException $e) {
            return;
        }

        $this->fail("Charging with an invalid token didn't throw PaymentFailedException");
    }

}
