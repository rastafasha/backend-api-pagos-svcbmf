<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminPlanController;
use App\Http\Controllers\Admin\AdminPlanSoftDeletesController;

//Route productos
Route::get('/planes', [AdminPlanController::class, 'index'])
    ->name('plan.index');

Route::post('/plan/store', [AdminPlanController::class, 'planStore'])
    ->name('plan.store');


Route::get('/plan/show/{plan}', [AdminPlanController::class, 'planShow'])
    ->name('plan.show');

Route::post('/plan/update/{id}', [AdminPlanController::class, 'planUpdate'])
    ->name('plan.update');

Route::delete('/plan/destroy/{plan}', [AdminPlanController::class, 'planDestroy'])
    ->name('plan.destroy');


Route::get('/plan/search', [AdminPlanController::class, 'search'])
    ->name('plan.search');