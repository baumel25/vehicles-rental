@extends('layouts.admin')

@section('admin_title', 'Master Reservations')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Booking History</h3>
            <p class="text-xs text-muted font-bold mt-2">Monitor and manage all customer reservations</p>
        </div>
        <div class="flex gap-4">
            <button class="btn btn-outline" style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
                <i data-lucide="download" class="icon-sm" style="margin-right: 0.5rem;"></i> Export CSV
            </button>
        </div>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Ref ID</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Pick-up</th>
                    <th>Days</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $reservations = [
                        [
                            'id' => 'LX-20941',
                            'user' => 'Alex Morgan',
                            'vehicle' => 'BMW M8',
                            'date' => 'Oct 24, 2026',
                            'days' => 3,
                            'total' => '$480.00',
                            'status' => 'Confirmed',
                        ],
                        [
                            'id' => 'LX-20942',
                            'user' => 'Sarah Connor',
                            'vehicle' => 'Yamaha R1',
                            'date' => 'Oct 23, 2026',
                            'days' => 2,
                            'total' => '$160.00',
                            'status' => 'Pending',
                        ],
                        [
                            'id' => 'LX-20943',
                            'user' => 'John Wick',
                            'vehicle' => 'Porsche 911',
                            'date' => 'Oct 22, 2026',
                            'days' => 3,
                            'total' => '$540.00',
                            'status' => 'Completed',
                        ],
                        [
                            'id' => 'LX-20944',
                            'user' => 'Ellen Ripley',
                            'vehicle' => 'G-Wagon',
                            'date' => 'Oct 21, 2026',
                            'days' => 3,
                            'total' => '$750.00',
                            'status' => 'Cancelled',
                        ],
                    ];
                @endphp

                @foreach ($reservations as $res)
                    <tr>
                        <td class="font-bold text-primary">#{{ $res['id'] }}</td>
                        <td class="font-bold">{{ $res['user'] }}</td>
                        <td class="text-muted">{{ $res['vehicle'] }}</td>
                        <td>{{ $res['date'] }}</td>
                        <td>{{ $res['days'] }} Days</td>
                        <td class="font-bold">{{ $res['total'] }}</td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($res['status'] == 'Confirmed') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                            @elseif($res['status'] == 'Pending') background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                            @elseif($res['status'] == 'Completed') background: rgba(16, 185, 129, 0.1); color: #10b981;
                            @else background: rgba(239, 68, 68, 0.1); color: #ef4444; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $res['status'] }}</span>
                        </td>
                        <td>
                            <button style="background: none; border: none; color: var(--text-muted); cursor: pointer;">
                                <i data-lucide="settings-2" class="icon-sm"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
