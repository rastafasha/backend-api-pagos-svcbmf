<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDirectoryController;
use App\Http\Controllers\Admin\AdminDirectorySoftDeletesController;

//directorio
Route::get('/directories', [AdminDirectoryController::class, 'index'])
    ->name('directories.index');

Route::post('/directory/store', [AdminDirectoryController::class, 'directoryStore'])
    ->name('directory.store');

Route::get('/directory/show/{directory}', [AdminDirectoryController::class, 'directoryShow'])
    ->name('directory.show');

Route::put('/directory/update/{directory:id}', [AdminDirectoryController::class, 'directoryUpdate'])
    ->name('directory.update');

    Route::post('/directory/upload/', [AdminDirectoryController::class, 'upload'])
    ->name('directory.upload');

Route::delete('/directory/destroy/{directory:id}', [AdminDirectoryController::class, 'directoryDestroy'])
    ->name('directory.destroy');

Route::post('/directory/upload', [AdminDirectoryController::class, 'upload'])
    ->name('directory.upload');


Route::delete('/directory/delete-foto/{id}', [AdminDirectoryController::class, 'deleteFotoDirectory'])
    ->name('directory.deleteFotoDirectory');

Route::get('/directory/search/', [AdminDirectoryController::class, 'search'])
    ->name('directory.search');

Route::put('/directory/update/status/{directory:id}', [AdminDirectoryController::class, 'directoryUpdateStatus'])
    ->name('directory.status');

//Admin Directorios Softdeletes
Route::get('/directories/delete', [AdminDirectorySoftDeletesController::class, 'index'])
    ->name('directories.delete.index');

Route::get('/directory/delete/show/{id}', [AdminDirectorySoftDeletesController::class, 'directoryDeleteShow'])
    ->name('directory.delete.show');

Route::put('/directory/delete/restore/{id}', [AdminDirectorySoftDeletesController::class, 'directoryDeleteRestore'])
    ->name('directory.delete.restore');

Route::delete('/directory/destroy/force/{id}', [AdminDirectorySoftDeletesController::class, 'directoryDeleteforce'])
    ->name('directory.delete.force');
