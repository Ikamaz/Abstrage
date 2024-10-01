<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'home']);
Route::get('/all_products', [HomeController::class, 'all_products']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/product_gallery', [HomeController::class, 'product_gallery']);
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('/dashboard', [HomeController::class, 'login_home'])->name('dashboard');

// Cart Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('add_cart/{id}', [HomeController::class, 'add_cart']);
    Route::get('mycart', [HomeController::class, 'mycart']);
    Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart']);
    Route::post('confirm_order', [HomeController::class, 'confirm_order']);
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index']);
    Route::get('view_category', [AdminController::class, 'view_category']);
    Route::post('add_category', [AdminController::class, 'add_category']);
    Route::get('delete_category/{id}', [AdminController::class, 'delete_category']);
    Route::get('edit_category/{id}', [AdminController::class, 'edit_category']);
    Route::post('update_category/{id}', [AdminController::class, 'update_category']);
    Route::get('add_product', [AdminController::class, 'add_product']);
    Route::post('upload_product', [AdminController::class, 'upload_product']);
    Route::get('view_product', [AdminController::class, 'view_product']);
    Route::get('delete_product/{id}', [AdminController::class, 'delete_product']);
    Route::get('update_product/{id}', [AdminController::class, 'update_product']);
    Route::post('edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::get('product_search', [AdminController::class, 'product_search']);
    Route::get('view_orders', [AdminController::class, 'view_orders']);
    Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way']);
    Route::get('delivered/{id}', [AdminController::class, 'delivered']);
    Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf']);
    Route::delete('remove_image/{id}', [AdminController::class, 'remove_image']);
;
});

require __DIR__.'/auth.php';
