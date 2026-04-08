<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Reservation::with('vehicle', 'driver')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('user.bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'pickup_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:pickup_date',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);
        $pickup = Carbon::parse($request->pickup_date);
        $return = Carbon::parse($request->return_date);
        $days = $pickup->diffInDays($return) ?: 1;

        $totalPrice = $vehicle->daily_rate * $days;

        if ($request->driver_id) {
            $driver = Driver::findOrFail($request->driver_id);
            $totalPrice += $driver->base_rate * $days;
        }

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'pickup_date' => $request->pickup_date,
            'return_date' => $request->return_date,
            'total_price' => $totalPrice,
            'status' => 'Pending',
        ]);

        // Notify Admins
        try {
            $admins = \App\Models\Admin::all();
            foreach ($admins as $admin) {
                \Illuminate\Support\Facades\Mail::to($admin->email)->send(new \App\Mail\NewReservationAdminNotification($reservation));
            }
        } catch (\Exception $e) {
            // Log error but allow process to continue
            \Illuminate\Support\Facades\Log::error('Mail error: ' . $e->getMessage());
        }

        return redirect()->route('bookings.index')->with('success', 'Booking requested successfully! We will confirm it soon.');
    }

    public function show($id)
    {
        $booking = Reservation::with('vehicle', 'driver')->where('user_id', Auth::id())->findOrFail($id);
        return view('user.bookings.show', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Reservation::where('user_id', Auth::id())
            ->where('status', 'Pending')
            ->findOrFail($id);

        $booking->update(['status' => 'Cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
