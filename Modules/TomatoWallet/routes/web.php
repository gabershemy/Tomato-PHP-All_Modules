<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoWallet\App\Http\Controllers\TomatoWalletController;

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
    Route::get('admin/wallets', [\Modules\TomatoWallet\App\Http\Controllers\WalletController::class, 'index'])->name('wallets.index');
    Route::get('admin/wallets/api', [\Modules\TomatoWallet\App\Http\Controllers\WalletController::class, 'api'])->name('wallets.api');
    Route::get('admin/wallets/{model}', [\Modules\TomatoWallet\App\Http\Controllers\WalletController::class, 'show'])->name('wallets.show');
    Route::get('admin/wallets/{model}/balance', [\Modules\TomatoWallet\App\Http\Controllers\WalletController::class, 'balanceView'])->name('wallets.balance');
    Route::post('admin/wallets/{model}/balance', [\Modules\TomatoWallet\App\Http\Controllers\WalletController::class, 'balance'])->name('wallets.balance.update');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/transactions', [\Modules\TomatoWallet\App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.index');
    Route::get('admin/transactions/api', [\Modules\TomatoWallet\App\Http\Controllers\TransactionController::class, 'api'])->name('transactions.api');
    Route::get('admin/transactions/{model}', [\Modules\TomatoWallet\App\Http\Controllers\TransactionController::class, 'show'])->name('transactions.show');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/transfers', [\Modules\TomatoWallet\App\Http\Controllers\TransferController::class, 'index'])->name('transfers.index');
    Route::get('admin/transfers/api', [\Modules\TomatoWallet\App\Http\Controllers\TransferController::class, 'api'])->name('transfers.api');
    Route::get('admin/transfers/create', [\Modules\TomatoWallet\App\Http\Controllers\TransferController::class, 'create'])->name('transfers.create');
    Route::post('admin/transfers', [\Modules\TomatoWallet\App\Http\Controllers\TransferController::class, 'store'])->name('transfers.store');
    Route::get('admin/transfers/{model}', [\Modules\TomatoWallet\App\Http\Controllers\TransferController::class, 'show'])->name('transfers.show');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/payments', [\Modules\TomatoWallet\App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
    Route::get('admin/payments/api', [\Modules\TomatoWallet\App\Http\Controllers\PaymentController::class, 'api'])->name('payments.api');
    Route::get('admin/payments/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/payment-status', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'index'])->name('payment-status.index');
    Route::get('admin/payment-status/api', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'api'])->name('payment-status.api');
    Route::get('admin/payment-status/create', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'create'])->name('payment-status.create');
    Route::post('admin/payment-status', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'store'])->name('payment-status.store');
    Route::get('admin/payment-status/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'show'])->name('payment-status.show');
    Route::get('admin/payment-status/{model}/edit', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'edit'])->name('payment-status.edit');
    Route::post('admin/payment-status/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'update'])->name('payment-status.update');
    Route::delete('admin/payment-status/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentStatusController::class, 'destroy'])->name('payment-status.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/payment-logs', [\Modules\TomatoWallet\App\Http\Controllers\PaymentLogController::class, 'index'])->name('payment-logs.index');
    Route::get('admin/payment-logs/api', [\Modules\TomatoWallet\App\Http\Controllers\PaymentLogController::class, 'api'])->name('payment-logs.api');
    Route::get('admin/payment-logs/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentLogController::class, 'show'])->name('payment-logs.show');
    Route::delete('admin/payment-logs/{model}', [\Modules\TomatoWallet\App\Http\Controllers\PaymentLogController::class, 'destroy'])->name('payment-logs.destroy');
});
