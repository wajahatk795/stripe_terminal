@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Admin Dashboard</h2>
    <div class="btn-bx">
        <a href="{{ route('create-payment') }}" class="btn btn-primary">New Payment Request</a>
        <a href="{{ route('payment-requests') }}" class="btn btn-secondary">View Payment Requests</a>
    </div>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <h5>Total Requests</h5>
                    <h2>{{ $total }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow text-success">
                <div class="card-body">
                    <h5>Paid</h5>
                    <h2>{{ $paid }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow text-warning">
                <div class="card-body">
                    <h5>Pending</h5>
                    <h2>{{ $pending }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow text-danger">
                <div class="card-body">
                    <h5>Cancelled</h5>
                    <h2>{{ $cancelled }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Payment</h5>
                    <p class="card-text">${{ number_format($totalAmount, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Payment Status Overview</h5>
                    <p class="card-text">This chart shows the distribution of payment statuses across all requests.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-items-center justify-content-center">
        <canvas id="statusChart"></canvas>
    </div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Paid', 'Pending', 'Cancelled'],
            datasets: [{
                data: [{{ $paid }}, {{ $pending }}, {{ $cancelled }}],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
<style>
    canvas#statusChart {
        height: 500px !important;
        width: 500px !important;
    }

</style>
@endsection




