<?php

namespace App\Billing;

use App\Billing\PaymentFailedException;
use App\Billing\PaymentGateway;

class StripePaymentGateway implements PaymentGateway
{
    const TEST_CARD_NUMBER = "4242424242424242";
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getValidTestToken($cardNumber = self::TEST_CARD_NUMBER)
    {
        return \Stripe\Token::create([
            "card" => [
                "number"    => $cardNumber,
                "exp_month" => 1,
                "exp_year"  => date('Y') + 1,
                "cvc"       => "123",
            ],
        ], ['api_key' => $this->apiKey])->id;
    }

    public function totalCharges()
    {

    }

    public function charge($amount, $token)
    {
        try {
            return \Stripe\Charge::create([
                "amount"   => $amount,
                "currency" => "aud",
                "source"   => $token,
            ], ['api_key' => $this->apiKey]);
        } catch (\Stripe\Error\InvalidRequest $e) {
            throw new PaymentFailedException;
        }
    }
}
