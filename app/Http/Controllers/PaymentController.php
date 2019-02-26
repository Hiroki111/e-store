<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Http\Requests\SubmitPayment;
use App\Paymet;

//use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    private $payment;
    private $paymentGateway;

    public function __construct(Paymet $paymet, PaymentGateway $paymentGateway)
    {
        $this->payment        = $payment;
        $this->paymentGateway = $paymentGateway;
    }

    public function store(SubmitPayment $request)
    {
        $validated = $request->validated();

        try {
            $payment = $this->payment->setCart(session('cart'))->setRequestInput(request());
            $order   = $payment->pay($this->paymentGateway, request('payment_token'));

            //Mail::to($order->email)->send(new OrderConfirmationEmail($order));

            return redirect('/confirmation')->with(['order' => $order]);
        } catch (Exception $e) {
            return response()->json([], 422);
        }
    }
}
