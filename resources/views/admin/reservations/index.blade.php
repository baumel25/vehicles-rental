@extends('layouts.admin')

@section('admin_title', 'Reservations Management')

@section('admin_content')
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-extrabold mb-1">Reservations</h1>
            <p class="text-muted text-sm">Manage customer bookings and luxury fleet schedule.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-500/10 border border-green-500/50 p-4 rounded-xl mb-8 flex items-center gap-3 animate-fade-in">
            <i data-lucide="check-circle" class="text-green-500 icon-sm"></i>
            <span class="text-green-500 font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="glass-card p-0" style="overflow: hidden;">
        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Vehicle</th>
                        <th>Chauffeur</th>
                        <th>Period</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $reservation)
                        <tr>
                            <td><span
                                    class="font-bold text-xs uppercase">#RE{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <div class="font-bold text-sm">{{ $reservation->user->name }}</div>
                                <div class="text-xs text-muted">{{ $reservation->user->email }}</div>
                            </td>
                          <td>
    @if($reservation->vehicle && $reservation->vehicle->thumbnail)
        <img src="{{ $reservation->vehicle->thumbnail }}" width="50" alt="Vehicle">
    @else
        <img src="{{ asset('images/default-vehicle.png') }}" width="50" alt="No image">
    @endif
</td>
                            <td>
                                @if ($reservation->driver)
                                    <span class="badge text-xs"
                                        style="background: rgba(var(--primary-rgb), 0.1); color: var(--primary);">{{ $reservation->driver->name }}</span>
                                @else
                                    <span class="text-xs text-muted italic">Self-Drive</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-xs font-bold">{{ $reservation->pickup_date->format('M d') }} -
                                    {{ $reservation->return_date->format('M d, Y') }}</div>
                            </td>
                            <td><span
                                    class="text-sm font-extrabold">${{ number_format($reservation->total_price, 0) }}</span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match ($reservation->status) {
                                        'Pending' => 'bg-amber-500/20 text-amber-500',
                                        'Confirmed' => 'bg-green-500/20 text-green-500',
                                        'Cancelled' => 'bg-red-500/20 text-red-500',
                                        'Completed' => 'bg-blue-500/20 text-blue-500',
                                        default => 'bg-blue-500/20 text-blue-500',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-[10px] font-bold {{ $statusClass }}">
                                    {{ $reservation->status }}
                                </span>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="btn-icon"
                                        title="View Reservation">
                                        <i data-lucide="eye" style="width: 16px; height: 16px;"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-12 text-muted italic">No reservations found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-8">
        {{ $reservations->links() }}
    </div>
@endsection
