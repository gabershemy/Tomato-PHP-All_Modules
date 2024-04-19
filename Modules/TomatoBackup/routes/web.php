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

Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/backup', [\Modules\TomatoBackup\App\Http\Controllers\BackupController::class, 'index'])->name('backup.index');
    Route::get('admin/backup/create', [\Modules\TomatoBackup\App\Http\Controllers\BackupController::class, 'create'])->name('backup.create');
    Route::post('admin/backup', [\Modules\TomatoBackup\App\Http\Controllers\BackupController::class, 'store'])->name('backup.store');
    Route::get('admin/backup/{record}', [\Modules\TomatoBackup\App\Http\Controllers\BackupController::class, 'download'])->name('backup.download');
    Route::delete('admin/backup/{record}', [\Modules\TomatoBackup\App\Http\Controllers\BackupController::class, 'destroy'])->name('backup.destroy');
});
