<?php

namespace App\Billing;

use App\Billing\PaymentGateway;

class FakePaymentGateway implements PaymentGateway
{
    public function charge($amount, $token)
    {

    }
}
