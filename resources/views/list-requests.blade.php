@extends('layouts.app')

@section('title', 'Payment Requests')

@section('content')
<div class="container">
    <h1 class="mb-4">Payment Requests</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive shadow-sm">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Email</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Transaction</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->client_name }}</td>
                        <td>{{ $payment->client_email }}</td>
                        <td>{{ $payment->service_desc }}</td>
                        <td>${{ number_format($payment->amount_cents / 100, 2) }}</td>
                        <td>
                            @if($payment->status == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>
                            @if($payment->transaction_id)
                                <small>{{ $payment->transaction_id }}</small>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ $payment->checkout_url }}" target="_blank" class="btn btn-sm btn-primary">Pay</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No payment requests found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
