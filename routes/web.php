<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [HomeController::class, 'home']);
Route::get('all_products', [HomeController::class, 'all_products'])->name('products.index');

Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/product_gallery', [HomeController::class, 'product_gallery']);
Route::get('product_details/{id}', [HomeController::class, 'product_details']);
Route::get('/dashboard', [HomeController::class, 'login_home'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/cart/add/{id}', [HomeController::class, 'add_cart'])->name('cart.add');
    Route::get('mycart', [HomeController::class, 'mycart']);
    Route::post('update_cart/{id}', [HomeController::class, 'updateCart']);
    Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart']);
    Route::post('confirm_order', [HomeController::class, 'confirm_order']);
    Route::get('myorders', [HomeController::class, 'myorders']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

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
    Route::get('update_product/{slug}', [AdminController::class, 'update_product']);
    Route::post('edit_product/{id}', [AdminController::class, 'edit_product']);
    Route::get('product_search', [AdminController::class, 'product_search']);
    Route::get('view_orders', [AdminController::class, 'view_orders']);
    Route::get('print_pdf/{id}', [AdminController::class, 'printPDF']);
    Route::delete('remove_image/{id}', [AdminController::class, 'remove_image']);
    Route::get('on_the_way/{id}', [AdminController::class, 'markOnTheWay']);
    Route::get('delivered/{id}', [AdminController::class, 'markDelivered']);
    Route::get('saved/{id}', [AdminController::class, 'markSaved']);
    Route::get('cancel_order/{id}', [AdminController::class, 'cancelOrder']);
    Route::get('send_invoice/{id}', [AdminController::class, 'sendInvoice']);
    Route::get('/admin/export/excel', [AdminController::class, 'exportExcel'])->name('export.excel');
    Route::get('view_users', [AdminController::class, 'view_users']);
    Route::get('edit_user/{id}', [AdminController::class, 'edit_user']);
    Route::put('update_user/{id}', [AdminController::class, 'update_user']);
    Route::delete('delete_user/{id}', [AdminController::class, 'delete_user']);
    Route::get('/admin/orders/filter', [AdminController::class, 'filter_orders'])->name('admin.filter_orders');
});

require __DIR__ . '/auth.php';
