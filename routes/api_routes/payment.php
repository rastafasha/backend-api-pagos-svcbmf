<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPaymentController;

//pagos
Route::get('/pagos', [AdminPaymentController::class, 'index'])
    ->name('payments.index');

Route::post('/payment/store', [AdminPaymentController::class, 'paymentStore'])
    ->name('payment.store');

Route::get('/payment/show/{payment}', [AdminPaymentController::class, 'paymentShow'])
    ->name('payment.show');

Route::get('/payment/pagosbyUser/{id}', [AdminPaymentController::class, 'pagosbyUser'])
    ->name('payment.pagosbyUser');

Route::post('/payment/update/{id}', [AdminPaymentController::class, 'paymentUpdate'])
    ->name('payment.update');


Route::get('payment/recientes/', [AdminPaymentController::class, 'recientes'])
    ->name('payment.recientes');

Route::get('payment/pendientes', [AdminPaymentController::class, 'pagosPendientes'])
    ->name('payment.pagosPendientes');


Route::get('/payment/search/', [AdminPaymentController::class, 'search'])
    ->name('payment.search');


Route::delete('/payment/destroy/{payment:id}', [AdminPaymentController::class, 'paymentDestroy'])
    ->name('payment.destroy');

