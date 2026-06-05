@extends('layouts.app')

@section('title', 'Professional Drivers | LuxDrive')

@section('content')
    <section class="section section-top">
        <div class="container">
            <div class="mb-16">
                <h1 class="mb-4">Professional <span class="text-gradient">Chauffeurs</span></h1>
                <p class="text-lg text-muted">Hire our elite, highly-trained drivers for a safe and prestigious travel
                    experience. Available for any duration.</p>
            </div>

            <!-- Filters -->
            <div class="glass-card p-8 mb-16">
                <div class="filter-bar">
                    <div class="filter-group">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Experience
                            Level</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <select
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem; appearance: none;">
                                <option value="all">All Levels</option>
                                <option value="5-10">5-10 Years</option>
                                <option value="10+">10+ Years</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-select">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Language</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <select
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem; appearance: none;">
                                <option value="en">English</option>
                                <option value="fr">French</option>
                                <option value="de">German</option>
                            </select>
                        </div>
                    </div>

                    <div class="align-end">
                        <button class="btn btn-primary h-52 p-8" style="padding: 0 2rem;">Search Drivers</button>
                    </div>
                </div>
            </div>

            <!-- Drivers Grid -->
            <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
                @forelse ($drivers as $driver)
                    <div class="glass-card" style="padding: 2.5rem; text-align: center;">
                        @if ($driver->profile_picture)
                            <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                                style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); margin: 0 auto 1.5rem; object-fit: cover;">
                        @else
                            <div class="mx-auto mb-6 flex items-center justify-center bg-glass-10"
                                style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--glass-border);">
                                <i data-lucide="user" style="width: 48px; height: 48px;"></i>
                            </div>
                        @endif
                        <h3 class="mb-2">{{ $driver->name }}</h3>
                        <p class="text-sm font-bold" style="color: var(--primary); margin-bottom: 0.5rem;">
                            @foreach ($driver->categories as $cat)
                                {{ $cat->name }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                        </p>

                        <div class="flex justify-center gap-4 mb-8">
                            <div style="text-align: left;">
                                <span class="text-xs text-muted uppercase font-bold"
                                    style="display: block;">Experience</span>
                                <span class="text-sm font-bold">{{ $driver->experience_years }} Years</span>
                            </div>
                            <div
                                style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 1rem; text-align: left;">
                                <span class="text-xs text-muted uppercase font-bold"
                                    style="display: block;">Expertise</span>
                                <span class="text-sm font-bold">Verified</span>
                            </div>
                        </div>

                        <div class="mb-8 p-4" style="background: rgba(255,255,255,0.03); border-radius: 12px;">
                            <span class="text-muted text-xs uppercase font-bold">Daily Rate</span>
                            <div class="text-2xl font-extrabold">{{ number_format($driver->base_rate, 0) }} FCFA</div>
                        </div>

                        <a href="{{ route('vehicles.index') }}" class="btn btn-primary full-width">Rent with
                            {{ explode(' ', $driver->name)[0] }}</a>
                    </div>
                @empty
                    <div class="col-span-full text-center p-20 glass-card">
                        <i data-lucide="users-2" class="mx-auto mb-4 text-muted" style="width: 48px; height: 48px;"></i>
                        <h3 class="text-lg font-bold">No Drivers Available</h3>
                        <p class="text-muted mt-2">Check back later for available professional chauffeurs.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $drivers->links() }}
            </div>
        </div>
        </div>
    </section>
@endsection
