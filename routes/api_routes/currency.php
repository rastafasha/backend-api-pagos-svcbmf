<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminCurrencyController;
use App\Http\Controllers\Admin\AdminCurrencySoftDeletesController;

//currencies
Route::get('/currencies', [AdminCurrencyController::class, 'index'])
    ->name('currency.index');

Route::post('/currency/store', [AdminCurrencyController::class, 'currencyStore'])
    ->name('currency.store');

Route::get('/currency/show/{currency}', [AdminCurrencyController::class, 'currencyShow'])
    ->name('currency.show');

Route::put('/currency/update/{currency}', [AdminCurrencyController::class, 'currencyUpdate'])
    ->name('currency.update');

Route::delete('/currency/destroy/{currency}', [AdminCurrencyController::class, 'currencyDestroy'])
    ->name('currency.destroy');

//Admin Monedas o divisas Softdeletes
Route::get('/currencies/delete', [AdminCurrencySoftDeletesController::class, 'index'])
    ->name('currencies.delete.index');

Route::get('/currency/delete/show/{id}', [AdminCurrencySoftDeletesController::class, 'curencyDeleteShow'])
    ->name('currency.delete.show');

Route::put('/currency/delete/restore/{id}', [AdminCurrencySoftDeletesController::class, 'curencyDeleteRestore'])
    ->name('currency.delete.restore');
    
Route::delete('/currency/destroy/force/{id}', [AdminCurrencySoftDeletesController::class, 'curencyDeleteforce'])
    ->name('currency.delete.force');