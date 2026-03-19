@extends('layouts.admin')

@section('admin_title', 'Dashboard Overview')

@section('admin_content')
    <!-- Stats Grid -->
    <div class="admin-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="car"></i>
            </div>
            <div>
                <span class="text-xs text-muted uppercase font-bold" style="display: block;">Total Fleet</span>
                <span class="text-2xl font-extrabold">24</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="users"></i>
            </div>
            <div>
                <span class="text-xs text-muted uppercase font-bold" style="display: block;">Active Drivers</span>
                <span class="text-2xl font-extrabold">12</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i data-lucide="calendar"></i>
            </div>
            <div>
                <span class="text-xs text-muted uppercase font-bold" style="display: block;">Active Bookings</span>
                <span class="text-2xl font-extrabold">48</span>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(34, 197, 94, 0.1); color: #22c55e;">
                <i data-lucide="dollar-sign"></i>
            </div>
            <div>
                <span class="text-xs text-muted uppercase font-bold" style="display: block;">Revenue</span>
                <span class="text-2xl font-extrabold">$12,450</span>
            </div>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="mb-8 flex justify-between items-center">
        <h3 class="text-xl font-bold">Recent Reservations</h3>
        <a href="/admin/reservations" class="text-sm font-bold text-primary">View All</a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $bookings = [
                        [
                            'user' => 'Alex Morgan',
                            'vehicle' => 'BMW M8',
                            'date' => 'Oct 24, 2026',
                            'status' => 'Confirmed',
                            'total' => '$480.00',
                        ],
                        [
                            'user' => 'Sarah Connor',
                            'vehicle' => 'Yamaha R1',
                            'date' => 'Oct 23, 2026',
                            'status' => 'Pending',
                            'total' => '$160.00',
                        ],
                        [
                            'user' => 'John Wick',
                            'vehicle' => 'Porsche 911',
                            'date' => 'Oct 22, 2026',
                            'status' => 'Completed',
                            'total' => '$540.00',
                        ],
                        [
                            'user' => 'Ellen Ripley',
                            'vehicle' => 'G-Wagon',
                            'date' => 'Oct 21, 2026',
                            'status' => 'Cancelled',
                            'total' => '$750.00',
                        ],
                    ];
                @endphp

                @foreach ($bookings as $booking)
                    <tr>
                        <td class="font-bold">{{ $booking['user'] }}</td>
                        <td class="text-muted">{{ $booking['vehicle'] }}</td>
                        <td>{{ $booking['date'] }}</td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($booking['status'] == 'Confirmed') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                            @elseif($booking['status'] == 'Pending') background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                            @elseif($booking['status'] == 'Completed') background: rgba(16, 185, 129, 0.1); color: #10b981;
                            @else background: rgba(239, 68, 68, 0.1); color: #ef4444; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $booking['status'] }}</span>
                        </td>
                        <td class="font-bold">{{ $booking['total'] }}</td>
                        <td>
                            <button style="background: none; border: none; color: var(--text-muted); cursor: pointer;">
                                <i data-lucide="more-horizontal"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
