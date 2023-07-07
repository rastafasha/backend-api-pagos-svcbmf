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

Route::post('/plan/upload', [AdminPlanController::class, 'upload'])
    ->name('plan.upload');

Route::get('/plan/show/{plan}', [AdminPlanController::class, 'planShow'])
    ->name('plan.show');

Route::put('/plan/update/{id}', [AdminPlanController::class, 'planUpdate'])
    ->name('plan.update');

Route::delete('/plan/destroy/{plan}', [AdminPlanController::class, 'planDestroy'])
    ->name('plan.destroy');

Route::delete('/plan/delete-foto/{id}', [AdminPlanController::class, 'deleteFotoPlan'])
    ->name('plan.deleteFotoPlan');

Route::get('/plan/search', [AdminPlanController::class, 'search'])
    ->name('plan.search');


//Admin Planes Softdeletes
Route::get('/plans/delete', [AdminPlanSoftDeletesController::class, 'index'])
    ->name('plans.delete.index');

Route::get('/plan/delete/show/{id}', [AdminPlanSoftDeletesController::class, 'planDeleteShow'])
    ->name('plan.delete.show');

Route::put('/plan/delete/restore/{id}', [AdminPlanSoftDeletesController::class, 'planDeleteRestore'])
    ->name('plan.delete.restore');

Route::delete('/plan/destroy/force/{id}', [AdminPlanSoftDeletesController::class, 'planDeleteforce'])
    ->name('plan.delete.force');
