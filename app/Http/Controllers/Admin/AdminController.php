<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
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
