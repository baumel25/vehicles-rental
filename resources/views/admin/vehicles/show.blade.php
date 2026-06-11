@extends('layouts.admin')

@section('admin_title', 'Vehicle Details')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
        </a>
        <div class="flex justify-between items-end">
            <div>
                <span class="badge" style="background: rgba(62, 123, 250, 0.1); color: var(--primary); margin-bottom: 1rem;">
                    {{ $vehicle->category->name }}
                    @if ($vehicle->subCategory)
                        / {{ $vehicle->subCategory->name }}
                    @endif
                </span>
                <h1 class="text-2xl font-extrabold" style="font-size: 3rem;">{{ $vehicle->name }}</h1>
                <p class="text-lg text-muted mt-2">Registered in {{ $vehicle->model_year }} | Daily Rate: <span
                        class="text-primary font-bold">{{ number_format($vehicle->daily_rate, 0) }} FCFA</span></p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-outline"
                    style="padding: 0.8rem 1.5rem;">Edit Specs</a>
                <span class="badge"
                    style="
                    padding: 0.8rem 1.5rem; 
                    font-size: 0.85rem;
                    @if ($vehicle->status == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                    @elseif($vehicle->status == 'Maintenance') background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                    @else background: rgba(239, 68, 68, 0.1); color: #ef4444; @endif
                ">{{ $vehicle->status }}
                    ({{ $vehicle->quantity }} Units)</span>
            </div>
        </div>
    </div>

    <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 3rem;">
        <!-- Left Column: Gallery & Description -->
        <div>
            <div class="glass-card p-12 mb-8">
                <h3 class="text-lg font-bold mb-8">Visual Assets</h3>
                <div class="mb-6">
                    @if ($vehicle->thumbnail)
                        <img src="{{ asset('storage/' . $vehicle->thumbnail) }}"
                            style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                    @else
                        <div style="width: 100%; aspect-ratio: 16/9; border-radius: 20px; background: var(--bg-card); display: flex; flex-direction: column; align-items: center; justify-content: center; border: 2px dashed var(--border); gap: 1rem;">
                            <i data-lucide="image-off" style="width: 48px; height: 48px; color: var(--text-muted);"></i>
                            <p class="text-muted font-bold">No image uploaded yet</p>
                        </div>
                    @endif
                </div>
                <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1.5rem;">
                    @foreach ($vehicle->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 12px; cursor: pointer; transition: 0.3s;"
                            onclick="this.parentElement.previousElementSibling.firstElementChild.src = this.src">
                    @endforeach
                </div>
            </div>

            <div class="glass-card p-12">
                <h3 class="text-lg font-bold mb-6">Description & Features</h3>
                <div class="text-muted leading-relaxed">
                    {{ $vehicle->description ?: 'No description provided for this vehicle.' }}
                </div>
            </div>
        </div>

        <!-- Right Column: Quick Specs -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10">
                <h3 class="text-lg font-bold mb-8">Technical Specifications</h3>
                <div class="flex flex-col gap-6">
                    <div class="flex justify-between items-center pb-4"
                        style="border-bottom: 1px solid var(--glass-border);">
                        <span class="text-muted font-bold text-xs uppercase">Fuel Type</span>
                        <span class="font-bold">{{ $vehicle->fuel_type ?: 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4"
                        style="border-bottom: 1px solid var(--glass-border);">
                        <span class="text-muted font-bold text-xs uppercase">Transmission</span>
                        <span class="font-bold">{{ $vehicle->transmission ?: 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-4"
                        style="border-bottom: 1px solid var(--glass-border);">
                        <span class="text-muted font-bold text-xs uppercase">Seats</span>
                        <span class="font-bold">{{ $vehicle->seating_capacity ?: 'N/A' }} People</span>
                    </div>
                    <div class="flex justify-between items-center pb-4"
                        style="border-bottom: 1px solid var(--glass-border);">
                        <span class="text-muted font-bold text-xs uppercase">Power Class</span>
                        <span class="font-bold">Premium</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-10 bg-primary"
                style="background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%); color: white;">
                <h3 class="text-lg font-bold mb-4">Availability Summary</h3>
                <p class="text-sm mb-6 opacity-80">Current fleet inventory status for this model across all regions.</p>
                <div class="flex items-end gap-2 mb-2">
                    <span class="text-4xl font-extrabold">{{ $vehicle->quantity }}</span>
                    <span class="text-sm font-bold opacity-80 mb-2">Units in Fleet</span>
                </div>
                <div class="text-xs font-bold opacity-80 uppercase tracking-widest">
                    Status: {{ $vehicle->status }}
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card mt-12 p-12">
        <div class="flex justify-between items-center mb-10">
            <div>
                <h3 class="text-xl font-extrabold">Reservation History</h3>
                <p class="text-xs text-muted mt-1 uppercase tracking-widest font-bold">Past and upcoming bookings for this
                    vehicle</p>
            </div>
            <div class="qty-badge bg-glass-10 px-4 py-2 rounded-lg font-bold text-xs uppercase">
                <i data-lucide="info" class="icon-xs inline-block mr-1"></i>
                {{ $vehicle->reservations->count() }} Total Bookings
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date Requested</th>
                        <th>Customer</th>
                        <th>Chauffeur</th>
                        <th>Rental Period</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vehicle->reservations as $res)
                        <tr>
                            <td class="text-xs text-muted">{{ $res->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="font-bold text-sm">{{ $res->user->name }}</div>
                                <div class="text-[10px] text-muted">{{ $res->user->email }}</div>
                            </td>
                            <td>
                                @if ($res->driver)
                                    <span class="badge text-[10px]"
                                        style="background: rgba(var(--primary-rgb), 0.1); color: var(--primary);">{{ $res->driver->name }}</span>
                                @else
                                    <span class="text-[10px] text-muted italic">Self-Drive</span>
                                @endif
                            </td>
                            <td class="text-xs font-bold">{{ $res->pickup_date->format('M d') }} -
                                {{ $res->return_date->format('M d, Y') }}</td>
                            <td class="font-extrabold text-sm">${{ number_format($res->total_price, 0) }}</td>
                            <td>
                                @php
                                    $sClass = match ($res->status) {
                                        'Pending' => 'bg-amber-500/20 text-amber-500',
                                        'Confirmed' => 'bg-green-500/20 text-green-500',
                                        'Cancelled' => 'bg-red-500/20 text-red-500',
                                        'Completed' => 'bg-blue-500/20 text-blue-500',
                                        default => 'bg-blue-500/20 text-blue-500',
                                    };
                                @endphp
                                <span class="px-2 py-1 rounded-full text-[9px] font-bold {{ $sClass }}">
                                    {{ $res->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.reservations.show', $res->id) }}" class="btn-icon">
                                    <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center p-12 text-muted italic">No reservation history for this
                                vehicle.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
