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

                // TRIGGER REFUND (ESCROW LOGIC)
                $payment = \App\Models\Payment::where('reservation_id', $reservation->id)
                    ->where('type', 'Deposit')
                    ->where('status', 'Successful') // Assuming we check status before or it's updated via callback
                    ->first();

                if ($payment) {
                    $campay = new \App\Services\CampayService();
                    $refundResponse = $campay->withdraw($payment->phone_number, $payment->amount, "Refund for Declined Reservation #{$reservation->id}");

                    if ($refundResponse && isset($refundResponse['reference'])) {
                        \App\Models\Payment::create([
                            'reservation_id' => $reservation->id,
                            'amount' => $payment->amount,
                            'phone_number' => $payment->phone_number,
                            'external_reference' => $refundResponse['reference'],
                            'status' => 'Pending',
                            'type' => 'Refund',
                        ]);
                    }
                }
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
