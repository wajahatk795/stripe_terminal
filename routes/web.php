<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StripeWebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Group for authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/create-payment', [StripePaymentController::class, 'showForm'])->name('create-payment');
    Route::post('/create-payment-link', [StripePaymentController::class, 'createPaymentLink'])->name('create-payment-link');

    // List requests on payment requests page & homepage
    Route::get('/payment-requests', [StripePaymentController::class, 'listRequests'])->name('payment-requests');
    Route::get('/', [StripePaymentController::class, 'listRequests']);
});

// Stripe webhook for server-side event updates (optional)
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');

// Success & cancel pages
Route::get('/success', [StripePaymentController::class, 'success'])->name('stripe.success');

Route::get('/cancel', function () {
    return view('cancel');
})->name('stripe.cancel');

// Include auth scaffolding routes (login, register, etc)
require __DIR__.'/auth.php';
