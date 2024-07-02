<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\OrderContoller;

/*
|--------------------------------------------------------------------------
| Buyer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register buyer web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web"  middleware group and "auth" middleware. Make something great!
|
*/

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/buy/{product}', [OrderContoller::class, 'store'])->name('order.store');
    Route::get('/cart', [CartItemController::class, 'index'])->name('buyer.cart');
    Route::post('/cart', [CartItemController::class, 'store'])->name('buyer.cart.store');

    Route::post('/cart/{item}/update-quantity', [CartItemController::class, 'updateQuantity'])->name('buyer.cart.update-quantity');

    Route::post('/cart/delete', [CartItemController::class, 'destroyCart'])->name('buyer.cart.delete');
    Route::get('/checkout/{items}', [CartItemController::class, 'checkout'])->name('buyer.checkout');
    Route::get('/checkout', [OrderContoller::class, 'checkout'])->name('checkout');
    Route::get('/order', [CartItemController::class, 'showOrder'])->name('buyer.orders');


    // apply coupon
    Route::post('/coupon', [CartItemController::class, 'applyCoupon'])->name('coupon.apply');

    //route profile
    Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('mainprofile');
    Route::post('/profile/save', [App\Http\Controllers\Profile\ProfileController::class, 'saveProfile'])->name('profileSave');
    Route::get('/profile/alamat', [App\Http\Controllers\Profile\ProfileAlamatController::class, 'index'])->name('alamatprofile');
    Route::post('/profile/alamat/save', [App\Http\Controllers\Profile\ProfileAlamatController::class, 'saveAlamat'])->name('alamatSave');
});

//route alamat
Route::get('/get-provinces', function () {
    $response = Http::get('https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json');
    return $response->json();
});

Route::get('/get-regencies/{provinceId}', function ($provinceId) {
    $response = Http::get("https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinceId}.json");
    return $response->json();
});
