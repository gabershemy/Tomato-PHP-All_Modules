<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoBranches\App\Http\Controllers\TomatoBranchesController;

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
    Route::get('admin/companies', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'index'])->name('companies.index');
    Route::get('admin/companies/api', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'api'])->name('companies.api');
    Route::get('admin/companies/create', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'create'])->name('companies.create');
    Route::post('admin/companies', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'store'])->name('companies.store');
    Route::get('admin/companies/{model}', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'show'])->name('companies.show');
    Route::get('admin/companies/{model}/edit', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('admin/companies/{model}', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'update'])->name('companies.update');
    Route::delete('admin/companies/{model}', [\Modules\TomatoBranches\App\Http\Controllers\CompanyController::class, 'destroy'])->name('companies.destroy');
});


Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/branches', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'index'])->name('branches.index');
    Route::get('admin/branches/api', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'api'])->name('branches.api');
    Route::get('admin/branches/create', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'create'])->name('branches.create');
    Route::post('admin/branches', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'store'])->name('branches.store');
    Route::get('admin/branches/{model}', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'show'])->name('branches.show');
    Route::get('admin/branches/{model}/edit', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'edit'])->name('branches.edit');
    Route::post('admin/branches/{model}', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'update'])->name('branches.update');
    Route::delete('admin/branches/{model}', [\Modules\TomatoBranches\App\Http\Controllers\BranchController::class, 'destroy'])->name('branches.destroy');
});

