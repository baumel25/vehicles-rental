@extends('layouts.admin')

@section('admin_title', 'Chauffeur Registry')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Professional Drivers</h3>
            <p class="text-xs text-muted font-bold mt-2">Manage driver profiles, availability, and ratings</p>
        </div>
        <a href="/admin/drivers/create" class="btn btn-primary" style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
            <i data-lucide="user-plus" class="icon-sm" style="margin-right: 0.5rem;"></i> Add Driver
        </a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Driver</th>
                    <th>Specialty</th>
                    <th>Experience</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($drivers as $driver)
                    <tr>
                        <td class="font-bold">
                            <div class="flex items-center gap-3">
                                @if ($driver->profile_picture)
                                    <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <div
                                        style="width: 40px; height: 40px; border-radius: 50%; background: var(--glass-05); display: flex; align-items: center; justify-content: center;">
                                        <i data-lucide="user" class="icon-sm"></i>
                                    </div>
                                @endif
                                {{ $driver->name }}
                            </div>
                        </td>
                        <td class="text-muted">{{ $driver->license_number }}</td>
                        <td class="font-bold">{{ $driver->experience_years }} Yrs</td>
                        <td class="font-bold" style="color: var(--secondary);">$ {{ number_format($driver->base_rate, 2) }}
                        </td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($driver->status == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                            @elseif($driver->status == 'On Trip') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                            @else background: rgba(156, 163, 175, 0.1); color: #9ca3af; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $driver->status }}</span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn-info"
                                    style="color: var(--primary);">
                                    <i data-lucide="eye" class="icon-sm"></i>
                                </a>
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn-info"
                                    style="color: var(--text-muted);">
                                    <i data-lucide="edit-3" class="icon-sm"></i>
                                </a>
                                <form action="{{ route('admin.drivers.delete', $driver->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this driver registration?')">
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
                        <td colspan="6" class="text-center p-10 text-muted">No drivers registered in the registry yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
