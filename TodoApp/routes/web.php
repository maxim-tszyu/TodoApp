<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::name('tasks.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/store', [PostController::class, 'store'])->name('store');
        Route::get('/tasks/{task:id}', [PostController::class, 'show'])->name('show');
        Route::get('/tasks/{task:id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::patch('/tasks/{task:id}', [PostController::class, 'update'])->name('update');
        Route::delete('/tasks/{task:id}', [PostController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
