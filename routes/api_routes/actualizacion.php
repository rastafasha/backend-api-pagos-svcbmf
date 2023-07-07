<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActualizacionController;

//directorio
Route::get('/actualizacions', [ActualizacionController::class, 'index'])
    ->name('actualizacions.index');

Route::post('/actualizacion/store', [ActualizacionController::class, 'store'])
    ->name('actualizacion.store');

Route::post('/actualizacion/show/{actualizacion}', [ActualizacionController::class, 'show'])
    ->name('actualizacion.show');
