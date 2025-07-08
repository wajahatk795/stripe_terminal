@component('mail::message')
# Payment Received

Thank you {{ $payment->client_name }}, we have received your payment for **{{ $payment->service_desc }}**.

**Transaction ID:** {{ $payment->transaction_id }}

If you have questions, reply to this email anytime.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
