<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use App\Mail\PaymentLinkCreated;
use App\Mail\PaymentSuccessful;
use App\Mail\AdminPaymentNotification;
use Illuminate\Support\Facades\Mail;

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
            'client_email' => 'required|email|max:255',
            'service_desc' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = $request->amount * 100;

        $payment = PaymentRequest::create([
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'service_desc' => $request->service_desc,
            'amount_cents' => $amount,
            'checkout_url' => '', // initial
            'status' => 'pending',
        ]);

        $payment->checkout_url = route('custom-pay', ['id' => $payment->id]);
        $payment->save();
        // ✅ Send payment link email
        Mail::to($payment->client_email)->send(new PaymentLinkCreated($payment));

        return redirect()->route('payment-requests')->with('success', 'Payment link created & email sent!');
    }
    

    public function listRequests()
    {
        $payments = PaymentRequest::latest()->get();
        return view('list-requests', compact('payments'));
    }

    public function showCustomPaymentPage($id)
    {
        $payment = PaymentRequest::findOrFail($id);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        if (!$payment->payment_intent_id) {
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $payment->amount_cents,
                'currency' => 'usd',
                'metadata' => [
                    'payment_request_id' => $payment->id,
                    'client_name' => $payment->client_name
                ],
            ]);
            $payment->payment_intent_id = $intent->id;
            $payment->save();
        } else {
            $intent = \Stripe\PaymentIntent::retrieve($payment->payment_intent_id);
        }

        return view('custom-payment', [
            'payment' => $payment,
            'clientSecret' => $intent->client_secret
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|integer|exists:payment_requests,id',
            'transaction_id' => 'required|string',
        ]);

        // 🚀 Retrieve payment intent from Stripe to be sure it succeeded
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        $intent = \Stripe\PaymentIntent::retrieve($request->transaction_id);

        if ($intent->status !== 'succeeded') {
            return response()->json(['error' => 'Payment not confirmed'], 400);
        }

        // 🚀 Update your local database
        $payment = PaymentRequest::findOrFail($request->payment_id);
        $payment->status = 'paid';
        $payment->transaction_id = $request->transaction_id;
        $payment->save();

        // ✅ Send admin email
        Mail::to('info@vortexdigitallabs.com')->send(new AdminPaymentNotification($payment));

        return response()->json(['success' => true]);
    }

    public function success()
    {
        return view('success');
    }

    public function dashboard()
    {
        $total = PaymentRequest::count();
        $paid = PaymentRequest::where('status', 'paid')->count();
        $pending = PaymentRequest::where('status', 'pending')->count();
        $cancelled = PaymentRequest::where('status', 'cancelled')->count();
        $totalAmount = PaymentRequest::sum('amount_cents') / 100;

        return view('dashboard', compact('total', 'paid', 'pending', 'cancelled'));
    }

}
