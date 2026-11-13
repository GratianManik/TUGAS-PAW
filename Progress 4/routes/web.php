<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BengkelController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('bengkel.index'));

// Halaman login: hanya untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
});

// Semua route di bawah ini wajib login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ADMIN saja: tambah, ubah, hapus.
    // PENTING: grup ini ditulis SEBELUM grup 'index & show', supaya
    // /bengkel/create tidak tertangkap oleh route /bengkel/{bengkel}.
    Route::middleware('role:admin')->group(function () {
        Route::resource('bengkel', BengkelController::class)
            ->except(['index', 'show']);
    });

    // ADMIN dan STAFF: boleh melihat daftar dan detail
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('bengkel', BengkelController::class)
            ->only(['index', 'show']);
    });
});
