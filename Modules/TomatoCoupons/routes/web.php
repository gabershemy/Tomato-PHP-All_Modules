<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoCoupons\App\Http\Controllers\TomatoCouponsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (config("tomato-coupons.features.coupons")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/coupons', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'index'])->name('coupons.index');
        Route::get('admin/coupons/api', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'api'])->name('coupons.api');
        Route::get('admin/coupons/create', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'create'])->name('coupons.create');
        Route::post('admin/coupons', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'store'])->name('coupons.store');
        Route::get('admin/coupons/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'show'])->name('coupons.show');
        Route::get('admin/coupons/{model}/edit', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'edit'])->name('coupons.edit');
        Route::post('admin/coupons/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'update'])->name('coupons.update');
        Route::delete('admin/coupons/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\CouponController::class, 'destroy'])->name('coupons.destroy');
    });
}

if (config("tomato-coupons.features.referral_codes")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/referral-codes', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'index'])->name('referral-codes.index');
        Route::get('admin/referral-codes/api', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'api'])->name('referral-codes.api');
        Route::get('admin/referral-codes/create', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'create'])->name('referral-codes.create');
        Route::post('admin/referral-codes', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'store'])->name('referral-codes.store');
        Route::get('admin/referral-codes/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'show'])->name('referral-codes.show');
        Route::get('admin/referral-codes/{model}/edit', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'edit'])->name('referral-codes.edit');
        Route::post('admin/referral-codes/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'update'])->name('referral-codes.update');
        Route::delete('admin/referral-codes/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\ReferralCodeController::class, 'destroy'])->name('referral-codes.destroy');
    });
}

if (config("tomato-coupons.features.gift_cards")) {
    Route::middleware(['web', 'auth', 'splade', 'verified'])->name('admin.')->group(function () {
        Route::get('admin/gift-cards', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'index'])->name('gift-cards.index');
        Route::get('admin/gift-cards/api', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'api'])->name('gift-cards.api');
        Route::get('admin/gift-cards/create', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'create'])->name('gift-cards.create');
        Route::post('admin/gift-cards', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'store'])->name('gift-cards.store');
        Route::get('admin/gift-cards/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'show'])->name('gift-cards.show');
        Route::get('admin/gift-cards/{model}/edit', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'edit'])->name('gift-cards.edit');
        Route::post('admin/gift-cards/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'update'])->name('gift-cards.update');
        Route::delete('admin/gift-cards/{model}', [\Modules\TomatoCoupons\App\Http\Controllers\GiftCardController::class, 'destroy'])->name('gift-cards.destroy');
    });
}
