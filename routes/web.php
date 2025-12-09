<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BulanController;

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
