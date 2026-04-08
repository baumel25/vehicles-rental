<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Category;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $query = Vehicle::where('status', 'Available');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $vehicles = $query->latest()->paginate(12);
        $categories = Category::whereNull('parent_id')->get();

        return view('vehicles.index', compact('vehicles', 'categories'));
    }

    public function show($slug)
    {
        $vehicle = Vehicle::where('slug', $slug)->with('images', 'category')->firstOrFail();
        
        // Also get related vehicles in the same category
        $relatedVehicles = Vehicle::where('category_id', $vehicle->category_id)
            ->where('id', '!=', $vehicle->id)
            ->where('status', 'Available')
            ->take(4)
            ->get();

        return view('vehicles.show', compact('vehicle', 'relatedVehicles'));
    }
}
