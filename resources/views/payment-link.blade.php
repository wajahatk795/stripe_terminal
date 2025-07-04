@extends('layouts.app')

@section('title', 'Payment Link Created')

@section('content')
<div class="card shadow-sm">
    <div class="card-body text-center">
        <h3>Payment Link Created!</h3>
        <p class="mt-3">
            Copy and send this link to your client:
        </p>
        <div class="alert alert-success">
            <a href="{{ $checkoutUrl }}" target="_blank">{{ $checkoutUrl }}</a>
        </div>
        <a href="/create-payment" class="btn btn-secondary mt-3">Create Another Payment</a>
    </div>
</div>
@endsection
