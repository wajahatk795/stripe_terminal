
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripePaymentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/create-payment', [StripePaymentController::class, 'showForm'])->name('create-payment');
    Route::post('/create-payment-link', [StripePaymentController::class, 'createPaymentLink'])->name('create-payment-link');
    Route::get('/payment-requests', [StripePaymentController::class, 'listRequests'])->name('payment-requests');
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/pay/{id}', [StripePaymentController::class, 'showCustomPaymentPage'])->name('custom-pay');
Route::post('/update-payment-status', [StripePaymentController::class, 'updateStatus'])->name('update-payment-status');
Route::get('/success', [StripePaymentController::class, 'success'])->name('success');
Route::get('/cancel', function () {
    return view('cancel');
})->name('cancel');

Route::get('/dashboard', [StripePaymentController::class, 'dashboard'])->middleware('auth')->name('dashboard');


require __DIR__.'/auth.php';
