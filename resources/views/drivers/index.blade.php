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
                @php
                    $drivers = [
                        [
                            'id' => 1,
                            'name' => 'John Doe',
                            'exp' => '8 years',
                            'rating' => 4.9,
                            'photo' => 'https://i.pravatar.cc/150?u=john',
                            'specialty' => 'Luxury Sedans',
                            'price' => 50,
                        ],
                        [
                            'id' => 2,
                            'name' => 'Sarah Smith',
                            'exp' => '5 years',
                            'rating' => 4.8,
                            'photo' => 'https://i.pravatar.cc/150?u=sarah',
                            'specialty' => 'Sports Vehicles',
                            'price' => 45,
                        ],
                        [
                            'id' => 3,
                            'name' => 'Michael Chen',
                            'exp' => '12 years',
                            'rating' => 5.0,
                            'photo' => 'https://i.pravatar.cc/150?u=mike',
                            'specialty' => 'VIP Escort',
                            'price' => 70,
                        ],
                        [
                            'id' => 4,
                            'name' => 'Elena Rodriguez',
                            'exp' => '7 years',
                            'rating' => 4.7,
                            'photo' => 'https://i.pravatar.cc/150?u=elena',
                            'specialty' => 'City Touring',
                            'price' => 40,
                        ],
                        [
                            'id' => 5,
                            'name' => 'David Wilson',
                            'exp' => '10 years',
                            'rating' => 4.9,
                            'photo' => 'https://i.pravatar.cc/150?u=david',
                            'specialty' => 'Long Distance',
                            'price' => 55,
                        ],
                        [
                            'id' => 6,
                            'name' => 'Aisha Kahn',
                            'exp' => '6 years',
                            'rating' => 4.8,
                            'photo' => 'https://i.pravatar.cc/150?u=aisha',
                            'specialty' => 'Security Trained',
                            'price' => 65,
                        ],
                    ];
                @endphp

                @foreach ($drivers as $driver)
                    <div class="glass-card" style="padding: 2.5rem; text-align: center;">
                        <img src="{{ $driver['photo'] }}"
                            style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); margin: 0 auto 1.5rem; object-fit: cover;">
                        <h3 class="mb-2">{{ $driver['name'] }}</h3>
                        <p class="text-sm font-bold" style="color: var(--primary); margin-bottom: 0.5rem;">
                            {{ $driver['specialty'] }}</p>

                        <div class="flex justify-center gap-4 mb-8">
                            <div style="text-align: left;">
                                <span class="text-xs text-muted uppercase font-bold"
                                    style="display: block;">Experience</span>
                                <span class="text-sm font-bold">{{ $driver['exp'] }}</span>
                            </div>
                            <div
                                style="border-left: 1px solid rgba(255,255,255,0.1); padding-left: 1rem; text-align: left;">
                                <span class="text-xs text-muted uppercase font-bold" style="display: block;">Rating</span>
                                <span class="text-sm font-bold">{{ $driver['rating'] }} <i data-lucide="star"
                                        style="width: 12px; height: 12px; fill: var(--secondary); color: var(--secondary); display: inline;"></i></span>
                            </div>
                        </div>

                        <div class="mb-8 p-4" style="background: rgba(255,255,255,0.03); border-radius: 12px;">
                            <span class="text-muted text-xs uppercase font-bold">Daily Rate</span>
                            <div class="text-2xl font-extrabold">${{ $driver['price'] }}</div>
                        </div>

                        <a href="/reservations/success" class="btn btn-primary full-width">Hire Chauffeur</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
