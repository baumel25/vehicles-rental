<?php

namespace App\Http\Controllers;

use App\Mail\NewReservationAdminNotification;
use App\Models\Admin;
use App\Models\Driver;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        // 1. Check Vehicle Availability (Fleet Quantity)
        $conflictingVehicleReservations = Reservation::where('vehicle_id', $vehicle->id)
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->where(function ($query) use ($pickup, $return) {
                $query->where(function ($q) use ($pickup, $return) {
                    $q->where('pickup_date', '<', $return)
                        ->where('return_date', '>', $pickup);
                });
            })->get();

        if ($conflictingVehicleReservations->count() >= $vehicle->quantity) {
            $earliestFreeDate = $conflictingVehicleReservations->min('return_date');
            $dateFormatted = Carbon::parse($earliestFreeDate)->format('M d, Y');

            return back()->withInput()->withErrors(['vehicle_id' => "This vehicle model is fully booked for the selected period. One will be available starting {$dateFormatted}."]);
        }

        // 2. Check Driver Availability (if selected)
        if ($request->driver_id) {
            $conflictingDriverReservation = Reservation::where('driver_id', $request->driver_id)
                ->whereIn('status', ['Pending', 'Confirmed'])
                ->where(function ($query) use ($pickup, $return) {
                    $query->where(function ($q) use ($pickup, $return) {
                        $q->where('pickup_date', '<', $return)
                            ->where('return_date', '>', $pickup);
                    });
                })->first();

            if ($conflictingDriverReservation) {
                $dateFormatted = Carbon::parse($conflictingDriverReservation->return_date)->format('M d, Y');

                return back()->withInput()->withErrors(['driver_id' => "The selected Chauffeur is already booked for these dates. He will be available again on {$dateFormatted}."]);
            }
        }

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
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new NewReservationAdminNotification($reservation));
            }
        } catch (\Exception $e) {
            // Log error but allow process to continue
            Log::error('Mail error: '.$e->getMessage());
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
