@extends('layouts.app')

@section('title', 'Vehicle Details | LuxDrive')

@section('content')
    @php
        $vehicles = [
            1 => [
                'name' => 'BMW M8 Competition',
                'type' => 'Luxury Sedan',
                'price' => 120,
                'image' => 'https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=1200',
                'desc' =>
                    'The BMW M8 Competition Gran Coupe is the most powerful and luxurious four-door sedan in the M lineup. Experience unrivaled performance and sophistication.',
                'acceleration' => '3.0s',
                'hp' => '617',
                'top_speed' => '190mph',
                'qty' => 3,
            ],
            2 => [
                'name' => 'Yamaha YZF R1',
                'type' => 'Super Sport',
                'price' => 80,
                'image' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&q=80&w=1200',
                'desc' =>
                    'Born from MotoGP, the R1 is designed to be the ultimate track weapon. Incredible power meets advanced electronics for the thrill-seeker.',
                'acceleration' => '2.6s',
                'hp' => '200',
                'top_speed' => '186mph',
                'qty' => 5,
            ],
            3 => [
                'name' => 'Porsche 911 Carrera',
                'type' => 'Sport Coupe',
                'price' => 180,
                'image' =>
                    'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1200',
                'desc' =>
                    'The timeless icon of sports cars. Perfection in every curve, performance in every gear. A true driver\'s car for those who demand more.',
                'acceleration' => '4.0s',
                'hp' => '379',
                'top_speed' => '182mph',
                'qty' => 2,
            ],
        ];
        $vehicle = $vehicles[$id] ?? $vehicles[1];

        $drivers = [
            [
                'id' => 1,
                'name' => 'John Doe',
                'exp' => '8 years',
                'rating' => 4.9,
                'photo' => 'https://i.pravatar.cc/150?u=john',
                'bio' => 'Expert in luxury sedans with extensive knowledge of city routes and high-profile security.',
            ],
            [
                'id' => 2,
                'name' => 'Sarah Smith',
                'exp' => '5 years',
                'rating' => 4.8,
                'photo' => 'https://i.pravatar.cc/150?u=sarah',
                'bio' => 'Passionate about sports vehicles and high-performance driving. Specialized in scenic tours.',
            ],
            [
                'id' => 3,
                'name' => 'Michael Chen',
                'exp' => '12 years',
                'rating' => 5.0,
                'photo' => 'https://i.pravatar.cc/150?u=mike',
                'bio' =>
                    'Veteran chauffeur with over a decade of experience in VIP escort and international travel protocols.',
            ],
        ];
    @endphp

    <section class="section">
        <div class="container">
            <div class="details-layout">

                <!-- Main Content -->
                <div class="details-main">
                    <a href="/vehicles" class="flex items-center gap-2 text-muted mb-10 font-bold">
                        <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
                    </a>

                    <img src="{{ $vehicle['image'] }}" alt="{{ $vehicle['name'] }}" class="main-image animate-fade-in">

                    <div class="mb-12">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="details-title" style="margin-bottom: 0;">{{ $vehicle['name'] }}</h1>
                            <div class="qty-badge">
                                <i data-lucide="layers" class="icon-sm"></i>
                                {{ $vehicle['qty'] }} In Stock
                            </div>
                        </div>

                        <div class="details-meta">
                            <span class="badge" style="margin-bottom: 0;">{{ $vehicle['type'] }}</span>
                            <div class="flex items-center gap-1 font-bold text-sm" style="color: var(--secondary);">
                                <i data-lucide="star" style="width: 16px; height: 16px; fill: currentColor;"></i>
                                4.9 (120 reviews)
                            </div>
                        </div>
                        <p class="text-muted text-lg line-height-relaxed">{{ $vehicle['desc'] }}</p>
                    </div>

                    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                        <div class="glass-card text-center p-8">
                            <i data-lucide="wind" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">0-60 MPH</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle['acceleration'] }}</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="gauge" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Horsepower</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle['hp'] }} HP</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="fast-forward" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Top Speed</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle['top_speed'] }}</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="shield-check" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Safety</span>
                            <div class="text-2xl font-extrabold">5 Star</div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="mb-8">
                        <span class="font-extrabold" style="font-size: 2.5rem;">${{ $vehicle['price'] }}</span>
                        <span class="text-muted font-bold"> / day</span>
                    </div>

                    <form class="booking-form">
                        <div class="flex gap-2">
                            <div class="input-block flex-1">
                                <label>Start Date</label>
                                <input type="date" id="startDate" value="2026-03-20">
                            </div>
                            <div class="input-block flex-1">
                                <label>End Date</label>
                                <input type="date" id="endDate" value="2026-03-23">
                            </div>
                        </div>

                        <div class="toggle-group">
                            <span class="text-sm font-bold">Rent with Professional Driver</span>
                            <label class="switch">
                                <input type="checkbox" id="driverToggle">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div id="driverSelection" style="display: none;">
                            <label class="text-xs font-bold text-muted uppercase mb-4" style="display: block;">Available
                                Drivers</label>
                            @foreach ($drivers as $driver)
                                <div class="driver-item" style="position: relative;">
                                    <img src="{{ $driver['photo'] }}" class="driver-avatar">
                                    <div class="flex-1">
                                        <div class="text-sm font-bold">{{ $driver['name'] }}</div>
                                        <div class="text-xs text-muted">{{ $driver['exp'] }} • {{ $driver['rating'] }}
                                            <i data-lucide="star"
                                                style="width: 10px; height: 10px; fill: currentColor; display: inline;"></i>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-info"
                                        onclick="showDriverInfo('{{ $driver['name'] }}', '{{ $driver['photo'] }}', '{{ $driver['bio'] }}', '{{ $driver['exp'] }}')"
                                        style="background: none; border: none; color: var(--primary); font-size: 0.7rem; font-weight: 700; cursor: pointer; text-decoration: underline;">
                                        Info
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="price-summary">
                            <div class="summary-row">
                                <span class="text-muted">Rental Rate</span>
                                <span id="basePrice">$0.00</span>
                            </div>
                            <div class="summary-row" id="driverFeeRow" style="display: none;">
                                <span class="text-muted">Driver Service</span>
                                <span>$0.00</span>
                            </div>
                            <div class="summary-row summary-total">
                                <span>Total Price</span>
                                <span id="totalPrice">$0.00</span>
                            </div>
                        </div>

                        <a href="/reservations/success" class="btn btn-primary full-width p-12 mt-4">
                            <i data-lucide="check-circle" class="icon-md" style="margin-right: 0.5rem;"></i>
                            Confirm Reservation
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Driver Info Modal -->
    <div class="mobile-menu-overlay" id="modalOverlay"></div>
    <div class="modal" id="driverModal">
        <div class="modal-content text-center">
            <button class="mobile-close" id="modalClose">
                <i data-lucide="x"></i>
            </button>
            <img id="mDriverPhoto" src=""
                style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 1.5rem; object-fit: cover; border: 3px solid var(--primary);">
            <h2 id="mDriverName" class="mb-2"></h2>
            <p id="mDriverExp" class="text-primary font-bold mb-6"></p>
            <p id="mDriverBio" class="text-muted line-height-relaxed mb-8"></p>
            <button class="btn btn-primary full-width" onclick="closeModal()">Close Details</button>
        </div>
    </div>

    @push('scripts')
        <script>
            const dailyRate = {{ $vehicle['price'] }};
            const driverDailyRate = 40;

            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const driverToggle = document.getElementById('driverToggle');
            const driverSelection = document.getElementById('driverSelection');
            const driverFeeRow = document.getElementById('driverFeeRow');

            const basePriceEl = document.getElementById('basePrice');
            const totalPriceEl = document.getElementById('totalPrice');

            function calculate() {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);

                if (start && end && end > start) {
                    const days = Math.ceil(Math.abs(end - start) / (1000 * 60 * 60 * 24));
                    const baseTotal = dailyRate * days;
                    const driverTotal = driverToggle.checked ? driverDailyRate * days : 0;

                    basePriceEl.innerText = `$${baseTotal.toFixed(2)}`;
                    if (driverToggle.checked) {
                        driverFeeRow.style.display = 'flex';
                        driverFeeRow.querySelector('span:last-child').innerText = `$${driverTotal.toFixed(2)}`;
                        driverSelection.style.display = 'block';
                    } else {
                        driverFeeRow.style.display = 'none';
                        driverSelection.style.display = 'none';
                    }
                    totalPriceEl.innerText = `$${(baseTotal + driverTotal).toFixed(2)}`;
                }
            }

            startDateInput.onchange = calculate;
            endDateInput.onchange = calculate;
            driverToggle.onchange = calculate;
            calculate();

            // Modal Logic
            const driverModal = document.getElementById('driverModal');
            const modalOverlay = document.getElementById('modalOverlay');

            function showDriverInfo(name, photo, bio, exp) {
                document.getElementById('mDriverName').innerText = name;
                document.getElementById('mDriverPhoto').src = photo;
                document.getElementById('mDriverBio').innerText = bio;
                document.getElementById('mDriverExp').innerText = exp + ' of Professional Experience';
                driverModal.classList.add('active');
                modalOverlay.classList.add('active');
            }

            function closeModal() {
                driverModal.classList.remove('active');
                modalOverlay.classList.remove('active');
            }

            document.getElementById('modalClose').onclick = closeModal;
            modalOverlay.onclick = closeModal;
        </script>
    @endpush
@endsection
