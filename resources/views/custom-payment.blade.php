@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h3 class="mb-4 text-center">Pay for {{ $payment->service_desc }}</h3>
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Client:</span><strong>{{ $payment->client_name }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Amount:</span><strong>${{ number_format($payment->amount_cents / 100, 2) }}</strong>
                    </li>
                </ul>
                <form id="payment-form">
                    <div id="card-element" class="mb-3"></div>
                    <div id="card-errors" class="text-danger mb-3"></div>
                    <button id="submit" class="btn btn-primary w-100">Pay Now</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe("{{ config('services.stripe.key') }}");
    const elements = stripe.elements();
    const card = elements.create('card');
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    const submitBtn = document.getElementById('submit');
    const cardErrors = document.getElementById('card-errors');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        submitBtn.disabled = true;
        submitBtn.textContent = 'Processing...';

        const { error, paymentIntent } = await stripe.confirmCardPayment(
            "{{ $clientSecret }}",
            { payment_method: { card: card }}
        );

        if (error) {
            cardErrors.textContent = error.message;
            submitBtn.disabled = false;
            submitBtn.textContent = 'Pay Now';
        } else {
            fetch("{{ route('update-payment-status') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    payment_id: {{ $payment->id }},
                    transaction_id: paymentIntent.id
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('success') }}";
                } else {
                    cardErrors.textContent = 'Payment verified but status not updated.';
                }
            })
            .catch(err => {
                console.error(err);
                cardErrors.textContent = 'An error occurred.';
            });
        }
    });
</script>

@endsection