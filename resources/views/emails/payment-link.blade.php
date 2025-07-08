@component('mail::message')
# Hello {{ $payment->client_name }},

We’ve created a payment link for your service **{{ $payment->service_desc }}**.

**Amount:** ${{ number_format($payment->amount_cents / 100, 2) }}

@component('mail::button', ['url' => $payment->checkout_url])
Pay Now
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
