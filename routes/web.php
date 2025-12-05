<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'loginPost'])->name('admin.login.post');

Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])
    ->middleware('admin.auth')
    ->name('admin.dashboard');

Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
