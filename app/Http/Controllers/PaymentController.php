<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitPayment;

class PaymentController extends Controller
{
    public function store(SubmitPayment $request)
    {
        $validated = $request->validated();
        $payment   = new Paymet();
        $payment->setItems(session('cart'));

        try {
            $order = $payment->pay();

            return response()->json($order->toArray(), 201);
        } catch (Exception $e) {
            return response()->json([], 422);
        }
    }
}
