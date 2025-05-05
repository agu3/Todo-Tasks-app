<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Rutele pentru task-uri
Route::get('/', function () {
    return redirect()->route('register');});

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');

Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/tasks', [TaskController::class, 'store']);

Route::patch('/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

Route::patch('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('tasks.delete');


// Rutele pentru profil
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Gruparea rutelor care necesită autentificare
Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('dashboard');
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::post('/tasks/{id}/update', [TaskController::class, 'update']);
    Route::post('/tasks/{id}/delete', [TaskController::class, 'delete']);
});

require __DIR__.'/auth.php';
