<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ButtonController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Add ButtonController routes (authenticated and verified only)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/configure-button/{id}', [ButtonController::class, 'edit'])->name('button.configure');
    Route::post('/configure-button/{id}', [ButtonController::class, 'update'])->name('button.update');
    Route::delete('/configure-button/{id}', [ButtonController::class, 'destroy'])->name('button.delete');
    Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
