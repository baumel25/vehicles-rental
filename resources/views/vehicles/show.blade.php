@extends('layouts.app')

@section('title', 'Vehicle Details | LuxDrive')

@section('content')
    <section class="section">
        <div class="container">
            <div class="details-layout">

                <!-- Main Content -->
                <div class="details-main">
                    <a href="{{ route('vehicles.index') }}" class="flex items-center gap-2 text-muted mb-10 font-bold">
                        <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
                    </a>

                    <div class="main-image-container mb-12 animate-fade-in"
                        style="border-radius: 24px; overflow: hidden; position: relative;">
                        <img id="mainImage" src="{{ asset('storage/' . $vehicle->thumbnail) }}" alt="{{ $vehicle->name }}"
                            class="main-image" style="width: 100%; height: 600px; object-fit: cover;">

                        @if ($vehicle->images->count() > 0)
                            <div class="gallery-ribbon"
                                style="position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; gap: 1rem; background: rgba(0,0,0,0.5); padding: 1rem; border-radius: 20px; backdrop-filter: blur(10px);">
                                <img src="{{ asset('storage/' . $vehicle->thumbnail) }}" onclick="updateMainImage(this.src)"
                                    class="gallery-thumb active"
                                    style="width: 80px; height: 60px; border-radius: 12px; cursor: pointer; border: 2px solid var(--primary); object-fit: cover;">
                                @foreach ($vehicle->images as $img)
                                    <img src="{{ asset('storage/' . $img->image_path) }}"
                                        onclick="updateMainImage(this.src)" class="gallery-thumb"
                                        style="width: 80px; height: 60px; border-radius: 12px; cursor: pointer; object-fit: cover; opacity: 0.7;">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="mb-12">
                        <div class="flex justify-between items-center mb-6">
                            <h1 class="details-title" style="margin-bottom: 0;">{{ $vehicle->name }}</h1>
                            <div class="qty-badge">
                                <i data-lucide="layers" class="icon-sm"></i>
                                {{ $vehicle->quantity }} In Stock
                            </div>
                        </div>

                        <div class="details-meta">
                            <span class="badge" style="margin-bottom: 0;">{{ $vehicle->category->name }}</span>
                            <div class="flex items-center gap-1 font-bold text-sm" style="color: var(--secondary);">
                                <i data-lucide="star" style="width: 16px; height: 16px; fill: currentColor;"></i>
                                Reliable Choice (New Fleet)
                            </div>
                        </div>
                        <p class="text-muted text-lg line-height-relaxed">{{ $vehicle->description }}</p>
                    </div>

                    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                        <div class="glass-card text-center p-8">
                            <i data-lucide="users" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Capacity</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle->seating_capacity }} Seats</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="zap" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Transmission</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle->transmission }}</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="droplet" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Fuel Type</span>
                            <div class="text-2xl font-extrabold">{{ $vehicle->fuel_type }}</div>
                        </div>
                        <div class="glass-card text-center p-8">
                            <i data-lucide="shield-check" class="mx-auto mb-4" style="color: var(--primary);"></i>
                            <span class="text-xs font-bold text-muted uppercase" style="display: block;">Safety</span>
                            <div class="text-2xl font-extrabold">Certified</div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="sidebar">
                    <div class="mb-8">
                        <span class="font-extrabold"
                            style="font-size: 2.5rem;">${{ number_format($vehicle->daily_rate, 0) }}</span>
                        <span class="text-muted font-bold"> / day</span>
                    </div>

                    <form class="booking-form" action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div class="flex gap-2">
                            <div class="input-block flex-1">
                                <label>Pick-up Date</label>
                                <input type="date" name="pickup_date" id="startDate" required
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div class="input-block flex-1">
                                <label>Return Date</label>
                                <input type="date" name="return_date" id="endDate" required
                                    min="{{ date('Y-m-d', strtotime('+2 days')) }}">
                            </div>
                        </div>

                        @php
                            $qualifiedDrivers = \App\Models\Driver::whereHas('categories', function ($q) use (
                                $vehicle,
                            ) {
                                $q->whereIn('categories.id', [$vehicle->category_id, $vehicle->sub_category_id]);
                            })
                                ->where('status', 'Available')
                                ->get();
                        @endphp

                        @if ($qualifiedDrivers->count() > 0)
                            <div class="toggle-group">
                                <span class="text-sm font-bold">Rent with Professional Driver</span>
                                <label class="switch">
                                    <input type="checkbox" id="driverToggle">
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <div id="driverSelection" style="display: none;">
                                <label class="text-xs font-bold text-muted uppercase mb-4"
                                    style="display: block;">Qualified
                                    Drivers</label>
                                @foreach ($qualifiedDrivers as $driver)
                                    <label class="driver-item" style="position: relative; cursor: pointer;">
                                        <input type="radio" name="driver_id" value="{{ $driver->id }}"
                                            data-rate="{{ $driver->base_rate }}"
                                            {{ old('driver_id') == $driver->id ? 'checked' : '' }} style="display: none;">
                                        @if ($driver->profile_picture)
                                            <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                                                class="driver-avatar">
                                        @else
                                            <div class="driver-avatar flex items-center justify-center bg-glass-10">
                                                <i data-lucide="user" class="icon-sm"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <div class="text-sm font-bold">{{ $driver->name }}</div>
                                            <div class="text-xs text-muted">{{ $driver->experience_years }} Yrs Exp |
                                                ${{ number_format($driver->base_rate, 0) }}/day</div>
                                        </div>
                                        <button type="button" class="btn-info"
                                            onclick="showDriverInfo('{{ $driver->name }}', '{{ $driver->profile_picture ? asset('storage/' . $driver->profile_picture) : '' }}', '{{ $driver->biography }}', '{{ $driver->experience_years }}')"
                                            style="background: none; border: none; color: var(--primary); font-size: 0.7rem; font-weight: 700; cursor: pointer; text-decoration: underline;">
                                            Info
                                        </button>
                                    </label>
                                @endforeach
                            </div>
                            @error('driver_id')
                                <div
                                    class="bg-red-500/10 border border-red-500/50 p-4 rounded-lg mt-4 flex items-start gap-3 animate-fade-in">
                                    <i data-lucide="alert-circle" class="text-red-500 icon-xs mt-1"></i>
                                    <p class="text-red-500 text-xs font-bold">{{ $message }} </p>
                                </div>
                            @enderror
                            @error('vehicle_id')
                                <div
                                    class="bg-amber-500/10 border border-amber-500/50 p-4 rounded-lg mt-4 flex items-start gap-3 animate-fade-in">
                                    <i data-lucide="calendar-off" class="text-amber-500 icon-xs mt-1"></i>
                                    <p class="text-amber-500 text-xs font-bold">{{ $message }} </p>
                                </div>
                            @enderror
                        @else
                            <div class="bg-glass-05 p-6 rounded-xl mt-6">
                                <p class="text-xs text-muted italic">Self-drive only. No drivers qualified for this vehicle
                                    category are currently available.</p>
                            </div>
                        @endif

                        <div class="price-summary">
                            <div class="summary-row">
                                <span class="text-muted">Rental Rate</span>
                                <span id="basePrice">$0.00</span>
                            </div>
                            <div class="summary-row" id="driverFeeRow" style="display: none;">
                                <span class="text-muted">Driver Service</span>
                                <span id="driverPrice">$0.00</span>
                            </div>
                            <div class="summary-row summary-total">
                                <span>Total Price</span>
                                <span id="totalPrice">$0.00</span>
                            </div>
                        </div>

                        @auth
                            <button type="submit" class="btn btn-primary full-width p-12 mt-4">
                                <i data-lucide="check-circle" class="icon-md" style="margin-right: 0.5rem;"></i>
                                Confirm Reservation
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary full-width p-12 mt-4">Login to Reserve</a>
                        @endauth
                    </form>
                </div>
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
            const dailyRate = {{ $vehicle->daily_rate }};
            let driverDailyRate = 0;

            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const driverToggle = document.getElementById('driverToggle');
            const driverSelection = document.getElementById('driverSelection');
            const driverFeeRow = document.getElementById('driverFeeRow');

            const basePriceEl = document.getElementById('basePrice');
            const driverPriceEl = document.getElementById('driverPrice');
            const totalPriceEl = document.getElementById('totalPrice');

            const driverRadios = document.querySelectorAll('input[name="driver_id"]');

            function updateMainImage(src) {
                document.getElementById('mainImage').src = src;
                document.querySelectorAll('.gallery-thumb').forEach(thumb => {
                    thumb.style.border = thumb.src === src ? '2px solid var(--primary)' : 'none';
                    thumb.style.opacity = thumb.src === src ? '1' : '0.7';
                });
            }

            function calculate() {
                const start = new Date(startDateInput.value);
                const end = new Date(endDateInput.value);

                // Driver selection visibility should only depend on the toggle
                if (driverToggle && driverToggle.checked) {
                    if (driverSelection) driverSelection.style.display = 'block';
                    if (driverFeeRow) driverFeeRow.style.display = 'flex';
                } else {
                    if (driverSelection) driverSelection.style.display = 'none';
                    if (driverFeeRow) driverFeeRow.style.display = 'none';
                }

                if (start && end && end > start) {
                    const days = Math.ceil(Math.abs(end - start) / (1000 * 60 * 60 * 24));
                    const baseTotal = dailyRate * days;

                    let driverTotal = 0;
                    if (driverToggle && driverToggle.checked) {
                        // Find selected driver rate
                        const selectedDriver = document.querySelector('input[name="driver_id"]:checked');
                        if (selectedDriver) {
                            driverDailyRate = parseFloat(selectedDriver.dataset.rate);
                            driverTotal = driverDailyRate * days;
                        }
                    }

                    basePriceEl.innerText = `$${baseTotal.toLocaleString()}`;
                    driverPriceEl.innerText = `$${driverTotal.toLocaleString()}`;
                    totalPriceEl.innerText = `$${(baseTotal + driverTotal).toLocaleString()}`;
                } else {
                    basePriceEl.innerText = `$0.00`;
                    driverPriceEl.innerText = `$0.00`;
                    totalPriceEl.innerText = `$0.00`;
                }
            }

            if (startDateInput) startDateInput.onchange = calculate;
            if (endDateInput) endDateInput.onchange = calculate;
            if (driverToggle) driverToggle.onchange = calculate;

            driverRadios.forEach(radio => {
                radio.onchange = (e) => {
                    // Visual feedback for driver selection
                    document.querySelectorAll('.driver-item').forEach(item => {
                        item.style.background = 'transparent';
                        item.style.border = '1px solid var(--glass-border)';
                    });
                    const parent = e.target.closest('.driver-item');
                    parent.style.background = 'rgba(var(--primary-rgb), 0.1)';
                    parent.style.border = '1px solid var(--primary)';
                    calculate();
                };
            });

            calculate();

            // Modal Logic
            const driverModal = document.getElementById('driverModal');
            const modalOverlay = document.getElementById('modalOverlay');

            function showDriverInfo(name, photo, bio, exp) {
                document.getElementById('mDriverName').innerText = name;
                document.getElementById('mDriverPhoto').src = photo || 'https://i.pravatar.cc/150';
                document.getElementById('mDriverBio').innerText = bio || 'No biography details provided.';
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
