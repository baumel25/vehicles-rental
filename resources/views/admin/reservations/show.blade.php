@extends('layouts.admin')

@section('admin_title', 'Reservation Details')

@section('admin_content')
    <div class="mb-10">
        <a href="{{ route('admin.reservations.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold text-sm">
            <i data-lucide="arrow-left" class="icon-xs"></i> Back to Reservations
        </a>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-extrabold">Reservation #RE{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}</h1>
            <div class="flex gap-4">
                @if ($reservation->status === 'Pending')
                    <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Confirmed">
                        <button type="submit" class="btn btn-primary" style="background: #10b981;">Approve Booking</button>
                    </form>
                    <form action="{{ route('admin.reservations.updateStatus', $reservation->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to decline this reservation?')">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Cancelled">
                        <button type="submit" class="btn btn-outline"
                            style="border-color: #ef4444; color: #ef4444;">Decline Booking</button>
                    </form>
                @endif
                <form action="{{ route('admin.reservations.delete', $reservation->id) }}" method="POST"
                    onsubmit="return confirm('WARNING: Are you sure you want to PERMANENTLY delete this record?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-icon" style="color: #ef4444;"><i data-lucide="trash-2"></i></button>
                </form>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-500/10 border border-green-500/50 p-4 rounded-xl mb-8 flex items-center gap-3 animate-fade-in">
            <i data-lucide="check-circle" class="text-green-500 icon-sm"></i>
            <span class="text-green-500 font-bold text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
        <div class="space-y-8">
            <!-- Details Card -->
            <div class="glass-card">
                <div class="flex justify-between items-center mb-8 pb-4"
                    style="border-bottom: 1px solid var(--glass-border);">
                    <h3 class="text-lg font-bold">Booking Summary</h3>
                    @php
                        $statusClass = match ($reservation->status) {
                            'Pending' => 'bg-amber-500/20 text-amber-500',
                            'Confirmed' => 'bg-green-500/20 text-green-500',
                            'Cancelled' => 'bg-red-500/20 text-red-500',
                            'Completed' => 'bg-blue-500/20 text-blue-500',
                            default => 'bg-blue-500/20 text-blue-500',
                        };
                    @endphp
                    <span class="px-4 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                        {{ $reservation->status }}
                    </span>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 3rem;">
                    <div>
                        <span class="text-xs font-bold text-muted uppercase block mb-2">Duration</span>
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="text-sm font-bold">{{ $reservation->pickup_date->format('l, M d, Y') }}</div>
                                <div class="text-xs text-muted">Pick-up</div>
                            </div>
                            <i data-lucide="arrow-right" class="text-muted icon-xs"></i>
                            <div>
                                <div class="text-sm font-bold">{{ $reservation->return_date->format('l, M d, Y') }}</div>
                                <div class="text-xs text-muted">Return</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-muted uppercase block mb-2">Total Amount</span>
                        <div class="text-3xl font-extrabold text-primary">
                            ${{ number_format($reservation->total_price, 0) }}</div>
                    </div>
                </div>

                <div class="mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                    <h4 class="text-sm font-bold mb-4">Customer Details</h4>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-glass-10 flex items-center justify-center font-bold text-primary">
                            {{ substr($reservation->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-bold">{{ $reservation->user->name }}</div>
                            <div class="text-xs text-muted">{{ $reservation->user->email }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle & Driver info -->
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="glass-card">
                    <h3 class="text-sm font-bold text-muted uppercase mb-6">Assigned Vehicle</h3>
                    <img src="{{ asset('storage/' . $reservation->vehicle->thumbnail) }}"
                        style="width: 100%; height: 120px; border-radius: 12px; object-fit: cover; margin-bottom: 1rem;">
                    <div class="font-bold">{{ $reservation->vehicle->name }}</div>
                    <div class="text-xs text-muted">{{ $reservation->vehicle->category->name }} |
                        ${{ number_format($reservation->vehicle->daily_rate, 0) }}/day</div>
                </div>
                <div class="glass-card">
                    <h3 class="text-sm font-bold text-muted uppercase mb-6">Chauffeur Service</h3>
                    @if ($reservation->driver)
                        <div class="flex items-center gap-4">
                            @if ($reservation->driver->profile_picture)
                                <img src="{{ asset('storage/' . $reservation->driver->profile_picture) }}"
                                    style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                            @else
                                <div class="w-15 h-15 rounded-full bg-glass-10 flex items-center justify-center"><i
                                        data-lucide="user"></i></div>
                            @endif
                            <div>
                                <div class="font-bold">{{ $reservation->driver->name }}</div>
                                <div class="text-xs text-muted">
                                    ${{ number_format($reservation->driver->base_rate, 0) }}/day Service</div>
                            </div>
                        </div>
                    @else
                        <div class="p-4 bg-glass-05 rounded-xl text-center text-xs text-muted italic">Self-Drive Option
                            Selected</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="sidebar-info">
            <div class="glass-card mb-8">
                <h3 class="font-bold mb-4">Quick Actions</h3>
                <div class="grid gap-4">
                    <button class="btn btn-outline full-width text-sm py-4" onclick="window.print()"><i
                            data-lucide="printer" class="icon-xs mr-2"></i> Print Invoice</button>
                    <a href="mailto:{{ $reservation->user->email }}" class="btn btn-outline full-width text-sm py-4"><i
                            data-lucide="mail" class="icon-xs mr-2"></i> Email Customer</a>
                </div>
            </div>

            <div class="glass-card">
                <h3 class="font-bold mb-4 text-xs uppercase text-muted">Internal Notes</h3>
                <p class="text-xs text-muted italic">{{ $reservation->notes ?? 'No internal notes for this reservation.' }}
                </p>
            </div>
        </div>
    </div>
@endsection
