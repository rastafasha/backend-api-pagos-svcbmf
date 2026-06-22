<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentMethodController;

//pagos
Route::get('/paymentmethod', [PaymentMethodController::class, 'index'])
    ->name('payments.index');

Route::post('/paymentmethod/store', [PaymentMethodController::class, 'paymentStore'])
    ->name('payment.store');

Route::get('/paymentmethod/show/{payment}', [PaymentMethodController::class, 'paymentShow'])
    ->name('payment.show');

Route::put('/paymentmethod/update/{id}', [PaymentMethodController::class, 'paymentUpdate'])
    ->name('payment.update');

Route::put('/paymentmethod/statusupdate/{id}', [PaymentMethodController::class, 'paymentUpdateStatus'])
    ->name('payment.statusupdate');

Route::delete('/paymentmethod/destroy/{payment:id}', [PaymentMethodController::class, 'paymentDestroy'])
    ->name('payment.destroy');

Route::get('paymentmethod/activos/', [PaymentMethodController::class, 'activos'])
    ->name('payment.activos');