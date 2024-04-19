<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoPms\App\Http\Controllers\TomatoPmsController;

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
    Route::get('admin/projects', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'index'])->name('projects.index');
    Route::get('admin/projects/api', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'api'])->name('projects.api');
    Route::get('admin/projects/create', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');
    Route::post('admin/projects', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');
    Route::get('admin/projects/{model}', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show');
    Route::get('admin/projects/{model}/edit', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'edit'])->name('projects.edit');
    Route::get('admin/projects/{model}/permissions', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'permissions'])->name('projects.permissions');
    Route::get('admin/projects/{model}/description', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'description'])->name('projects.description');
    Route::get('admin/projects/{model}/status', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'status'])->name('projects.status');
    Route::get('admin/projects/{model}/rates', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'rates'])->name('projects.rates');
    Route::post('admin/projects/{model}', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'update'])->name('projects.update');
    Route::delete('admin/projects/{model}', [\Modules\TomatoPms\App\Http\Controllers\ProjectController::class, 'destroy'])->name('projects.destroy');
});


Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/sprints', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'index'])->name('sprints.index');
    Route::get('admin/sprints/api', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'api'])->name('sprints.api');
    Route::get('admin/sprints/create', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'create'])->name('sprints.create');
    Route::post('admin/sprints', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'store'])->name('sprints.store');
    Route::get('admin/sprints/{model}', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'show'])->name('sprints.show');
    Route::get('admin/sprints/{model}/edit', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'edit'])->name('sprints.edit');
    Route::post('admin/sprints/{model}', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'update'])->name('sprints.update');
    Route::delete('admin/sprints/{model}', [\Modules\TomatoPms\App\Http\Controllers\SprintController::class, 'destroy'])->name('sprints.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/issues', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'index'])->name('issues.index');
    Route::get('admin/issues/api', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'api'])->name('issues.api');
    Route::get('admin/issues/create', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'create'])->name('issues.create');
    Route::post('admin/issues', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'store'])->name('issues.store');
    Route::get('admin/issues/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'show'])->name('issues.show');
    Route::get('admin/issues/{model}/edit', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'edit'])->name('issues.edit');
    Route::post('admin/issues/{model}/comment', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'comment'])->name('issues.comment');
    Route::post('admin/issues/{model}/timer', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'timer'])->name('issues.timer');
    Route::post('admin/issues/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'update'])->name('issues.update');
    Route::delete('admin/issues/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssueController::class, 'destroy'])->name('issues.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/issues-user-logs', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'index'])->name('issues-user-logs.index');
    Route::get('admin/issues-user-logs/api', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'api'])->name('issues-user-logs.api');
    Route::get('admin/issues-user-logs/create', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'create'])->name('issues-user-logs.create');
    Route::post('admin/issues-user-logs', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'store'])->name('issues-user-logs.store');
    Route::get('admin/issues-user-logs/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'show'])->name('issues-user-logs.show');
    Route::get('admin/issues-user-logs/{model}/edit', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'edit'])->name('issues-user-logs.edit');
    Route::post('admin/issues-user-logs/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'update'])->name('issues-user-logs.update');
    Route::delete('admin/issues-user-logs/{model}', [\Modules\TomatoPms\App\Http\Controllers\IssuesUserLogController::class, 'destroy'])->name('issues-user-logs.destroy');
});


Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/timers', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'index'])->name('timers.index');
    Route::get('admin/timers/api', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'api'])->name('timers.api');
    Route::get('admin/timers/create', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'create'])->name('timers.create');
    Route::post('admin/timers', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'store'])->name('timers.store');
    Route::get('admin/timers/{model}', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'show'])->name('timers.show');
    Route::get('admin/timers/{model}/edit', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'edit'])->name('timers.edit');
    Route::post('admin/timers/{model}', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'update'])->name('timers.update');
    Route::delete('admin/timers/{model}', [Modules\TomatoPms\App\Http\Controllers\TimerController::class, 'destroy'])->name('timers.destroy');
});

Route::middleware(['web','auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/timers-metas', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'index'])->name('timers-metas.index');
    Route::get('admin/timers-metas/api', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'api'])->name('timers-metas.api');
    Route::get('admin/timers-metas/create', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'create'])->name('timers-metas.create');
    Route::post('admin/timers-metas', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'store'])->name('timers-metas.store');
    Route::get('admin/timers-metas/{model}', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'show'])->name('timers-metas.show');
    Route::get('admin/timers-metas/{model}/edit', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'edit'])->name('timers-metas.edit');
    Route::post('admin/timers-metas/{model}', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'update'])->name('timers-metas.update');
    Route::delete('admin/timers-metas/{model}', [Modules\TomatoPms\App\Http\Controllers\TimersMetaController::class, 'destroy'])->name('timers-metas.destroy');
});

