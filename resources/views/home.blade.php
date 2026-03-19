@extends('layouts.app')

@section('title', 'LuxDrive | Premium Vehicle Rentals')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-bg">
            <div class="hero-overlay"></div>
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=2070"
                alt="Hero Background">
        </div>

        <div class="container relative">
            <div class="hero-content animate-slide-up">
                <span class="badge">Premium Car & Bike Rentals</span>
                <h1>Drive Your <span class="text-gradient">Dream</span> Experience.</h1>
                <p class="lead">Discover the ultimate freedom of travel with our curated fleet of luxury vehicles and
                    high-performance bikes. Simple, fast, and prestigious.</p>

                <!-- Search Form -->
                <form action="/vehicles" class="search-form">
                    <div class="search-input-group">
                        <label>Pick-up Location</label>
                        <div class="search-field">
                            <i data-lucide="map-pin" style="width: 16px; height: 16px; color: var(--primary);"></i>
                            <input type="text" placeholder="Where to?">
                        </div>
                    </div>
                    <div class="search-input-group">
                        <label>Vehicle Type</label>
                        <div class="search-field">
                            <i data-lucide="grid" style="width: 16px; height: 16px; color: var(--primary);"></i>
                            <select>
                                <option value="all">All Vehicles</option>
                                <option value="cars">Luxury Cars</option>
                                <option value="bikes">Sports Bikes</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 0 2.5rem; border-radius: 16px;">
                        <i data-lucide="search" style="width: 20px; height: 20px; margin-right: 0.5rem;"></i>
                        Search
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Vehicles</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12k+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Expert Drivers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Elite Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="section" style="background: rgba(30, 41, 59, 0.2);">
        <div class="container text-center mb-16">
            <h2 class="mb-4">Browse by Category</h2>
            <p class="text-muted">Choose your preferred way to traverse the city or beyond.</p>
        </div>

        <div class="container grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
            <div class="glass-card category-card">
                <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?auto=format&fit=crop&q=80&w=1000"
                    class="category-bg">
                <div class="category-overlay"></div>
                <div class="category-content">
                    <h3 class="text-3xl mb-2">Luxury Cars</h3>
                    <p class="text-muted mb-8">Sedans, SUVs, and Convertibles from elite brands.</p>
                    <a href="/vehicles?type=car" class="flex items-center gap-2 font-bold" style="color: var(--primary);">
                        Explore Cars <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
                    </a>
                </div>
            </div>
            <div class="glass-card category-card">
                <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?auto=format&fit=crop&q=80&w=1000"
                    class="category-bg">
                <div class="category-overlay"></div>
                <div class="category-content">
                    <h3 class="text-3xl mb-2">Sports Bikes</h3>
                    <p class="text-muted mb-8">Unleash the speed with our range of sport and cruiser bikes.</p>
                    <a href="/vehicles?type=bike" class="flex items-center gap-2 font-bold" style="color: var(--primary);">
                        Explore Bikes <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
                    </a>
                </div>
            </div>
            <div class="glass-card category-card">
                <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=1000"
                    class="category-bg">
                <div class="category-overlay"></div>
                <div class="category-content">
                    <h3 class="text-3xl mb-2">Professional Drivers</h3>
                    <p class="text-muted mb-8">Elite chauffeurs for a safe and prestigious travel experience.</p>
                    <a href="/drivers" class="flex items-center gap-2 font-bold" style="color: var(--primary);">
                        Hire Drivers <i data-lucide="arrow-right" style="width: 18px; height: 18px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Fleet -->
    <section class="section">
        <div class="container flex justify-between items-center mb-16">
            <div>
                <h2 class="mb-4">Featured Fleet</h2>
                <p class="text-muted">Handpicked vehicles for exceptional performance.</p>
            </div>
            <a href="/vehicles" class="btn btn-outline">View All Fleet</a>
        </div>

        <div class="container vehicle-grid">
            @php
                $featured = [
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
                    ],
                ];
            @endphp

            @foreach ($featured as $vehicle)
                <div class="glass-card" style="padding: 0; overflow: hidden;">
                    <div class="card-img-wrapper">
                        <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}">
                        <div class="price-tag">${{ $vehicle['price'] }} / day</div>
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
    </section>
@endsection
