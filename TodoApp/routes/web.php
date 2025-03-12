<?php

use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Jobs\TaskRemindJob;
use App\Models\Task;
use App\Models\User;

Route::get('/test-job', function () {
    TaskRemindJob::dispatch(Task::first());

    return 'Job dispatched!';
});
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

    Route::name('tasks.')->prefix('tasks/')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        Route::get('/task/{task:id}', [TaskController::class, 'show'])->name('show');
        Route::get('/task/{task:id}/edit', [TaskController::class, 'edit'])->name('edit');
        Route::post('/store', [TaskController::class, 'store'])->name('store');
        Route::post('drop/{task:id}', \App\Http\Controllers\TaskDropController::class)->name('drop');
        Route::post('finish/{task:id}', \App\Http\Controllers\TaskFinishController::class)->name('finish');
        Route::post('take/{task:id}', \App\Http\Controllers\TaskTakeController::class)->name('take');
        Route::patch('/task/{task:id}', [TaskController::class, 'update'])->name('update');
        Route::delete('/task/{task:id}', [TaskController::class, 'destroy'])->name('destroy');

    });
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index');
        Route::get('/create', [TagController::class, 'create'])->name('create');
        Route::get('/edit/{tag:id}', [TagController::class, 'edit'])->name('edit');
        Route::post('/store', [TagController::class, 'store'])->name('store');
        Route::patch('/{tag:id}', [TagController::class, 'update'])->name('update');
        Route::delete('/{tag:id}', [TagController::class, 'destroy'])->name('destroy');
    });
    Route::name('categories.')->prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::get('/edit/{cat:id}', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/{cat:id}', [CategoryController::class, 'show'])->name('show');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::patch('/{cat:id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{cat:id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
