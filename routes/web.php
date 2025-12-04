<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/become-seller', [ProfileController::class, 'becomeSeller'])->name('become.seller');

    Route::post('/checkout/{product}', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/history', [App\Http\Controllers\ProductController::class, 'history'])->name('history');

    Route::middleware(['role:seller'])->prefix('seller')->group(function () {
        Route::resource('products', ProductController::class)->except(['index', 'show']);
    });

    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.delete');
    });
});

require __DIR__.'/auth.php';
