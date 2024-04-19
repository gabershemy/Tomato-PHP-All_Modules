<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/orders', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('admin/orders/api', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'api'])->name('orders.api');
    Route::get('admin/orders/account', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'account'])->name('orders.account');
    Route::post('admin/orders/account', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'storeAccount'])->name('orders.account.store');
    Route::post('admin/orders/fast', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'fast'])->name('orders.fast');
    Route::get('admin/orders/create', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'create'])->name('orders.create');
    Route::post('admin/orders', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('admin/orders/{model}', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
    Route::post('admin/orders/{model}/status', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'status'])->name('orders.status');
    Route::post('admin/orders/{model}/approve', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('admin/orders/{model}/shipping', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'ship'])->name('orders.ship');
    Route::get('admin/orders/{model}/shipping', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'shipping'])->name('orders.shipping');
    Route::get('admin/orders/{model}/edit', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'edit'])->name('orders.edit');
    Route::post('admin/orders/{model}', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'update'])->name('orders.update');
    Route::delete('admin/orders/{model}', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('admin/settings/orders', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'settings'])->name('orders.settings');
    Route::post('admin/settings/orders', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'settingsUpdate'])->name('orders.settings.update');
    Route::post('admin/info/user', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'user'])->name('orders.user');
    Route::post('admin/info/product', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'product'])->name('orders.product');
});

Route::middleware(['web','auth',  'verified'])->name('admin.')->group(function () {
    Route::get('admin/orders/{model}/print', [\Modules\TomatoOrders\App\Http\Controllers\OrderController::class, 'print'])->name('orders.print');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/deliveries', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'index'])->name('deliveries.index');
    Route::get('admin/deliveries/api', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'api'])->name('deliveries.api');
    Route::get('admin/deliveries/create', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'create'])->name('deliveries.create');
    Route::post('admin/deliveries', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'store'])->name('deliveries.store');
    Route::get('admin/deliveries/{model}', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'show'])->name('deliveries.show');
    Route::get('admin/deliveries/{model}/edit', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'edit'])->name('deliveries.edit');
    Route::post('admin/deliveries/{model}', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'update'])->name('deliveries.update');
    Route::delete('admin/deliveries/{model}', [\Modules\TomatoOrders\App\Http\Controllers\DeliveryController::class, 'destroy'])->name('deliveries.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/shipping-vendors', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'index'])->name('shipping-vendors.index');
    Route::get('admin/shipping-vendors/api', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'api'])->name('shipping-vendors.api');
    Route::get('admin/shipping-vendors/create', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'create'])->name('shipping-vendors.create');
    Route::post('admin/shipping-vendors', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'store'])->name('shipping-vendors.store');
    Route::get('admin/shipping-vendors/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'show'])->name('shipping-vendors.show');
    Route::get('admin/shipping-vendors/{model}/edit', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'edit'])->name('shipping-vendors.edit');
    Route::post('admin/shipping-vendors/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'update'])->name('shipping-vendors.update');
    Route::delete('admin/shipping-vendors/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingVendorController::class, 'destroy'])->name('shipping-vendors.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/shipping-prices', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'index'])->name('shipping-prices.index');
    Route::get('admin/shipping-prices/api', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'api'])->name('shipping-prices.api');
    Route::get('admin/shipping-prices/create', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'create'])->name('shipping-prices.create');
    Route::post('admin/shipping-prices', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'store'])->name('shipping-prices.store');
    Route::get('admin/shipping-prices/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'show'])->name('shipping-prices.show');
    Route::get('admin/shipping-prices/{model}/edit', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'edit'])->name('shipping-prices.edit');
    Route::post('admin/shipping-prices/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'update'])->name('shipping-prices.update');
    Route::delete('admin/shipping-prices/{model}', [\Modules\TomatoOrders\App\Http\Controllers\ShippingPriceController::class, 'destroy'])->name('shipping-prices.destroy');
});

