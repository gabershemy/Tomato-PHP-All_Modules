<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoInventory\App\Http\Controllers\InventoryController;
use Modules\TomatoInventory\App\Http\Controllers\RefundController;
use Modules\TomatoInventory\App\Http\Controllers\TomatoInventoryController;

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
    Route::post('admin/inventories/{model}/status', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'status'])->name('inventories.status');
    Route::get('admin/inventories/barcodes', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'barcodes'])->name('inventories.barcodes');
    Route::post('admin/inventories/barcodes', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'barcodesPrint'])->name('inventories.barcodes.print');
    Route::get('admin/inventories/report', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'report'])->name('inventories.report');
    Route::post('admin/inventories/report', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'reportData'])->name('inventories.report.data');
    Route::post('admin/inventories/report/print', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'reportPrint'])->name('inventories.report.print');
    Route::get('admin/inventories/import', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'import'])->name('inventories.import');
    Route::post('admin/inventories/import', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'importStore'])->name('inventories.import.store');
    Route::post('admin/inventories/{model}/approve-item', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'approveItem'])->name('inventories.approve.item');
    Route::post('admin/inventories/{model}/approve', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'approve'])->name('inventories.approve');
});

Route::middleware(['web','auth', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/inventories/print', [\Modules\TomatoInventory\App\Http\Controllers\InventoryActionsController::class, 'printIndex'])->name('inventories.print');
    Route::get('admin/inventories/{model}/print', [InventoryController::class, 'print'])->name('inventories.print.show');
    Route::get('admin/inventories/{model}/barcode', [InventoryController::class, 'barcode'])->name('inventories.print.barcode');
    Route::get('admin/inventories/print-product-report', [InventoryController::class, 'printProductReport'])->name('inventories.print.products');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/inventories', [InventoryController::class, 'index'])->name('inventories.index');
    Route::get('admin/inventories/history', [InventoryController::class, 'history'])->name('inventories.history');
    Route::get('admin/inventories/api', [InventoryController::class, 'api'])->name('inventories.api');
    Route::get('admin/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
    Route::post('admin/inventories', [InventoryController::class, 'store'])->name('inventories.store');
    Route::get('admin/inventories/{model}', [InventoryController::class, 'show'])->name('inventories.show');
    Route::get('admin/inventories/{model}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
    Route::post('admin/inventories/{model}', [InventoryController::class, 'update'])->name('inventories.update');
    Route::delete('admin/inventories/{model}', [InventoryController::class, 'destroy'])->name('inventories.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/refunds', [RefundController::class, 'index'])->name('refunds.index');
    Route::get('admin/refunds/api', [RefundController::class, 'api'])->name('refunds.api');
    Route::post('admin/refunds/orders', [RefundController::class, 'orders'])->name('refunds.orders');
    Route::get('admin/refunds/create', [RefundController::class, 'create'])->name('refunds.create');
    Route::post('admin/refunds', [RefundController::class, 'store'])->name('refunds.store');
    Route::get('admin/refunds/{model}', [RefundController::class, 'show'])->name('refunds.show');
    Route::get('admin/refunds/{model}/edit', [RefundController::class, 'edit'])->name('refunds.edit');
    Route::post('admin/refunds/{model}/status', [RefundController::class, 'status'])->name('refunds.status');
    Route::post('admin/refunds/{model}/approve', [RefundController::class, 'approve'])->name('refunds.approve');
    Route::post('admin/refunds/{model}', [RefundController::class, 'update'])->name('refunds.update');
    Route::delete('admin/refunds/{model}', [RefundController::class, 'destroy'])->name('refunds.destroy');
});
