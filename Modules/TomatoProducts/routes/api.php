<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
    Route::get('/api/products', [\Modules\TomatoProducts\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
    Route::get('/api/products/{model}', [\Modules\TomatoProducts\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
});

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
    Route::get('/api/product-reviews', [\Modules\TomatoProducts\App\Http\Controllers\ProductReviewController::class, 'index'])->name('product-reviews.index');
    Route::get('/api/product-reviews/{model}', [\Modules\TomatoProducts\App\Http\Controllers\ProductReviewController::class, 'show'])->name('product-reviews.show');
});
