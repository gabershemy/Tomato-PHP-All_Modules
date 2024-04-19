<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoPos\App\Http\Controllers\TomatoPosController;

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

Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'index'])->name('index');
    Route::post('/place', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'place'])->name('place');
});

Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/inventory', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'inventory'])->name('inventory');
    Route::get('/inventory/create', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'create'])->name('inventory.create');
    Route::post('/inventory', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'store'])->name('inventory.store');
});

Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/settings', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'settings'])->name('settings');
    Route::post('/settings', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'settingsUpdate'])->name('settings.update');
});

Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/orders', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}/print', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'printOrder'])->name('orders.print');
});

Route::middleware(['web', 'auth'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/orders/{order}', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'order'])->name('orders.show');
});

Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::get('/account', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'account'])->name('account');
    Route::post('/account', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'accountStore'])->name('account.store');
});


Route::middleware(['web', 'auth', 'splade'])->prefix('admin/pos')->name('admin.pos.')->group(function (){
    Route::post('/cart', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'cart'])->name('cart.index');
    Route::get('/cart/options', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'options'])->name('cart.options');
    Route::post('/cart/{cart}', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'update'])->name('cart.update');
    Route::delete('/cart', [\Modules\TomatoPos\App\Http\Controllers\TomatoPosController::class, 'clear'])->name('cart.clear');
});

