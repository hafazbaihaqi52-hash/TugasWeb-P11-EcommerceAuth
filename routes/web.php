<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
    return 'Halo Admin! Kamu berhasil masuk ke halaman Admin.';
})->name('admin.dashboard');

Route::middleware(['auth', 'role:editor'])->get('/editor', function () {
    return 'Halo Editor! Kamu berhasil masuk ke halaman Editor.';
})->name('editor.dashboard');

Route::middleware(['auth', 'role:user'])->get('/user', function () {
    return 'Halo User! Kamu berhasil masuk ke halaman User.';
})->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

require __DIR__.'/auth.php';