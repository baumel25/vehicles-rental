<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\ReservationController;
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
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('admin.vehicles.index');
        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('admin.vehicles.create');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('admin.vehicles.store');
        Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('admin.vehicles.show');
        Route::get('/vehicles/{id}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
        Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('admin.vehicles.update');
        Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('admin.vehicles.delete');
        Route::delete('/vehicles/images/{imageId}', [VehicleController::class, 'removeImage'])->name('admin.vehicles.removeImage');

        // Drivers
        Route::get('/drivers', [DriverController::class, 'index'])->name('admin.drivers.index');
        Route::get('/drivers/create', [DriverController::class, 'create'])->name('admin.drivers.create');
        Route::post('/drivers', [DriverController::class, 'store'])->name('admin.drivers.store');
        Route::get('/drivers/{id}', [DriverController::class, 'show'])->name('admin.drivers.show');
        Route::get('/drivers/{id}/edit', [DriverController::class, 'edit'])->name('admin.drivers.edit');
        Route::put('/drivers/{id}', [DriverController::class, 'update'])->name('admin.drivers.update');
        Route::delete('/drivers/{id}', [DriverController::class, 'destroy'])->name('admin.drivers.delete');

        // Reservations
        Route::get('/reservations', [ReservationController::class, 'index'])->name('admin.reservations.index');
        Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('admin.reservations.show');
        Route::put('/reservations/{id}/status', [ReservationController::class, 'updateStatus'])->name('admin.reservations.updateStatus');
        Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('admin.reservations.delete');
    });
});
