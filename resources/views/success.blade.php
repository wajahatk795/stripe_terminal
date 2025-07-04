@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">
    <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width: 100%;">
        <div class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle" viewBox="0 0 16 16">
              <path d="M15.854 7.146a.5.5 0 0 1 0 .708l-8 8a.5.5 0 0 1-.708 0l-4-4a.5.5 0 1 1 .708-.708L7.5 14.293l7.646-7.647a.5.5 0 0 1 .708 0z"/>
              <!-- <path d="M1 8a7 7 0 1 1 14 0A7 7 0 0 1 1 8z"/> -->
            </svg>
        </div>
        <h2 class="fw-bold mb-3">Payment Successful!</h2>
        <p class="text-muted mb-4">Thank you for your payment. Your transaction has been completed successfully.</p>
        <!-- <a href="{{ url('/') }}" class="btn btn-success btn-lg px-4">Go to Home</a> -->
    </div>
</div>
@endsection
