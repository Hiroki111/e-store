<?php

namespace App;

class Payment
{
    private $paymentGateway;
    private $cart;
    private $input;

    public function __construct($paymentGateway, $cart, $input)
    {
        $this->paymentGateway = $paymentGateway;
        $this->cart           = $cart;
        $this->input          = $input;
    }

    public function pay($paymentToken)
    {
        //varify the card with p-gateway
        //charge with payment gateway
    }
}
