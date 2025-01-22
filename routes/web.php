<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LayoutController;
use App\Http\Controllers\Admin\ActionsController;
use App\Http\Controllers\Admin\Brand\BrandController;
use App\Http\Controllers\Admin\Color\ColorController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Brand\BrandActionsController;
use App\Http\Controllers\Admin\Color\ColorActionsController;
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
    Route::prefix('admin')->group(function () {
        // Admin
        Route::get('dashboard', [LayoutController::class, 'showDashboard'])->name('admin-dashboard');
        Route::get('list', [LayoutController::class, 'adminList'])->name('admin-list');
        Route::get('add', [LayoutController::class, 'addAdmin'])->name('add-admin-layout');
        Route::post('add', [ActionsController::class, 'insertAdmin'])->name('add-admin');
        Route::get('edit/{id}', [LayoutController::class, 'editAdmin'])->name('edit-admin');
        Route::post('edit/{id}', [ActionsController::class, 'updateAdmin'])->name('update-admin');
        Route::get('delete/{id}', [ActionsController::class, 'deleteAdmin'])->name('delete-admin');
        // Category
        Route::get('category', [CategoryController::class, 'categoryList'])->name('category-list');
        Route::get('category/list', [CategoryController::class, 'categoryList'])->name('category-list');
        Route::get('category/add', [CategoryController::class, 'addCategory'])->name('add-category-layout');
        Route::post('category/add', [CategoryActionsController::class, 'insertCategory'])->name('add-category');
        Route::get('category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit-category');
        Route::post('category/edit/{id}', [CategoryActionsController::class, 'updateCategory'])->name('update-category');
        Route::get('category/delete/{id}', [CategoryActionsController::class, 'deleteCategory'])->name('delete-category');
        // SubCategory
        Route::get('sub-category', [SubCategoryController::class, 'subCategoryList'])->name('sub_category-list');
        Route::get('sub-category/list', [SubCategoryController::class, 'subCategoryList'])->name('sub_category-list');
        Route::get('sub-category/add', [SubCategoryController::class, 'addSubCategory'])->name('add-sub_category-layout');
        Route::post('sub-category/add', [SubCategoryActionsController::class, 'insertSubCategory'])->name('add-sub_category');
        Route::get('sub-category/edit/{id}', [SubCategoryController::class, 'editSubCategory'])->name('edit-sub_category-layout');
        Route::post('sub-category/edit/{id}', [SubCategoryActionsController::class, 'updateSubCategory'])->name('edit-sub_category');
        Route::get('sub-category/delete/{id}', [SubCategoryActionsController::class, 'deleteSubCategory'])->name('delete-sub_category');
        Route::post('sub_category/ajax', [SubCategoryActionsController::class, 'ajaxGetSubCategory'])->name('sub_category-ajax');
        // Brands
        Route::get('brands', [BrandController::class, 'brandList'])->name('brand-list');
        Route::get('brands/list', [BrandController::class, 'brandList'])->name('brand-list');
        Route::get('brands/add', [BrandController::class, 'addBrand'])->name('add-brand');
        Route::post('brands/add', [BrandActionsController::class, 'insertBrand'])->name('insert-brand');
        Route::get('brands/edit/{id}', [BrandController::class, 'editBrand'])->name('edit-brand');
        Route::post('brands/edit/{id}', [BrandActionsController::class, 'updateBrand'])->name('update-brand');
        Route::get('brands/delete/{id}', [BrandActionsController::class, 'deleteBrand'])->name('delete-brand');
        //Colors
        Route::get('colors', [ColorController::class, 'colorList'])->name('color-list');
        Route::get('colors/list', [ColorController::class, 'colorList'])->name('color-list');
        Route::get('colors/add', [ColorController::class, 'addColor'])->name('add-color');
        Route::post('colors/add', [ColorActionsController::class, 'insertColor'])->name('insert-color');
        Route::get('colors/edit/{id}', [ColorController::class, 'editColor'])->name('edit-color');
        Route::post('colors/edit/{id}', [ColorActionsController::class, 'updateColor'])->name('update-color');
        Route::get('colors/delete/{id}', [ColorActionsController::class, 'deleteColor'])->name('delete-color');
        // Products
        Route::get('products', [ProductController::class, 'productList'])->name('products-list');
        Route::get('products/list', [ProductController::class, 'productList'])->name('products-list');
        Route::get('products/add', [ProductController::class, 'addProduct'])->name('add-product');
        Route::post('products/add', [ProductActionsController::class, 'insertProduct'])->name('insert-product');
        Route::get('products/edit/{id}', [ProductController::class, 'editProduct'])->name('edit-product');
        Route::post('products/edit/{id}', [ProductActionsController::class, 'updateProduct'])->name('update-product');
        Route::get('products/edit/{productId}/image/delete/{id}', [ProductActionsController::class, 'deleteProductImage'])->name('delete-product-image');
        Route::get('products/delete/{id}', [ProductActionsController::class, 'deleteProduct'])->name('delete-product');
        Route::post('products/sorting_images', [ProductActionsController::class, 'orderingImages'])->name('ordering_images');
    });
});
