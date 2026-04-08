@extends('layouts.admin')

@section('admin_title', 'Fleet Management')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Manage Vehicle Fleet</h3>
            <p class="text-xs text-muted font-bold mt-2">Update inventory, pricing, and vehicle status</p>
        </div>
        <a href="/admin/vehicles/create" class="btn btn-primary" style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
            <i data-lucide="plus" class="icon-sm" style="margin-right: 0.5rem;"></i> Add New Vehicle
        </a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Price/Day</th>
                    <th>Inventory</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr>
                        <td class="font-bold">
                            <div class="flex items-center gap-3">
                                @if ($vehicle->thumbnail)
                                    <img src="{{ asset('storage/' . $vehicle->thumbnail) }}"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                @endif
                                {{ $vehicle->name }}
                            </div>
                        </td>
                        <td class="text-muted">
                            {{ $vehicle->category->name }}
                            @if ($vehicle->subCategory)
                                <br><small>{{ $vehicle->subCategory->name }}</small>
                            @endif
                        </td>
                        <td class="font-bold">${{ number_format($vehicle->daily_rate, 2) }}</td>
                        <td class="font-bold">{{ $vehicle->quantity }} Units</td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($vehicle->status == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                            @elseif($vehicle->status == 'Maintenance') background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                            @else background: rgba(239, 68, 68, 0.1); color: #ef4444; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $vehicle->status }}</span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="btn-info"
                                    style="color: var(--primary);">
                                    <i data-lucide="eye" class="icon-sm"></i>
                                </a>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn-info"
                                    style="color: var(--text-muted);">
                                    <i data-lucide="edit-3" class="icon-sm"></i>
                                </a>
                                <form action="{{ route('admin.vehicles.delete', $vehicle->id) }}" method="POST"
                                    onsubmit="return confirm('Remove this vehicle from the fleet?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-info"
                                        style="color: #ef4444; background: transparent; border: none; cursor: pointer;">
                                        <i data-lucide="trash-2" class="icon-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center p-10 text-muted">No vehicles registered in the fleet yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
