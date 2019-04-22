<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use PDF;

class OrderConfirmationController extends Controller
{
    public function show($hashedId)
    {
        if (empty(session('justCompletedOrder'))) {
            return redirect("/");
        }

        session(['justCompletedOrder' => null]);
        return view('www.orderconfirmation', [
            'order' => Order::find(decode_hash($hashedId)),
        ]);
    }

    public function printPdf($hashedId)
    {
        $order = Order::find(decode_hash($hashedId));

        if ($order->created_at < Carbon::now()->subDay()) {
            echo "The link for this invoice is not available. Please kindly check your email box, which we have sent an order confirmation.";
            return;
        }

        $pdf = PDF::loadView('www.pdf.orderconfirmation', ['order' => $order]);
        return $pdf->stream('order-confirmation.pdf');
    }
}
