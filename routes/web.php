<?php

use App\Http\Controllers\PaypalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payWithPaypal',[PaypalController::class, 'PayWithPaypal'])->name('payWithPaypal');
Route::post('/paypal-store',[PaypalController::class, 'postPaymentWithPaypal'])->name('payWithPaypal');
Route::get('/status',[PaypalController::class, 'getPaymentWithPaypal'])->name('status');
