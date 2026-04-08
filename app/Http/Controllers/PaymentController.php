<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use App\Services\CampayService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Verify payment status manually (polling)
     */
    public function verify($reservation_id)
    {
        $reservation = Reservation::where('user_id', auth()->id())->findOrFail($reservation_id);
        $payment = Payment::where('reservation_id', $reservation->id)
            ->where('type', 'Deposit')
            ->latest()
            ->first();

        if (!$payment) {
            return back()->with('error', 'No payment record found for this reservation.');
        }

        if ($payment->status === 'Successful') {
            return back()->with('success', 'Payment already confirmed!');
        }

        $campay = new CampayService();
        $status = $campay->getStatus($payment->external_reference);

        if ($status && isset($status['status'])) {
            if ($status['status'] === 'SUCCESSFUL') {
                $payment->update(['status' => 'Successful']);
                return back()->with('success', 'Payment confirmed successfully!');
            } elseif ($status['status'] === 'FAILED') {
                $payment->update(['status' => 'Failed']);
                return back()->with('error', 'Payment failed. Please try again.');
            }
        }

        return back()->with('info', 'Payment is still processing. Please wait a moment.');
    }

    /**
     * Campay Webhook / Callback (Optional but good)
     */
    public function callback(Request $request)
    {
        Log::info('Campay Callback Received:', $request->all());

        // Campay sends reference and status
        $reference = $request->input('reference');
        $status = $request->input('status');

        $payment = Payment::where('external_reference', $reference)->first();

        if ($payment) {
            if ($status === 'SUCCESSFUL') {
                $payment->update(['status' => 'Successful']);
            } elseif ($status === 'FAILED') {
                $payment->update(['status' => 'Failed']);
            }
        }

        return response()->json(['message' => 'OK']);
    }
}
