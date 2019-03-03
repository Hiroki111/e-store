<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Cart;
use App\Http\Requests\SubmitPayment;
use App\Payment;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    private $paymentGateway;
    private $payment;
    private $cart;

    public function __construct(PaymentGateway $paymentGateway, Payment $payment)
    {
        $this->paymentGateway = $paymentGateway;
        $this->payment        = $payment;
        $this->cart           = new Cart(session('cart'));
    }

    public function index()
    {
        return view('www.payment', [
            'cart'  => $this->cart,
            'years' => range((int) date("Y"), (int) date("Y") + 10),
        ]);
    }

    public function store(SubmitPayment $request)
    {
        $validated = $request->validated();

        try {
            $payment = $this->payment->setCart(new Cart(session('cart')));
            $order   = $payment->pay($this->paymentGateway, request('payment_token'), request());
            session(['cart' => null]);
            //Mail::to($order->email)->send(new OrderConfirmationEmail($order));

            return redirect('/confirmation')->with(['order' => $order]);
        } catch (Exception $e) {
            return response()->json([], 422);
        }
    }
}
