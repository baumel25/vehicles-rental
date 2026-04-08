<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('status', 'Available')->with('categories')->paginate(12);
        return view('drivers.index', compact('drivers'));
    }

    public function show($id)
    {
        $driver = Driver::with('categories')->findOrFail($id);
        return view('driver-details', compact('driver'));
    }
}
