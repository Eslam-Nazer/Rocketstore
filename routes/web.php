<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\ActionsController;
use App\Http\Controllers\Admin\Category\CategoryActionsController;
use App\Http\Controllers\Admin\Category\CategoryController;

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
    // Admin
    Route::get('/admin/dashboard', [LayoutController::class, 'showDashboard'])->name('admin-dashboard');
    Route::get('/admin/list', [LayoutController::class, 'adminList'])->name('admin-list');
    Route::get('/admin/add', [LayoutController::class, 'addAdmin'])->name('add-admin-layout');
    Route::post('/admin/add', [ActionsController::class, 'insertAdmin'])->name('add-admin');
    Route::get('/admin/edit/{id}', [LayoutController::class, 'editAdmin'])->name('edit-admin');
    Route::post('/admin/edit/{id}', [ActionsController::class, 'updateAdmin'])->name('update-admin');
    Route::get('/admin/delete/{id}', [ActionsController::class, 'deleteAdmin'])->name('delete-admin');
    // Category
    Route::get('/admin/category', [CategoryController::class, 'categoryList'])->name('category-list');
    Route::get('/admin/category/list', [CategoryController::class, 'categoryList'])->name('category-list');
    Route::get('/admin/category/add', [CategoryController::class, 'addCategory'])->name('add-category-layout');
    Route::post('/admin/category/add', [CategoryActionsController::class, 'insertCategory'])->name('add-category');
    Route::get('/admin/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
    Route::post('/admin/category/edit/{id}', [CategoryActionsController::class, 'updateCategory'])->name('update-category');
    Route::get('/admin/category/delete/{id}', [CategoryActionsController::class, 'deleteCategory'])->name('delete-category');
});
