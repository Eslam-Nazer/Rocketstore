<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Area
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin-login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin-dashboard');
