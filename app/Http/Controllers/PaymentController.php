<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Http\Requests\SubmitPayment;
use App\Payment;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway, Payment $payment)
    {
        $this->paymentGateway = $paymentGateway;
        $this->payment        = $payment;
    }

    public function store(SubmitPayment $request)
    {
        $validated = $request->validated();

        try {
            $payment = $this->payment->setCart(session('cart'));
            $order   = $payment->pay($this->paymentGateway, request('payment_token'), request());
            $order->setRequestInput();

            Mail::to($order->email)->send(new OrderConfirmationEmail($order));

            return redirect('/confirmation')->with(['order' => $order]);
        } catch (Exception $e) {
            return response()->json([], 422);
        }
    }
}
