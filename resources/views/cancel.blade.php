@extends('layouts.app')

@section('title', 'Payment Canceled')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg p-5 border-0">
                <div class="text-danger mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                         class="bi bi-x-circle-fill animate__animated animate__shakeX" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.646 
                                 4.646a.5.5 0 0 1 .708 0L8 
                                 7.293l2.646-2.647a.5.5 0 0 1 
                                 .708.708L8.707 8l2.647 
                                 2.646a.5.5 0 0 1-.708.708L8 
                                 8.707l-2.646 2.647a.5.5 0 0 
                                 1-.708-.708L7.293 8 4.646 
                                 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </div>

                <h2 class="mb-3">Payment Canceled</h2>
                <p class="lead mb-4">
                    Your payment was not completed. If this was a mistake, you can try again.
                </p>

                <a href="{{ route('payment-requests') }}" class="btn btn-outline-danger mt-2">
                    Back to Dashboard
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
