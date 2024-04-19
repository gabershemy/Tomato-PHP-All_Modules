<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoArtisan\App\Http\Controllers\ArtisanController;

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

Route::middleware(['web', 'splade'])->name('admin.')->group(function () {
    Route::get('/admin/artisan', [ArtisanController::class, 'index'])->name('artisan.index');
    Route::post('/admin/artisan/{command}', [ArtisanController::class, 'run'])->name('artisan.json');
});
