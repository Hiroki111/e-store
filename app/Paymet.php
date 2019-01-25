<?php

namespace App;

use App\Billing\PaymentGateway;

class Payment
{
    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function pay()
    {

    }
}
