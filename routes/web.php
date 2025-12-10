<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BulanController;
use App\Http\Controllers\UserBulanController;

Route::get('/', function () {
    return view('index');
});

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'loginPost'])->name('admin.login.post');

Route::middleware('admin.auth')->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');

    // CRUD Bulan
    Route::resource('/bulan', BulanController::class);

});

Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/bulan', [UserBulanController::class, 'index'])->name('user.bulan.index');
Route::get('/bulan/{slug}', [UserBulanController::class, 'show'])->name('user.bulan.show');

// ================= USER AREA =================

// tampilkan daftar bulan untuk user
Route::get('/bulan', [UserBulanController::class, 'listUser'])->name('user.bulan');

// tombol 1: artikel
Route::get('/bulan/{slug}/artikel', [UserBulanController::class, 'artikelUser'])->name('user.bulan.artikel');

// tombol 2: informasi
Route::get('/bulan/{slug}/informasi', [UserBulanController::class, 'informasiUser'])->name('user.bulan.informasi');

// tombol 3: pilihan perjalanan
Route::get('/bulan/{slug}/perjalanan', [UserBulanController::class, 'perjalananUser'])->name('user.bulan.perjalanan');

