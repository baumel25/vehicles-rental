@extends('layouts.app')

@section('title', 'Explore Our Fleet | LuxDrive')

@section('content')
    <section class="section section-top">
        <div class="container">
            <div class="mb-16">
                <h1 class="mb-4" style="font-size: 3.5rem;">Our Premium <span class="text-gradient">Fleet</span></h1>
                <p class="text-lg text-muted">Choose from our curated collection of world-class vehicles. Limited
                    availability, reserve your drive today.</p>
            </div>

            <!-- Mobile Filter Toggle -->
            <button class="filter-toggle" id="filterOpen">
                <i data-lucide="sliders" class="icon-sm"></i>
                Filter Vehicles
            </button>

            <!-- Filters Sidebar Overlay (Mobile) -->
            <div class="mobile-menu-overlay" id="filterOverlay"></div>

            <!-- Filters -->
            <div class="glass-card p-8 mb-16 filter-sidebar" id="filterSidebar">
                <button class="mobile-close" id="filterClose" style="display: none;">
                    <i data-lucide="x"></i>
                </button>

                <form action="{{ route('vehicles.index') }}" method="GET" class="filter-bar">
                    <div class="filter-group">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Search
                            Vehicle</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <i data-lucide="search" class="icon-sm" style="color: var(--primary);"></i>
                            <input type="text" name="search" placeholder="Search make or model..."
                                value="{{ request('search') }}"
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem;">
                        </div>
                    </div>

                    <div class="filter-select">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Vehicle
                            Category</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <select name="category"
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem;">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}"
                                        {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="align-end">
                        <button type="submit" class="btn btn-primary h-52 p-8" style="padding: 0 2rem;">Apply
                            Filters</button>
                    </div>
                </form>
            </div>

            <!-- Grid -->
            <div class="vehicle-grid">
                @forelse ($vehicles as $vehicle)
                    <div class="glass-card" style="padding: 0; overflow: hidden;">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}">
                            <div class="price-tag">{{ number_format($vehicle->daily_rate, 0) }} FCFA / jour</div>

                            <div
                                style="position: absolute; top: 1rem; right: 1rem; background: var(--primary); padding: 0.3rem 0.7rem; border-radius: 8px; font-size: 0.7rem; font-weight: 700;">
                                {{ $vehicle->quantity }} Available
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $vehicle->name }}</h3>
                            <p class="card-subtitle">{{ $vehicle->category->name }}</p>

                            <div class="specs-grid">
                                <div class="spec-item">
                                    <i data-lucide="users"></i>
                                    <span>{{ $vehicle->seating_capacity }} Seats</span>
                                </div>
                                <div class="spec-item">
                                    <i data-lucide="zap"></i>
                                    <span>{{ $vehicle->transmission }}</span>
                                </div>
                                <div class="spec-item">
                                    <i data-lucide="droplet"></i>
                                    <span>{{ $vehicle->fuel_type }}</span>
                                </div>
                            </div>

                            <a href="{{ route('vehicles.show', $vehicle->slug) }}"
                                class="btn btn-primary full-width small-btn">Rent This
                                Vehicle</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center p-20 glass-card">
                        <i data-lucide="search-x" class="mx-auto mb-4 text-muted" style="width: 48px; height: 48px;"></i>
                        <h3 class="text-lg font-bold">No Vehicles Found</h3>
                        <p class="text-muted mt-2">Try adjusting your filters or search keywords.</p>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline mt-8">Clear All Filters</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-16">
                {{ $vehicles->appends(request()->query())->links() }}
            </div>
        </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const filterOpen = document.getElementById('filterOpen');
            const filterClose = document.getElementById('filterClose');
            const filterSidebar = document.getElementById('filterSidebar');
            const filterOverlay = document.getElementById('filterOverlay');

            function toggleFilter() {
                if (window.innerWidth <= 768) {
                    filterSidebar.classList.toggle('active');
                    filterOverlay.classList.toggle('active');
                    filterClose.style.display = filterSidebar.classList.contains('active') ? 'flex' : 'none';
                }
            }

            if (filterOpen) filterOpen.onclick = toggleFilter;
            if (filterClose) filterClose.onclick = toggleFilter;
            if (filterOverlay) filterOverlay.onclick = toggleFilter;

            // Reset sidebar if window resized to desktop
            window.onresize = () => {
                if (window.innerWidth > 768) {
                    filterSidebar.classList.remove('active');
                    filterOverlay.classList.remove('active');
                    filterClose.style.display = 'none';
                }
            };
        </script>
    @endpush
@endsection
