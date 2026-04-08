<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the reservations.
     */
    public function index()
    {
        $reservations = Reservation::with(['user', 'vehicle', 'driver'])
            ->latest()
            ->paginate(15);

        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Display the specified reservation.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'vehicle', 'driver'])->findOrFail($id);

        return view('admin.reservations.show', compact('reservation'));
    }

    /**
     * Update the status of the specified reservation.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled',
        ]);

        $reservation = Reservation::with(['user', 'driver'])->findOrFail($id);
        $reservation->update(['status' => $request->status]);

        // Notify User and Driver
        try {
            if ($request->status === 'Confirmed') {
                // To User
                \Illuminate\Support\Facades\Mail::to($reservation->user->email)->send(new \App\Mail\BookingApprovedUserNotification($reservation));
                
                // To Driver if exists
                if ($reservation->driver_id && $reservation->driver) {
                    \Illuminate\Support\Facades\Mail::to($reservation->driver->email)->send(new \App\Mail\BookingApprovedDriverNotification($reservation));
                }
            } elseif ($request->status === 'Cancelled') {
                // To User
                \Illuminate\Support\Facades\Mail::to($reservation->user->email)->send(new \App\Mail\BookingDeclinedUserNotification($reservation));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Mail error on status update: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Reservation status updated successfully.');
    }

    /**
     * Remove the specified reservation from storage.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
