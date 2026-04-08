<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Authentication
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our administrative records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    // Dashboard
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
