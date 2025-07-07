@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg p-5 border-0">
                <div class="text-success mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                         class="bi bi-check-circle-fill animate__animated animate__bounceIn" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 
                                 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 
                                 0 0-1.06-1.06L7.5 
                                 9.439 5.53 7.47a.75.75 0 0 0-1.06 
                                 1.06l2.5 2.5z"/>
                    </svg>
                </div>

                <h2 class="mb-3">Payment Successful!</h2>
                <p class="lead mb-4">
                    Thank you for your payment.
                </p>

                <!-- <a href="{{ route('payment-requests') }}" class="btn btn-outline-primary mt-2">
                    Back to Dashboard
                </a> -->
            </div>

        </div>
    </div>
</div>
@endsection
