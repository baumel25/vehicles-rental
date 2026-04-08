<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('categories')->get();
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.drivers.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:drivers,license_number',
            'experience_years' => 'required|integer|min:0',
            'base_rate' => 'required|numeric|min:0',
            'status' => 'required|in:Available,On Trip,Off Duty',
            'biography' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('drivers', 'public');
            $data['profile_picture'] = $path;
        }

        $driver = Driver::create($data);

        if ($request->has('categories')) {
            $driver->categories()->sync($request->categories);
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Driver registered successfully.');
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit($id)
    {
        $driver = Driver::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.drivers.edit', compact('driver', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|unique:drivers,license_number,' . $id,
            'experience_years' => 'required|integer|min:0',
            'base_rate' => 'required|numeric|min:0',
            'status' => 'required|in:Available,On Trip,Off Duty',
            'biography' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('profile_picture')) {
            if ($driver->profile_picture) {
                Storage::disk('public')->delete($driver->profile_picture);
            }
            $path = $request->file('profile_picture')->store('drivers', 'public');
            $data['profile_picture'] = $path;
        }

        $driver->update($data);

        if ($request->has('categories')) {
            $driver->categories()->sync($request->categories);
        } else {
            $driver->categories()->detach();
        }

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        
        if ($driver->profile_picture) {
            Storage::disk('public')->delete($driver->profile_picture);
        }

        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver record deleted.');
    }
}
