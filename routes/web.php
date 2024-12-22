<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\ActionsController;

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
    Route::get('/admin/dashboard', [LayoutController::class, 'showDashboard'])->name('admin-dashboard');
    Route::get('/admin/list', [LayoutController::class, 'adminList'])->name('admin-list');
    Route::get('/admin/add', [LayoutController::class, 'addAdmin'])->name('add-admin-layout');
    Route::post('/admin/add', [ActionsController::class, 'insertAdmin'])->name('add-admin');
    Route::get('/admin/edit/{id}', [LayoutController::class, 'editAdmin'])->name('edit-admin');
    Route::post('/admin/edit/{id}', [ActionsController::class, 'updateAdmin'])->name('update-admin');
    Route::get('/admin/delete/{id}', [ActionsController::class, 'deleteAdmin'])->name('delete-admin');
});
