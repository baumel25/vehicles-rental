@extends('layouts.admin')

@section('admin_title', 'Vehicle Details')

@section('admin_content')
    <div class="mb-12">
        <a href="/admin/vehicles" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
        </a>
        <div class="flex justify-between items-end">
            <div>
                <span class="badge" style="background: rgba(34, 197, 94, 0.1); color: #22c55e; margin-bottom: 1rem;">Status:
                    Available</span>
                <h1 class="text-2xl font-extrabold" style="font-size: 3rem;">BMW M8 Competition</h1>
                <p class="text-lg text-muted mt-2">Luxury Sedan • 2024 Model</p>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline"
                    style="padding: 0.8rem 1.5rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.2);">Delete
                    Vehicle</button>
                <a href="/admin/vehicles/1/edit" class="btn btn-primary" style="padding: 0.8rem 2.5rem;">Edit Details</a>
            </div>
        </div>
    </div>

    <div class="admin-detail-grid">
        <div class="flex flex-col gap-8">
            <div class="glass-card p-0 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&q=80&w=800"
                    style="width: 100%; height: 250px; object-fit: cover;">
                <div class="p-8">
                    <h4 class="text-sm font-bold mb-4">Quick Stats</h4>
                    <div class="flex flex-col gap-4">
                        <div class="flex justify-between">
                            <span class="text-muted text-xs font-bold uppercase">Total Bookings</span>
                            <span class="font-bold">142</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted text-xs font-bold uppercase">Revenue Generated</span>
                            <span class="font-bold text-primary">$17,040</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-muted text-xs font-bold uppercase">Last Service</span>
                            <span class="font-bold">Oct 10, 2025</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Inventory & Pricing</h4>
                <div class="flex flex-col gap-4">
                    <div
                        style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <span class="text-xs text-muted font-bold uppercase block mb-1">Current Stock</span>
                        <span class="text-2xl font-extrabold">3 Units</span>
                    </div>
                    <div
                        style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <span class="text-xs text-muted font-bold uppercase block mb-1">Daily Rate</span>
                        <span class="text-2xl font-extrabold text-primary">$120.00</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <div class="glass-card p-12">
                <h3 class="text-xl font-bold mb-8">Technical Specifications</h3>
                <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                    <div>
                        <span class="text-xs text-muted font-bold uppercase block mb-2">Fuel Type</span>
                        <p class="font-bold">Petrol (Premium)</p>
                    </div>
                    <div>
                        <span class="text-xs text-muted font-bold uppercase block mb-2">Transmission</span>
                        <p class="font-bold">8-Speed Automatic</p>
                    </div>
                    <div>
                        <span class="text-xs text-muted font-bold uppercase block mb-2">Capacity</span>
                        <p class="font-bold">4 Passengers</p>
                    </div>
                    <div>
                        <span class="text-xs text-muted font-bold uppercase block mb-2">Category</span>
                        <p class="font-bold">Luxury Sedan</p>
                    </div>
                </div>

                <div class="mt-12">
                    <span class="text-xs text-muted font-bold uppercase block mb-4">Vehicle Description</span>
                    <p class="text-muted line-height-relaxed">
                        The BMW M8 Competition Gran Coupe is the pinnacle of luxury and performance. Featuring a 4.4L V8
                        TwinPower Turbo engine, it delivers an exhilarating driving experience without compromising on
                        comfort or state-of-the-art technology.
                    </p>
                </div>
            </div>

            <div class="glass-card p-12">
                <h3 class="text-xl font-bold mb-8">Recent Bookings</h3>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Dates</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="font-bold">Alex Morgan</td>
                            <td class="text-sm">Oct 24 - Oct 27</td>
                            <td class="font-bold">$480.00</td>
                            <td><span class="badge"
                                    style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: none;">Confirmed</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">Elena Gilbert</td>
                            <td class="text-sm">Oct 18 - Oct 20</td>
                            <td class="font-bold">$240.00</td>
                            <td><span class="badge"
                                    style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: none;">Completed</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
