<?php

use App\Http\Controllers\StripePaymentController;

Route::middleware('auth')->group(function () {
    Route::get('/create-payment', [StripePaymentController::class, 'showForm']);
    Route::post('/create-payment-link', [StripePaymentController::class, 'createPaymentLink']);
    Route::get('/payment-requests', [StripePaymentController::class, 'listRequests'])->name('payment-requests');
});

Route::get('/success', function () {
    return 'Payment successful!';
})->name('stripe.success');

Route::get('/cancel', function () {
    return 'Payment canceled!';
})->name('stripe.cancel');



// existing web routes...

require __DIR__.'/auth.php';