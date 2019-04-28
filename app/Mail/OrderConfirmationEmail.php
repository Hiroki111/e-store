<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class OrderConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('www.pdf.orderconfirmation', ['order' => $this->order]);

        return $this->from(config('mail.from.address'))
            ->subject("Order Confirmation from Hiroki's Liquor")
            ->view('emails.orderconfirmation')
            ->attachData($pdf->stream(), 'order-confirmation.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
