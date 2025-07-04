<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\PaymentRequest;


class StripePaymentController extends Controller
{
    public function showForm()
    {
        return view('create-payment');
    }

    public function createPaymentLink(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'service_desc' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'client_email' => 'nullable|email'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $amountInCents = $request->amount * 100;

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $request->service_desc,
                        'description' => 'For ' . $request->client_name,
                    ],
                    'unit_amount' => $amountInCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success'),
            'cancel_url' => route('stripe.cancel'),
            'customer_email' => $request->client_email,
        ]);

        // after $session = Session::create(...);

        PaymentRequest::create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'service_desc' => $request->service_desc,
            'amount_cents' => $amountInCents,
            'checkout_url' => $session->url,
            'status' => 'pending',
        ]);


        return view('payment-link', [
            'checkoutUrl' => $session->url
        ]);
    }

    public function listRequests(){
        $requests = PaymentRequest::latest()->get();
        return view('payment-requests', compact('requests'));
    }
}
