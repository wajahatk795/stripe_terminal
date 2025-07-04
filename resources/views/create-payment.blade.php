@extends('layouts.app')

@section('title', 'Create Payment Link')

@section('content')
<div class="container pt-3">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Create Payment Link for Client</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/create-payment-link" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Client Name</label>
                    <input type="text" name="client_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Client Email (optional)</label>
                    <input type="email" name="client_email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Service Description</label>
                    <input type="text" name="service_desc" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount (USD)</label>
                    <input type="number" name="amount" step="0.01" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Payment Link</button>
            </form>
        </div>
    </div>
</div>

@endsection
