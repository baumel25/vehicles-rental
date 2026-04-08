@extends('layouts.admin')

@section('admin_title', 'Sub-category Details')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Categories
        </a>
        <div class="flex justify-between items-end">
            <div>
                @if ($category->parent)
                    <span class="badge"
                        style="background: rgba(62, 123, 250, 0.1); color: var(--primary); margin-bottom: 1rem;">Main
                        Category:
                        {{ $category->parent->name }}</span>
                @else
                    <span class="badge" style="background: rgba(34, 197, 94, 0.1); color: #22c55e; margin-bottom: 1rem;">Main
                        Category</span>
                @endif
                <h1 class="text-2xl font-extrabold" style="font-size: 3rem;">{{ $category->name }}</h1>
                <p class="text-lg text-muted mt-2">
                    {{ $category->description ?? 'Managing all vehicles under this classification.' }}</p>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline" style="padding: 0.8rem 1.5rem;">Edit Details</button>
                <a href="/admin/vehicles/create?category_id={{ $category->id }}" class="btn btn-primary"
                    style="padding: 0.8rem 1.5rem;">Add Vehicle here</a>
            </div>
        </div>
    </div>

    <h3 class="text-xl font-bold mb-8">Registered Vehicles</h3>

    <div class="table-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Model Year</th>
                    <th>Daily Rate</th>
                    <th>Inventory</th>
                    <th>Status</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $vehicles = [
                        [
                            'name' => 'BMW M8 Competition',
                            'year' => 2024,
                            'rate' => '$120',
                            'qty' => 3,
                            'status' => 'Available',
                        ],
                        [
                            'name' => 'Mercedes S-Class',
                            'year' => 2023,
                            'rate' => '$150',
                            'qty' => 2,
                            'status' => 'Low Stock',
                        ],
                        ['name' => 'Audi RS7', 'year' => 2024, 'rate' => '$140', 'qty' => 5, 'status' => 'Available'],
                    ];
                @endphp

                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td class="font-bold">{{ $vehicle['name'] }}</td>
                        <td>{{ $vehicle['year'] }}</td>
                        <td class="font-bold">{{ $vehicle['rate'] }}</td>
                        <td class="font-bold">{{ $vehicle['qty'] }} Units</td>
                        <td>
                            <span class="badge"
                                style="background: rgba(34, 197, 94, 0.1); color: #22c55e; border: none;">{{ $vehicle['status'] }}</span>
                        </td>
                        <td>
                            <a href="/admin/vehicles/1" class="btn-info"><i data-lucide="external-link"
                                    class="icon-sm"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
