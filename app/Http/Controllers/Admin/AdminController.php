<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function vehicles()
    {
        return view('admin.vehicles.index');
    }

    public function drivers()
    {
        return view('admin.drivers.index');
    }

    public function reservations()
    {
        return view('admin.reservations.index');
    }
}
