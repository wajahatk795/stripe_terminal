<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentRequest;

class StripePaymentController extends Controller
{
    public function showForm()
    {
        return view('create-payment');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'service_desc' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $amount = $request->amount * 100;

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $request->service_desc],
                    'unit_amount' => $amount,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'customer_email' => $request->client_email,
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel'),
        ]);

        PaymentRequest::create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'service_desc' => $request->service_desc,
            'amount_cents' => $amount,
            'checkout_url' => $session->url,
            'checkout_session_id' => $session->id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Payment link created successfully!');
    }

    public function listRequests()
    {
        $payments = PaymentRequest::latest()->get();
        return view('list-requests', compact('payments'));
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        if (!$sessionId) {
            return redirect('/')->with('error', 'Missing session id.');
        }

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        if ($session->payment_status == 'paid') {
            $payment = PaymentRequest::where('checkout_session_id', $sessionId)->first();
            if ($payment) {
                $payment->status = 'paid';
                $payment->transaction_id = $session->payment_intent;
                $payment->save();
            }
        }

        return view('success'); // your professional success page
    }

    public function cancel()
    {
        return view('cancel');
    }
}
