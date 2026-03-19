<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/vehicles', [AdminController::class, 'vehicles'])->name('admin.vehicles');
    Route::get('/drivers', [AdminController::class, 'drivers'])->name('admin.drivers');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
});
