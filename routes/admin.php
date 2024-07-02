<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\CouponController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web"  middleware group and "is.admin" middleware. Make something great!
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is.admin']], function () {
    Route::get('dashboard', function () {
        return view('admin.pages.dashboard.index');
    })->name('admin.dashboard');
    Route::get('/users', [ManajemenUserController::class, 'index'])->name('admin.user.index');
    Route::prefix('users/{user}')->group(function () {
        Route::get('/', [ManajemenUserController::class, 'show'])->name('admin.user.show');
        Route::get('/invoice', [ManajemenUserController::class, 'invoice'])->name('admin.user.show.invoice');
        Route::delete('/delete', [ManajemenUserController::class, 'destroy'])->name('admin.user.delete');
    });

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
    Route::prefix('category')->group(function () {

        // Route::get('/', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });

    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    // Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
    // Route::get('/addproduct', [ProductController::class, 'create'])->name('admin.product.add');
    Route::put('/admin/products/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::prefix('product/{product}')->group(function () {
        Route::get('/addproduct', [ProductController::class, 'create'])->name('admin.product.add');
        Route::get('/', [ProductController::class, 'show'])->name('admin.product.show');
        Route::get('/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::delete('/destroy', [ProductController::class, 'destroy'])->name('admin.product.delete');
    });

    // Coupon Management
    Route::resource('/coupon', CouponController::class);

    Route::post('/coupon/status', [CouponController::class, 'updateStatus'])->name('coupon.status.update');
});
