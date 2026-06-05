@extends('layouts.app')

@section('title', 'My Bookings | LuxDrive')

@section('content')
    <section class="section">
        <div class="container">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="mb-2">My <span class="text-gradient">Bookings</span></h1>
                    <p class="text-muted">Track and manage your vehicle reservations.</p>
                </div>
                <a href="{{ route('vehicles.index') }}" class="btn btn-outline">Explore More Vehicles</a>
            </div>

            @if (session('success'))
                <div
                    class="bg-green-500/10 border border-green-500/50 p-6 rounded-2xl mb-12 flex items-center gap-4 animate-fade-in">
                    <i data-lucide="check-circle" class="text-green-500"></i>
                    <span class="text-green-500 font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass-card p-0" style="overflow: hidden;">
                <div style="overflow-x: auto;">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Vehicle</th>
                                <th>Dates</th>
                                <th>Chauffeur</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bookings as $booking)
                                <tr>
                                    <td><span class="font-bold">#RE{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('storage/' . $booking->vehicle->thumbnail) }}"
                                                style="width: 50px; height: 35px; border-radius: 6px; object-fit: cover;">
                                            <span class="font-bold">{{ $booking->vehicle->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-sm">
                                            <div class="font-bold">{{ $booking->pickup_date->format('M d, Y') }}</div>
                                            <div class="text-muted">to {{ $booking->return_date->format('M d, Y') }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($booking->driver)
                                            <span class="badge"
                                                style="background: rgba(var(--primary-rgb), 0.1); color: var(--primary);">{{ $booking->driver->name }}</span>
                                        @else
                                            <span class="text-muted text-xs italic">Self Drive</span>
                                        @endif
                                    </td>
                                    <td><span
                                            class="font-extrabold text-lg">{{ number_format($booking->total_price, 0) }} FCFA</span>
                                    </td>
                                    <td>
                                        @php
                                            $statusClass = match ($booking->status) {
                                                'Pending' => 'bg-amber-500/20 text-amber-500',
                                                'Confirmed' => 'bg-green-500/20 text-green-500',
                                                'Cancelled' => 'bg-red-500/20 text-red-500',
                                                default => 'bg-blue-500/20 text-blue-500',
                                            };
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn-icon"
                                                title="View Details">
                                                <i data-lucide="eye" style="width: 18px; height: 18px;"></i>
                                            </a>

                                            @php
                                                $pendingDeposit = $booking->payments
                                                    ->where('type', 'Deposit')
                                                    ->where('status', 'Pending')
                                                    ->first();
                                            @endphp

                                            @if ($pendingDeposit)
                                                <a href="{{ route('payments.verify', $booking->id) }}" class="btn-icon"
                                                    style="color: var(--primary);" title="Verify Payment Status">
                                                    <i data-lucide="refresh-cw" style="width: 18px; height: 18px;"></i>
                                                </a>
                                            @endif

                                            @if ($booking->status === 'Pending')
                                                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                    @csrf
                                                    <button type="submit" class="btn-icon" style="color: #ef4444;"
                                                        title="Cancel Booking">
                                                        <i data-lucide="x-circle" style="width: 18px; height: 18px;"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center p-12">
                                        <div class="text-muted italic">You haven't made any reservations yet.</div>
                                        <a href="{{ route('vehicles.index') }}" class="btn btn-primary mt-6">Book Your
                                            First Ride</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        </div>
    </section>
@endsection
