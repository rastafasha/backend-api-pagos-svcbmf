<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDirectoryController;

//directorio
Route::get('/directories', [AdminDirectoryController::class, 'index'])
    ->name('directories.index');

Route::post('/directory/store', [AdminDirectoryController::class, 'directoryStore'])
    ->name('directory.store');

Route::get('/directory/show/{directory}', [AdminDirectoryController::class, 'directoryShow'])
    ->name('directory.show');

Route::post('/directory/update/{directory:id}', [AdminDirectoryController::class, 'directoryUpdate'])
    ->name('directory.update');


Route::delete('/directory/destroy/{directory:id}', [AdminDirectoryController::class, 'directoryDestroy'])
    ->name('directory.destroy');

Route::get('/directory/search/', [AdminDirectoryController::class, 'search'])
    ->name('directory.search');

Route::put('/directory/update/status/{directory:id}', [AdminDirectoryController::class, 'directoryUpdateStatus'])
    ->name('directory.status');