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

                    <form class="booking-form" action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">

                        <div class="grid grid-2 gap-4">
                            <div class="input-block-premium">
                                <label class="label-premium">
                                    <i data-lucide="calendar-days" class="icon-sm"></i>
                                    Pickup Date
                                </label>
                                <input type="date" name="pickup_date" id="startDate" class="glass-input" required
                                    value="{{ old('pickup_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                            </div>
                            <div class="input-block-premium">
                                <label class="label-premium">
                                    <i data-lucide="calendar-check" class="icon-sm"></i>
                                    Return Date
                                </label>
                                <input type="date" name="return_date" id="endDate" class="glass-input" required
                                    value="{{ old('return_date') }}" min="{{ date('Y-m-d', strtotime('+2 days')) }}">
                            </div>
                        </div>

                        <div class="mb-10 animate-fade-in" style="display: none;">
                            <input type="text" name="payment_phone" id="hidden_payment_phone">
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
                            <div class="input-block-premium">
                                <div class="toggle-group mb-0">
                                    <span class="text-sm font-bold flex items-center gap-2">
                                        <i data-lucide="user-check" class="text-primary icon-sm"></i>
                                        Rent with Professional Driver
                                    </span>
                                    <label class="switch">
                                        <input type="checkbox" id="driverToggle" name="with_driver">
                                        <span class="slider"></span>
                                    </label>
                                </div>

                                <div id="driverSelection"
                                    style="display: none; margin-top: 1.5rem; border-top: 1px solid var(--glass-border); pt-6">
                                    <label class="label-premium mt-6">Select Your Chauffeur</label>
                                    <div class="flex flex-col gap-3">
                                        @foreach ($qualifiedDrivers as $driver)
                                            <label class="driver-item"
                                                style="position: relative; cursor: pointer; border-radius: 14px;">
                                                <input type="radio" name="driver_id" value="{{ $driver->id }}"
                                                    data-rate="{{ $driver->base_rate }}"
                                                    {{ old('driver_id') == $driver->id ? 'checked' : '' }}
                                                    style="display: none;">
                                                @if ($driver->profile_picture)
                                                    <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                                                        class="driver-avatar">
                                                @else
                                                    <div
                                                        class="driver-avatar flex items-center justify-center bg-glass-10">
                                                        <i data-lucide="user" class="icon-sm"></i>
                                                    </div>
                                                @endif
                                                <div class="flex-1">
                                                    <div class="text-sm font-bold">{{ $driver->name }}</div>
                                                    <div class="text-[10px] text-muted">{{ $driver->experience_years }}
                                                        Yrs |
                                                        ${{ number_format($driver->base_rate, 0) }}/day</div>
                                                </div>
                                                <button type="button" class="btn-info"
                                                    onclick="showDriverInfo('{{ $driver->name }}', '{{ $driver->profile_picture ? asset('storage/' . $driver->profile_picture) : '' }}', '{{ $driver->biography }}', '{{ $driver->experience_years }}')"
                                                    style="background: none; border: none; color: var(--primary); font-size: 0.7rem; font-weight: 700; cursor: pointer;">
                                                    Info
                                                </button>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
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
                            <button type="button" onclick="openPaymentModal()" class="btn btn-primary full-width p-12 mt-4">
                                <i data-lucide="shield-check" class="icon-md" style="margin-right: 0.5rem;"></i>
                                Confirm Reservation
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary full-width p-12 mt-4">Login to Reserve</a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Modal -->
    <div class="mobile-menu-overlay" id="paymentOverlay"></div>
    <div class="modal" id="paymentModal">
        <div class="modal-content">
            <button class="mobile-close" onclick="closePaymentModal()">
                <i data-lucide="x"></i>
            </button>

            <div class="text-center mb-8">
                <div class="flex items-center justify-center w-16 h-16 bg-primary/10 rounded-full mx-auto mb-4">
                    <i data-lucide="credit-card" class="text-primary w-8 h-8"></i>
                </div>
                <h2 class="mb-2">Secure <span class="text-gradient">Deposit</span></h2>
                <p class="text-muted text-sm">Pay 1-day rental to confirm your booking.</p>
            </div>

            <div class="bg-glass-05 p-6 rounded-2xl mb-8 border border-white/05">
                <div class="flex justify-between mb-4">
                    <span class="text-muted text-sm">Vehicle Deposit (1 Day)</span>
                    <span class="font-bold text-white" id="modalVehiclePrice">--</span>
                </div>
                <div class="flex justify-between mb-4 border-t border-white/05 pt-4" id="modalDriverRow"
                    style="display: none;">
                    <span class="text-muted text-sm">Driver Deposit (1 Day)</span>
                    <span class="font-bold text-white" id="modalDriverPrice">--</span>
                </div>
                <div class="flex justify-between border-t border-white/10 pt-4 mt-4">
                    <span class="font-extrabold uppercase tracking-widest text-xs text-primary">Total Deposit</span>
                    <span class="text-2xl font-black text-white" id="modalTotalDeposit">--</span>
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-xs font-bold text-muted uppercase tracking-widest mb-4">Momo Number
                    (MTN/Orange)</label>
                <input type="text" id="momo_phone" class="glass-input full-width text-center text-lg tracking-widest"
                    placeholder="6XXXXXXXX" maxlength="9">
                <div id="momo_error" class="text-red-500 text-[10px] mt-2 font-bold transition-all"
                    style="display: none;">Please enter a valid 9-digit number.</div>
            </div>

            <button type="button" onclick="submitBooking()" class="btn btn-primary full-width p-12">
                <i data-lucide="unlock" class="icon-md" style="margin-right: 0.5rem;"></i>
                Pay & Secure Booking
            </button>
            <p class="text-[10px] text-muted text-center mt-4">A payment prompt will be sent to your phone.</p>
        </div>
    </div>

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

            // Payment Modal Logic
            const paymentModal = document.getElementById('paymentModal');
            const paymentOverlay = document.getElementById('paymentOverlay');
            const momoPhone = document.getElementById('momo_phone');
            const hiddenPhone = document.getElementById('hidden_payment_phone');
            const momoError = document.getElementById('momo_error');

            const modalVehiclePrice = document.getElementById('modalVehiclePrice');
            const modalDriverPrice = document.getElementById('modalDriverPrice');
            const modalTotalDeposit = document.getElementById('modalTotalDeposit');
            const modalDriverRow = document.getElementById('modalDriverRow');

            function openPaymentModal() {
                // Validation check for dates
                if (!startDateInput.value || !endDateInput.value) {
                    alert('Please select pickup and return dates.');
                    return;
                }

                if (new Date(endDateInput.value) <= new Date(startDateInput.value)) {
                    alert('Return date must be after pickup date.');
                    return;
                }

                // Update Modal values
                modalVehiclePrice.innerText = `$${dailyRate.toLocaleString()}`;

                let deposit = dailyRate;
                if (driverToggle && driverToggle.checked) {
                    const selectedDriver = document.querySelector('input[name="driver_id"]:checked');
                    if (!selectedDriver) {
                        alert('Please select a driver or disable the chauffeur option.');
                        return;
                    }
                    const rate = parseFloat(selectedDriver.dataset.rate);
                    modalDriverPrice.innerText = `$${rate.toLocaleString()}`;
                    modalDriverRow.style.display = 'flex';
                    deposit += rate;
                } else {
                    modalDriverRow.style.display = 'none';
                }

                modalTotalDeposit.innerText = `$${deposit.toLocaleString()}`;

                paymentModal.classList.add('active');
                paymentOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closePaymentModal() {
                paymentModal.classList.remove('active');
                paymentOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }

            function submitBooking() {
                const phone = momoPhone.value.trim();
                const regex = /^6[0-9]{8}$/;

                if (!regex.test(phone)) {
                    momoError.style.display = 'block';
                    momoPhone.style.borderColor = '#ef4444';
                    return;
                }

                momoError.style.display = 'none';
                hiddenPhone.value = phone;
                document.getElementById('bookingForm').submit();
            }

            paymentOverlay.addEventListener('click', closePaymentModal);
        </script>
    @endpush
@endsection
