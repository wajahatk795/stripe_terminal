<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentRequest;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            return response('Invalid payload', 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('Invalid signature', 400);
        }

        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;
            
            // Find your record by some metadata or lookup
            $payment = PaymentRequest::where('checkout_session_id', $session->id)->first();
            if ($payment) {
                $payment->status = 'paid';
                $payment->transaction_id = $session->payment_intent;
                $payment->save();
            }
        }

        return response('Webhook handled', 200);
    }
}

