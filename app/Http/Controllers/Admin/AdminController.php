<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login() { return view('admin.login'); }
    public function dashboard() { return view('admin.dashboard'); }

    // Categories
    public function categories() { return view('admin.categories.index'); }
    public function showCategory($id) { return view('admin.categories.show', ['id' => $id]); }

    // Vehicles
    public function vehicles() { return view('admin.vehicles.index'); }
    public function createVehicle() { return view('admin.vehicles.create'); }
    public function showVehicle($id) { return view('admin.vehicles.show', ['id' => $id]); }
    public function editVehicle($id) { return view('admin.vehicles.edit', ['id' => $id]); }

    // Drivers
    public function drivers() { return view('admin.drivers.index'); }
    public function createDriver() { return view('admin.drivers.create'); }
    public function showDriver($id) { return view('admin.drivers.show', ['id' => $id]); }
    public function editDriver($id) { return view('admin.drivers.edit', ['id' => $id]); }

    // Reservations
    public function reservations() { return view('admin.reservations.index'); }
}
