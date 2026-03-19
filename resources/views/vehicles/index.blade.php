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

                <div class="filter-bar">
                    <div class="filter-group">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Search
                            Vehicle</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <i data-lucide="search" class="icon-sm" style="color: var(--primary);"></i>
                            <input type="text" placeholder="Search make or model..."
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem;">
                        </div>
                    </div>

                    <div class="filter-select">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Vehicle
                            Type</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <select
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem;">
                                <option value="all">All Vehicles</option>
                                <option value="car">Luxury Cars</option>
                                <option value="bike">Sports Bikes</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-select">
                        <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Price
                            Range</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); padding: 1rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                            <select
                                style="background: transparent; border: none; color: white; width: 100%; font-size: 0.9rem;">
                                <option value="any">Any Price</option>
                                <option value="0-100">$0 - $100</option>
                                <option value="100-200">$100 - $200</option>
                                <option value="200+">$200+</option>
                            </select>
                        </div>
                    </div>

                    <div class="align-end">
                        <button class="btn btn-primary h-52 p-8" style="padding: 0 2rem;">Apply Filters</button>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="vehicle-grid">
                @php
                    $vehicles = [
                        [
                            'id' => 1,
                            'name' => 'BMW M8 Competition',
                            'type' => 'Luxury Sedan',
                            'price' => 120,
                            'image' =>
                                'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800',
                            'seats' => 4,
                            'trans' => 'Auto',
                            'fuel' => 'Petrol',
                            'qty' => 3,
                        ],
                        [
                            'id' => 2,
                            'name' => 'Yamaha YZF R1',
                            'type' => 'Super Sport',
                            'price' => 80,
                            'image' =>
                                'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&q=80&w=800',
                            'seats' => 1,
                            'trans' => '6-Gears',
                            'fuel' => 'Petrol',
                            'qty' => 5,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Porsche 911 Carrera',
                            'type' => 'Sport Coupe',
                            'price' => 180,
                            'image' =>
                                'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=800',
                            'seats' => 2,
                            'trans' => 'Manual',
                            'fuel' => 'Petrol',
                            'qty' => 2,
                        ],
                        [
                            'id' => 4,
                            'name' => 'Mercedes G-Wagon',
                            'type' => 'Luxury SUV',
                            'price' => 250,
                            'image' =>
                                'https://images.unsplash.com/photo-1520031441872-265e4ff70366?auto=format&fit=crop&q=80&w=800',
                            'seats' => 5,
                            'trans' => 'Auto',
                            'fuel' => 'Diesel',
                            'qty' => 1,
                        ],
                        [
                            'id' => 5,
                            'name' => 'Audi RS7 Sportback',
                            'type' => 'Performance',
                            'price' => 150,
                            'image' =>
                                'https://images.unsplash.com/photo-1606152421802-db97b9c7a11b?auto=format&fit=crop&q=80&w=800',
                            'seats' => 5,
                            'trans' => 'Auto',
                            'fuel' => 'Petrol',
                            'qty' => 4,
                        ],
                        [
                            'id' => 6,
                            'name' => 'Ducati Panigale V4',
                            'type' => 'Superbike',
                            'price' => 95,
                            'image' =>
                                'https://images.unsplash.com/photo-1568772585407-9361f9bf3a87?auto=format&fit=crop&q=80&w=800',
                            'seats' => 1,
                            'trans' => '6-Gears',
                            'fuel' => 'Petrol',
                            'qty' => 2,
                        ],
                        [
                            'id' => 7,
                            'name' => 'Land Rover Defender',
                            'type' => 'Off-road',
                            'price' => 140,
                            'image' =>
                                'https://images.unsplash.com/photo-1605559424843-9e4c228bf1c2?auto=format&fit=crop&q=80&w=800',
                            'seats' => 7,
                            'trans' => 'Auto',
                            'fuel' => 'Diesel',
                            'qty' => 6,
                        ],
                        [
                            'id' => 8,
                            'name' => 'Tesla Model S Plaid',
                            'type' => 'Electric Luxury',
                            'price' => 200,
                            'image' =>
                                'https://images.unsplash.com/photo-1536700503339-1e4b06520771?auto=format&fit=crop&q=80&w=800',
                            'seats' => 5,
                            'trans' => 'Auto',
                            'fuel' => 'Electric',
                            'qty' => 3,
                        ],
                    ];
                @endphp

                @foreach ($vehicles as $vehicle)
                    <div class="glass-card" style="padding: 0; overflow: hidden;">
                        <div class="card-img-wrapper">
                            <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}">
                            <div class="price-tag">${{ $vehicle['price'] }} / day</div>

                            <div
                                style="position: absolute; top: 1rem; right: 1rem; background: var(--primary); padding: 0.3rem 0.7rem; border-radius: 8px; font-size: 0.7rem; font-weight: 700;">
                                {{ $vehicle['qty'] }} Available
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">{{ $vehicle['name'] }}</h3>
                            <p class="card-subtitle">{{ $vehicle['type'] }}</p>

                            <div class="specs-grid">
                                <div class="spec-item">
                                    <i data-lucide="users"></i>
                                    <span>{{ $vehicle['seats'] }} Seats</span>
                                </div>
                                <div class="spec-item">
                                    <i data-lucide="zap"></i>
                                    <span>{{ $vehicle['trans'] }}</span>
                                </div>
                                <div class="spec-item">
                                    <i data-lucide="droplet"></i>
                                    <span>{{ $vehicle['fuel'] }}</span>
                                </div>
                            </div>

                            <a href="/vehicles/{{ $vehicle['id'] }}" class="btn btn-primary full-width small-btn">Rent This
                                Vehicle</a>
                        </div>
                    </div>
                @endforeach
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
