<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('admin.authenticate');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('admin.categories.show');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.delete');

        // Vehicles
        Route::get('/vehicles', [AdminController::class, 'vehicles'])->name('admin.vehicles.index');
        Route::get('/vehicles/create', [AdminController::class, 'createVehicle'])->name('admin.vehicles.create');
        Route::get('/vehicles/{id}', [AdminController::class, 'showVehicle'])->name('admin.vehicles.show');
        Route::get('/vehicles/{id}/edit', [AdminController::class, 'editVehicle'])->name('admin.vehicles.edit');

        // Drivers
        Route::get('/drivers', [AdminController::class, 'drivers'])->name('admin.drivers.index');
        Route::get('/drivers/create', [AdminController::class, 'createDriver'])->name('admin.drivers.create');
        Route::get('/drivers/{id}', [AdminController::class, 'showDriver'])->name('admin.drivers.show');
        Route::get('/drivers/{id}/edit', [AdminController::class, 'editDriver'])->name('admin.drivers.edit');

        // Reservations
        Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations.index');
    });
});
