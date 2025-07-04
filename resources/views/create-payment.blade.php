@extends('layouts.app')

@section('title', 'Create Payment')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Payment Link</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('create-payment-link') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="client_name" class="form-label">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="client_email" class="form-label">Client Email</label>
            <input type="email" name="client_email" id="client_email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="service_desc" class="form-label">Service Description</label>
            <input type="text" name="service_desc" id="service_desc" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount (USD)</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Payment Link</button>
    </form>
</div>
@endsection
