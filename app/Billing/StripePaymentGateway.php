<?php

namespace App\Billing;

use App\Billing\PaymentGateway;

class StripePaymentGateway implements PaymentGateway
{
    public function charge($amount, $token)
    {

    }
}
