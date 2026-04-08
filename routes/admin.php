<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    // Guest Admin Routes
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

    // Protected Admin Routes
    Route::middleware('admin')->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Categories
        Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories.index');
        Route::get('/categories/{id}', [AdminController::class, 'showCategory'])->name('admin.categories.show');

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
