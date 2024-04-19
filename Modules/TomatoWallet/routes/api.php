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
Route::middleware(['auth:sanctum'])->prefix('api/wallet')->name('api.wallet.')->group(function () {
    Route::post('/deposit', [\Modules\TomatoWallet\App\Http\Controllers\API\WalletController::class, 'deposit'])->name('deposit');
    Route::get('/transactions', [\Modules\TomatoWallet\App\Http\Controllers\API\WalletController::class, 'transactions'])->name('transactions');
});
