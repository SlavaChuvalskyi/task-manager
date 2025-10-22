<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

Route::prefix('project/{project}')->group(function () {
    Route::get('/', [ProjectController::class, 'show'])->name('project.show');
    Route::post('/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/task/{task}', [TaskController::class, 'show'])->name('project.task.show');
    Route::post('/task', [TaskController::class, 'store'])->name('project.task.store');
    Route::post('/task/{task}/update', [TaskController::class, 'update'])->name('project.task.update');
    Route::post('/task/{task}/updateStatus', [TaskController::class, 'updateStatus'])->name('project.task.updateStatus');
    Route::post('/task/{task}/destroy', [TaskController::class, 'destroy'])->name('project.task.destroy');
});

