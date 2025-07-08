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
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $payment) {}

    public function build()
    {
        return $this->subject('Your Payment Link')
            ->markdown('emails.payment-link')
            ->with(['payment' => $this->payment]);
    }
}
