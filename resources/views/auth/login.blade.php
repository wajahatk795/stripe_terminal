@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <img src="{{ asset('logo-v.png') }}" alt="Logo" width="250" height="auto" class="mb-3 mx-auto d-block">
            <h3 class="fw-bold">Welcome Back</h3>
            <p class="text-muted">Please login to your account</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com"
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input
                    type="checkbox"
                    class="form-check-input"
                    id="remember"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold">Login</button>
        </form>

        <div class="mt-3 text-center">
            @if (Route::has('password.request'))
                <!-- <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot your password?</a> -->
            @endif
        </div>
    </div>
</div>
@endsection
