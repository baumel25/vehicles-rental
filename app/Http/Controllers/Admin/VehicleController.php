<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with(['category', 'subCategory'])->get();
        return view('admin.vehicles.index', compact('vehicles'));
    }

    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.vehicles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'daily_rate' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Out of Stock,Maintenance',
            'description' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'seating_capacity' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(5);

        // Handle Main Thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('vehicles/thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $vehicle = Vehicle::create($data);

        // Handle Additional Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicles/galleries', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle registered successfully.');
    }

    public function show($id)
    {
        $vehicle = Vehicle::with(['category', 'subCategory', 'images', 'reservations' => function($q) {
            $q->with(['user', 'driver'])->latest();
        }])->findOrFail($id);
        return view('admin.vehicles.show', compact('vehicle'));
    }

    public function edit($id)
    {
        $vehicle = Vehicle::with('images')->findOrFail($id);
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.vehicles.edit', compact('vehicle', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'model_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'daily_rate' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Available,Out of Stock,Maintenance',
            'description' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'seating_capacity' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $data = $request->all();
        if ($request->name != $vehicle->name) {
            $data['slug'] = Str::slug($request->name) . '-' . Str::random(5);
        }

        // Handle Main Thumbnail Replacement
        if ($request->hasFile('thumbnail')) {
            if ($vehicle->thumbnail) {
                Storage::disk('public')->delete($vehicle->thumbnail);
            }
            $path = $request->file('thumbnail')->store('vehicles/thumbnails', 'public');
            $data['thumbnail'] = $path;
        }

        $vehicle->update($data);

        // Handle Additional Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('vehicles/galleries', 'public');
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function removeImage($imageId)
    {
        $image = VehicleImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Additional image removed.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::with('images')->findOrFail($id);

        // Delete Main Thumbnail
        if ($vehicle->thumbnail) {
            Storage::disk('public')->delete($vehicle->thumbnail);
        }

        // Delete Gallery Images
        foreach ($vehicle->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle removed from fleet.');
    }
}
