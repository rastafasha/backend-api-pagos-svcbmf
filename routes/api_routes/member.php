<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\MemberDirectoryController;


Route::get('/member/directories', [MemberDirectoryController::class, 'index'])
    ->name('member.directories.index');

Route::post('/member/directory/store', [MemberDirectoryController::class, 'directoryStore'])
    ->name('member.directory.store');

Route::get('/member/directory/show/{directory:user_id}', [MemberDirectoryController::class, 'directoryShow'])
    ->name('member.directory.show');

Route::put('/member/directory/update/{directory:id}', [MemberDirectoryController::class, 'directoryUpdate'])
    ->name('member.directory.update');

Route::delete('/member/directory/destroy/{directory:id}', [MemberDirectoryController::class, 'directoryDestroy'])
    ->name('member.directory.destroy');

    Route::post('/member/upload', [MemberDirectoryController::class, 'upload'])
    ->name('member.upload');


Route::delete('/member/delete-foto/{id}', [MemberDirectoryController::class, 'deleteFotoDirectory'])
    ->name('member.deleteFotoDirectory');

Route::get('/member/search', [MemberDirectoryController::class, 'search'])
    ->name('member.search');
