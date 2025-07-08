<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentLinkCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The payment instance.
     *
     * @var mixed
     */
    public $payment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Your Payment Link')
            ->markdown('emails.payment-link')
            ->with(['payment' => $this->payment]);
    }
}
