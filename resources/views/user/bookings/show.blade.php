@extends('layouts.app')

@section('title', 'Booking Details | LuxDrive')

@section('content')
    <section class="section">
        <div class="container">
            <a href="{{ route('bookings.index') }}" class="flex items-center gap-2 text-muted mb-10 font-bold">
                <i data-lucide="arrow-left" class="icon-sm"></i> Back to My Bookings
            </a>

            <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 3rem;">
                <!-- Booking Information -->
                <div>
                    <div class="glass-card mb-8">
                        <div class="flex justify-between items-center mb-8 pb-8"
                            style="border-bottom: 1px solid var(--glass-border);">
                            <div>
                                <span class="text-xs font-bold text-muted uppercase">Booking Status</span>
                                <div class="mt-2">
                                    @php
                                        $statusClass = match ($booking->status) {
                                            'Pending' => 'bg-amber-500/20 text-amber-500 border border-amber-500/50',
                                            'Confirmed' => 'bg-green-500/20 text-green-500 border border-green-500/50',
                                            'Cancelled' => 'bg-red-500/20 text-red-500 border border-red-500/50',
                                            default => 'bg-blue-500/20 text-blue-500 border border-blue-500/50',
                                        };
                                    @endphp
                                    <span class="px-6 py-2 rounded-xl text-sm font-bold {{ $statusClass }}">
                                        {{ $booking->status }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-xs font-bold text-muted uppercase">Reservation ID</span>
                                <div class="text-2xl font-extrabold mt-1">
                                    #RE{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>

                        <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 4rem;">
                            <div>
                                <h3 class="text-lg font-bold mb-6">Reservation Period</h3>
                                <div class="flex gap-8">
                                    <div>
                                        <span class="text-xs font-bold text-muted uppercase">Pick-up</span>
                                        <div class="text-lg font-bold mt-1">
                                            {{ \Carbon\Carbon::parse($booking->pickup_date)->format('M d, Y') }}</div>
                                        <div class="text-sm text-muted">10:00 AM</div>
                                    </div>
                                    <div class="flex items-center text-primary">
                                        <i data-lucide="arrow-right"></i>
                                    </div>
                                    <div>
                                        <span class="text-xs font-bold text-muted uppercase">Return</span>
                                        <div class="text-lg font-bold mt-1">
                                            {{ \Carbon\Carbon::parse($booking->return_date)->format('M d, Y') }}</div>
                                        <div class="text-sm text-muted">10:00 AM</div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-6">Pricing Breakdown</h3>
                                <div class="space-y-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-muted">Vehicle Rental</span>
                                        <span class="font-bold">{{ number_format($booking->vehicle->daily_rate, 0) }} FCFA /
                                            day</span>
                                    </div>
                                    @if ($booking->driver)
                                        <div class="flex justify-between text-sm">
                                            <span class="text-muted">Chauffeur Service</span>
                                            <span class="font-bold">{{ number_format($booking->driver->base_rate, 0) }} FCFA /
                                                day</span>
                                        </div>
                                    @endif
                                    <div class="flex justify-between text-lg font-extrabold pt-4"
                                        style="border-top: 1px solid var(--glass-border);">
                                        <span>Total Paid</span>
                                        <span class="text-primary">{{ number_format($booking->total_price, 0) }} FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="glass-card">
                        <h3 class="text-lg font-bold mb-8">Important Information</h3>
                        <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                            <div class="flex gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-glass-10 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="file-text" class="text-primary icon-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm mb-1">Documents Required</h4>
                                    <p class="text-xs text-muted leading-relaxed">Please bring your original Driver's
                                        License and National ID/Passport for verification at pick-up.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-12 h-12 rounded-xl bg-glass-10 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="clock" class="text-primary icon-sm"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm mb-1">Pick-up Time</h4>
                                    <p class="text-xs text-muted leading-relaxed">Late pick-ups beyond 2 hours without
                                        notification may lead to reservation cancellation.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle & Driver Cards -->
                <div class="space-y-8">
                    <div class="glass-card p-0" style="overflow: hidden;">
                        <img src="{{ asset('storage/' . $booking->vehicle->thumbnail) }}"
                            style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="p-8">
                            <span class="badge mb-2">{{ $booking->vehicle->category->name }}</span>
                            <h3 class="text-xl font-bold mb-2">{{ $booking->vehicle->name }}</h3>
                            <p class="text-xs text-muted mb-6">Transmission: {{ $booking->vehicle->transmission }} • Fuel:
                                {{ $booking->vehicle->fuel_type }}</p>
                            <a href="{{ route('vehicles.show', $booking->vehicle->slug) }}"
                                class="btn btn-outline full-width small-btn">View Vehicle Details</a>
                        </div>
                    </div>

                    @if ($booking->driver)
                        <div class="glass-card p-8 flex items-center gap-6">
                            @if ($booking->driver->profile_picture)
                                <img src="{{ asset('storage/' . $booking->driver->profile_picture) }}"
                                    style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                            @else
                                <div
                                    class="w-20 h-20 rounded-full bg-glass-10 flex items-center justify-center border-2 border-primary">
                                    <i data-lucide="user"></i>
                                </div>
                            @endif
                            <div class="flex-1">
                                <span class="text-xs font-bold text-primary uppercase">Assigned Chauffeur</span>
                                <h3 class="text-lg font-bold">{{ $booking->driver->name }}</h3>
                                <div class="flex items-center gap-2 text-xs text-muted mt-1">
                                    <i data-lucide="shield-check" class="icon-xs text-green-500"></i>
                                    Verified Professional
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($booking->status === 'Pending')
                        <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to cancel this reservation?')">
                            @csrf
                            <button type="submit" class="btn btn-primary full-width"
                                style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.5);">
                                Cancel Reservation
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
