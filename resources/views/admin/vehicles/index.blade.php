@extends('layouts.admin')

@section('admin_title', 'Fleet Management')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Manage Vehicle Fleet</h3>
            <p class="text-xs text-muted font-bold mt-2">Update inventory, pricing, and vehicle status</p>
        </div>
        <button class="btn btn-primary" style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
            <i data-lucide="plus" class="icon-sm" style="margin-right: 0.5rem;"></i> Add New Vehicle
        </button>
    </div>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Type</th>
                    <th>Price/Day</th>
                    <th>Inventory</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $vehicles = [
                        [
                            'id' => 1,
                            'name' => 'BMW M8 Competition',
                            'type' => 'Luxury Sedan',
                            'price' => '$120',
                            'qty' => 3,
                            'status' => 'Available',
                        ],
                        [
                            'id' => 2,
                            'name' => 'Yamaha YZF R1',
                            'type' => 'Super Sport',
                            'price' => '$80',
                            'qty' => 5,
                            'status' => 'Available',
                        ],
                        [
                            'id' => 3,
                            'name' => 'Porsche 911 Carrera',
                            'type' => 'Sport Coupe',
                            'price' => '$180',
                            'qty' => 2,
                            'status' => 'Low Stock',
                        ],
                        [
                            'id' => 4,
                            'name' => 'Mercedes G-Wagon',
                            'type' => 'Luxury SUV',
                            'price' => '$250',
                            'qty' => 0,
                            'status' => 'Out of Stock',
                        ],
                    ];
                @endphp

                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td class="font-bold">{{ $vehicle['name'] }}</td>
                        <td class="text-muted">{{ $vehicle['type'] }}</td>
                        <td class="font-bold">{{ $vehicle['price'] }}</td>
                        <td class="font-bold">{{ $vehicle['qty'] }} Units</td>
                        <td>
                            <span class="badge"
                                style="
                            @if ($vehicle['status'] == 'Available') background: rgba(34, 197, 94, 0.1); color: #22c55e;
                            @elseif($vehicle['status'] == 'Low Stock') background: rgba(245, 158, 11, 0.1); color: #f59e0b;
                            @else background: rgba(239, 68, 68, 0.1); color: #ef4444; @endif
                            margin: 0; padding: 0.3rem 0.8rem; font-size: 0.7rem; border: none;
                        ">{{ $vehicle['status'] }}</span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button style="background: none; border: none; color: var(--primary); cursor: pointer;">
                                    <i data-lucide="edit-3" class="icon-sm"></i>
                                </button>
                                <button style="background: none; border: none; color: #ef4444; cursor: pointer;">
                                    <i data-lucide="trash-2" class="icon-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
