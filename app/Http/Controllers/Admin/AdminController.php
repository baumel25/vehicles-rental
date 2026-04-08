<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Vehicles
    public function vehicles()
    {
        return view('admin.vehicles.index');
    }

    public function createVehicle()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('admin.vehicles.create', compact('categories'));
    }

    public function showVehicle($id)
    {
        return view('admin.vehicles.show', ['id' => $id]);
    }

    public function editVehicle($id)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('admin.vehicles.edit', ['id' => $id, 'categories' => $categories]);
    }

    // Drivers
    public function drivers()
    {
        return view('admin.drivers.index');
    }

    public function createDriver()
    {
        return view('admin.drivers.create');
    }

    public function showDriver($id)
    {
        return view('admin.drivers.show', ['id' => $id]);
    }

    public function editDriver($id)
    {
        return view('admin.drivers.edit', ['id' => $id]);
    }

    // Reservations
    public function reservations()
    {
        return view('admin.reservations.index');
    }
}
