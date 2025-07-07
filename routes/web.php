<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/create-payment', [StripePaymentController::class, 'showForm'])->name('create-payment');
    Route::post('/create-payment-link', [StripePaymentController::class, 'createPaymentLink'])->name('create-payment-link');
    Route::get('/payment-requests', [StripePaymentController::class, 'listRequests'])->name('payment-requests');
    Route::get('/', [StripePaymentController::class, 'listRequests']);
});

Route::get('/success', [StripePaymentController::class, 'success'])->name('stripe.success');
Route::get('/cancel', function () {
    return view('cancel');
})->name('stripe.cancel');

Route::get('/pay/{id}', [StripePaymentController::class, 'showCustomPaymentPage'])->name('custom-pay');
Route::post('/pay/{id}', [StripePaymentController::class, 'processCustomPayment'])->name('custom-pay.process');

require __DIR__.'/auth.php';
