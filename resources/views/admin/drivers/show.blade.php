@extends('layouts.admin')

@section('admin_title', 'Driver Profile')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.drivers.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Registry
        </a>
        <div class="flex justify-between items-end">
            <div class="flex items-center gap-6">
                @if ($driver->profile_picture)
                    <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                        style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 4px solid var(--primary);">
                @else
                    <div
                        style="width: 100px; height: 100px; border-radius: 50%; background: var(--glass-05); display: flex; align-items: center; justify-content: center; border: 4px solid var(--glass-border);">
                        <i data-lucide="user" style="width: 48px; height: 48px; color: var(--text-muted);"></i>
                    </div>
                @endif
                <div>
                    <h1 class="text-2xl font-extrabold" style="font-size: 3rem;">{{ $driver->name }}</h1>
                    <p class="text-lg text-muted mt-2">License: <span
                            class="text-main font-bold">{{ $driver->license_number }}</span> |
                        {{ $driver->experience_years }} Years Experience</p>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-outline"
                    style="padding: 0.8rem 1.5rem;">Edit Profile</a>
                <span class="badge"
                    style="
                    padding: 0.8rem 1.5rem; 
                    font-size: 0.85rem;
                    @if ($driver->status == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                    @elseif($driver->status == 'On Trip') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                    @else background: rgba(156, 163, 175, 0.1); color: #9ca3af; @endif
                ">{{ $driver->status }}</span>
            </div>
        </div>
    </div>

    <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 3rem;">
        <!-- Left: Bio & Documents -->
        <div>
            <div class="glass-card p-12 mb-8">
                <h3 class="text-lg font-bold mb-6">Professional Biography</h3>
                <div class="text-muted leading-relaxed" style="font-size: 1.1rem;">
                    {{ $driver->biography ?: 'No biography content provided for this driver.' }}
                </div>
            </div>

            <div class="glass-card p-12">
                <h3 class="text-lg font-bold mb-6">Contact Information</h3>
                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <div class="p-8" style="background: var(--glass-05); border-radius: 16px;">
                        <span class="text-xs font-bold text-muted uppercase tracking-widest mb-2 block">Phone</span>
                        <p class="text-lg font-bold">{{ $driver->phone }}</p>
                    </div>
                    <div class="p-8" style="background: var(--glass-05); border-radius: 16px;">
                        <span class="text-xs font-bold text-muted uppercase tracking-widest mb-2 block">Email</span>
                        <p class="text-lg font-bold">{{ $driver->email ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Rates & Performance -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 bg-primary"
                style="background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%); color: white;">
                <h3 class="text-lg font-bold mb-4">Earnings Multiplier</h3>
                <p class="text-sm mb-6 opacity-80">Daily base rate for chauffeur services (exclusive of vehicle rental).</p>
                <div class="flex items-end gap-2">
                    <span class="text-4xl font-extrabold">${{ number_format($driver->base_rate, 2) }}</span>
                    <span class="text-sm font-bold opacity-80 mb-2">/ Day</span>
                </div>
            </div>

            <div class="glass-card p-10">
                <h3 class="text-lg font-bold mb-6">Recent Activity</h3>
                <div class="flex flex-col gap-4">
                    <div class="text-center p-12 text-muted"
                        style="border: 1px dashed var(--glass-border); border-radius: 12px;">
                        <i data-lucide="history" class="mx-auto mb-2 opacity-20"></i>
                        <p class="text-xs">No recent drive history found.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
