@extends('layouts.app')

@section('title', 'All Payment Requests')

@section('content')
<div class="container pt-3">
    <div class="btn-bx">
         <a href="{{ route('create-payment') }}" class="btn btn-secondary mb-3">Create Payment</a>
        <a href="{{ route('payment-requests') }}" class="btn btn-secondary mb-3">View Requests</a>

        <!-- <a href="/dashboard" class="btn btn-secondary mb-3">Back to Dashboard</a> -->
    </div>
    <div class="card shadow-sm">
    <div class="card-header">
        <h4>All Payment Requests</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Checkout Link</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $req)
                <tr>
                    <td>{{ $req->id }}</td>
                    <td>{{ $req->client_name }}</td>
                    <td>{{ $req->service_desc }}</td>
                    <td>${{ number_format($req->amount_cents / 100, 2) }}</td>
                    <td>
                        @php
                            $badgeClass = 'secondary';
                            if ($req->status === 'paid') $badgeClass = 'success';
                            elseif ($req->status === 'cancelled') $badgeClass = 'danger';
                        @endphp
                        <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($req->status) }}</span>
                    </td>

                    <td><a href="{{ $req->checkout_url }}" class="btn btn-sm btn-outline-primary" target="_blank">Pay</a></td>
                    <td>{{ $req->created_at->format('Y-m-d h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection
