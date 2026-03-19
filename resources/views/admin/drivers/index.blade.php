@extends('layouts.admin')

@section('admin_title', 'Chauffeur Registry')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Professional Drivers</h3>
            <p class="text-xs text-muted font-bold mt-2">Manage driver profiles, availability, and ratings</p>
        </div>
        <a href="/admin/drivers/create" class="btn btn-primary" style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
            <i data-lucide="user-plus" class="icon-sm" style="margin-right: 0.5rem;"></i> Add Driver
        </a>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Driver</th>
                    <th>Specialty</th>
                    <th>Experience</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $drivers = [
                        [
                            'id' => 1,
                            'name' => 'John Doe',
                            'spec' => 'Luxury Sedans',
                            'exp' => '8 Yrs',
                            'rating' => 4.9,
                            'status' => 'On Task',
                        ],
                        [
                            'id' => 2,
                            'name' => 'Sarah Smith',
                            'spec' => 'Sports Bikes',
                            'exp' => '5 Yrs',
                            'rating' => 4.8,
                            'status' => 'Available',
                        ],
                        [
                            'id' => 3,
                            'name' => 'Michael Chen',
                            'spec' => 'VIP Escort',
                            'exp' => '12 Yrs',
                            'rating' => 5.0,
                            'status' => 'Available',
                        ],
                        [
                            'id' => 4,
                            'name' => 'Elena Rodriguez',
                            'spec' => 'City Touring',
                            'exp' => '7 Yrs',
                            'rating' => 4.7,
                            'status' => 'Off Duty',
                        ],
                    ];
                @endphp

                @foreach ($drivers as $driver)
                    <tr>
                        <td class="font-bold">{{ $driver['name'] }}</td>
                        <td class="text-muted">{{ $driver['spec'] }}</td>
                        <td class="font-bold">{{ $driver['exp'] }}</td>
                        <td class="font-bold" style="color: var(--secondary);">{{ $driver['rating'] }} <i data-lucide="star"
                                style="width: 12px; height: 12px; fill: currentColor; display: inline;"></i></td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($driver['status'] == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                            @elseif($driver['status'] == 'On Task') background: rgba(59, 130, 246, 0.1); color: #3b82f6;
                            @else background: rgba(156, 163, 175, 0.1); color: #9ca3af; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $driver['status'] }}</span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="/admin/drivers/{{ $driver['id'] }}" class="btn-info"
                                    style="color: var(--primary);">
                                    <i data-lucide="eye" class="icon-sm"></i>
                                </a>
                                <a href="/admin/drivers/{{ $driver['id'] }}/edit" class="btn-info"
                                    style="color: var(--text-muted);">
                                    <i data-lucide="edit-3" class="icon-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
