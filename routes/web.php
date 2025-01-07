<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\ActionsController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Brand\BrandActionsController;
use App\Http\Controllers\Admin\Product\ProductActionsController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryController;
use App\Http\Controllers\Admin\Category\CategoryActionsController;
use App\Http\Controllers\Admin\SubCategory\SubCategoryActionsController;

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
    // SubCategory
    Route::get('/admin/sub-category', [SubCategoryController::class, 'subCategoryList'])->name('sub_category-list');
    Route::get('/admin/sub-category/list', [SubCategoryController::class, 'subCategoryList'])->name('sub_category-list');
    Route::get('/admin/sub-category/add', [SubCategoryController::class, 'addSubCategory'])->name('add-sub_category-layout');
    Route::post('/admin/sub-category/add', [SubCategoryActionsController::class, 'insertSubCategory'])->name('add-sub_category');
    Route::get('/admin/sub-category/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit-sub_category-layout');
    Route::post('/admin/sub-category/edit/{id}', [SubCategoryActionsController::class, 'updateSubCategory'])->name('edit-sub_category');
    Route::get('/admin/sub-category/delete/{id}', [SubCategoryActionsController::class, 'deleteSubCategory'])->name('delete-sub_category');
    // Brands
    Route::get('/admin/brands', [BrandController::class, 'brandList'])->name('brand-list');
    Route::get('/admin/brands/list', [BrandController::class, 'brandList'])->name('brand-list');
    Route::get('/admin/brands/add', [BrandController::class, 'addBrand'])->name('add-brand');
    Route::post('/admin/brands/add', [BrandActionsController::class, 'insertBrand'])->name('insert-brand');
    Route::get('/admin/brands/edit/{id}', [BrandController::class, 'editBrand'])->name('edit-brand');
    Route::post('/admin/brands/edit/{id}', [BrandActionsController::class, 'updateBrand'])->name('update-brand');
    Route::get('/admin/brands/delete/{id}', [BrandActionsController::class, 'deleteBrand'])->name('delete-brand');
    // Products
    // Route::get('/admin/products', [ProductController::class, 'productList'])->name('products-list');
    // Route::get('/admin/products/list', [ProductController::class, 'productList'])->name('products-list');
    // Route::get('/admin/products/add', [ProductController::class, 'addProduct'])->name('add-product-layout');
    // Route::post('/admin/products/add', [ProductActionsController::class, 'insertProduct'])->name('add-product');
    // Route::get('/admin/products/edit/{id}', [ProductController::class, 'editProduct'])->name('edit-product-layout');
    // Route::post('/admin/products/edit/{id}', [ProductActionsController::class, 'updateProduct'])->name('edit-product');
    // Route::get('/admin/products/delete/{id}', [ProductActionsController::class, 'deleteProduct'])->name('delete-product');
});
