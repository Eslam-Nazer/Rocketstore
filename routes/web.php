<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Area
Route::get('/admin', [AuthController::class, 'adminLoginView'])->name('admin-login');
Route::get('/admin/login', [AuthController::class, 'adminLoginView'])->name('admin-login');

Route::post('/admin', [AuthController::class, 'adminAuth'])->name('admin-auth');
Route::post('/admin/login', [AuthController::class, 'adminAuth'])->name('admin-auth');
Route::get('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin-logout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin-dashboard');
});
