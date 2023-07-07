<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminUserSoftDeletesController;

//Admin Usuarios
Route::get('/users', [AdminUserController::class, 'index'])
    ->name('users.index');

Route::get('/user/show/{user:id}', [AdminUserController::class, 'userShow'])
    ->name('user.show');

Route::put('/user/update/{user:id}', [AdminUserController::class, 'userUpdate'])
    ->name('user.update');

Route::delete('/user/destroy/{user}', [AdminUserController::class, 'userDestroy'])
    ->name('user.destroy');

Route::get('/users/recientes', [AdminUserController::class, 'recientes'])
    ->name('users.recientes');

Route::get('users/search/', [AdminUserController::class, 'search'])
    ->name('users.search');

//Admin Usuarios Softdeletes
Route::get('/users/delete', [AdminUserSoftDeletesController::class, 'index'])
    ->name('users.delete.index');

Route::get('/user/delete/show/{id}', [AdminUserSoftDeletesController::class, 'userDeleteShow'])
    ->name('user.delete.show');

Route::put('/user/delete/restore/{id}', [AdminUserSoftDeletesController::class, 'userDeleteRestore'])
    ->name('user.delete.restore');

Route::delete('/user/destroy/force/{id}', [AdminUserSoftDeletesController::class, 'userDeleteforce'])
    ->name('user.delete.force');






    // Route::delete("/model/{model}/restore",'ModelController@restore')
    // ->middleware('can:restore,model')->name('model.restore');


// Route::get('usuarios', [UsuariosController::class, 'index'])
//     ->name('users.index');
// Route::get('usuarios/recientes/', [UsuariosController::class, 'recientes'])
//     ->name('users.recientes');
// Route::get('usuarios/{id}', [UsuariosController::class, 'show'])
//     ->name('users.show');
// Route::get('usuarios/update/{id}', [UsuariosController::class, 'update'])
//     ->name('users.update');

// Route::put('usuarios/updateInfo/{id}', [UsuariosController::class, 'updatePersonalInformation'])
//     ->name('users.updatePersonalInformation');
// Route::delete('usuarios/delete/{id}', [UsuariosController::class, 'destroy'])
//     ->name('users.destroy');
// Route::get('usuarios/uploadImage', [UsuariosController::class, 'upload'])
//     ->name('users.upload');
// Route::get('usuarios/image', [UsuariosController::class, 'getImage'])
//     ->name('users.getImage');
// Route::get('usuarios/deleteImage', [UsuariosController::class, 'deleteFotoPerfil'])
//     ->name('users.deleteFotoPerfil');
