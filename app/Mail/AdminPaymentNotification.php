<?php

namespace App\Mail;

use App\Models\PaymentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminPaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $payment;

    public function __construct(PaymentRequest $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this->subject('New Payment Received')
            ->markdown('emails.admin-payment')
            ->with(['payment' => $this->payment]);
    }
}
