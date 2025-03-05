<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('tasks.')->prefix('tasks/')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
        Route::get('/task/{task:id}', [TaskController::class, 'show'])->name('show');
        Route::get('/task/{task:id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::patch('/task/{task:id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/task/{task:id}', [TaskController::class, 'destroy'])->name('destroy');
    });
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/create', [TagController::class, 'create'])->name('create');
        Route::post('/store', [TagController::class, 'store'])->name('store');
        Route::patch('/{tag:id}', [TagController::class, 'update'])->name('update');
        Route::delete('/{tag:id}', [TagController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
