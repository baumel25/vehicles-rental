<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/admin.php';

Route::get('/', function () {
    return view('home');
});

Route::get('/vehicles', function () {
    return view('vehicles.index');
});

Route::get('/vehicles/{id}', function ($id) {
    return view('vehicles.show', ['id' => $id]);
});

Route::get('/reservations/success', function () {
    return view('reservations.success');
});

Route::get('/drivers', function () {
    return view('drivers.index');
});
