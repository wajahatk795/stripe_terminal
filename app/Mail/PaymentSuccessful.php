<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $payment;

    public function __construct($payment) {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('Payment Successful')
            ->markdown('emails.payment-success')
            ->with(['payment' => $this->payment]);
    }
}
