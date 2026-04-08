<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured vehicles (e.g., latest 6 available vehicles)
        $featuredVehicles = Vehicle::where('status', 'Available')
            ->latest()
            ->take(6)
            ->get();

        // Get parent categories for the landing page
        $categories = Category::whereNull('parent_id')->get();

        return view('home', compact('featuredVehicles', 'categories'));
    }
}
