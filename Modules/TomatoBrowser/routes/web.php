<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoBrowser\App\Http\Controllers\TomatoBrowserController;

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

Route::middleware(['web','splade', 'verified'])->name('admin.')->group(function () {
    Route::get('/admin/browser', [\Modules\TomatoBrowser\App\Http\Controllers\BrowserController::class, 'index'])->name('browser.index');
    Route::post('/admin/browser', [\Modules\TomatoBrowser\App\Http\Controllers\BrowserController::class, 'index'])->name('browser.index');
    Route::get('/admin/browser/upload/file',function (){
        return redirect()->route('admin.browser.index');
    })->name('browser.get');
    Route::post('/admin/browser/upload/file', [\Modules\TomatoBrowser\App\Http\Controllers\BrowserController::class, 'upload'])->name('browser.upload');
    Route::post('/admin/browser/upload', [\Modules\TomatoBrowser\App\Http\Controllers\BrowserController::class, 'store'])->name('browser.store');
    Route::delete('/admin/browser/destroy', [\Modules\TomatoBrowser\App\Http\Controllers\BrowserController::class, 'destroy'])->name('browser.destroy');
});
