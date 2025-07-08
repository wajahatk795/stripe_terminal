@component('mail::message')
# Payment Received

A new payment has been completed.

- **Client:** {{ $payment->client_name }}
- **Email:** {{ $payment->client_email }}
- **Service:** {{ $payment->service_desc }}
- **Amount:** ${{ number_format($payment->amount_cents / 100, 2) }}
- **Transaction ID:** {{ $payment->transaction_id }}

@component('mail::button', ['url' => route('payment-requests')])
View Payments
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
