@extends('layouts.admin')

@section('admin_title', 'Edit Vehicle')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
        </a>
        <h1 class="text-2xl font-extrabold">Edit: {{ $vehicle->name }}</h1>
        <p class="text-muted mt-2">Modify vehicle specifications, inventory, and media assets.</p>
    </div>

    <form class="admin-detail-grid" action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Sidebar: Image & Status -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <h4 class="text-sm font-bold mb-4">Main Thumbnail</h4>
                @if ($vehicle->thumbnail)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $vehicle->thumbnail) }}"
                            style="width: 100%; height: 200px; object-fit: cover; border-radius: 12px; border: 1px solid var(--glass-border);">
                    </div>
                @endif
                <div class="admin-form-group">
                    <input type="file" name="thumbnail" class="admin-form-control">
                    <p class="text-xs text-muted mt-2">Upload a new image to replace the current thumbnail.</p>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Gallery Images</h4>
                <div class="grid"
                    style="grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                    @foreach ($vehicle->images as $image)
                        <div style="position: relative;">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px;">
                            <button type="button"
                                onclick="if(confirm('Remove this image?')) { document.getElementById('delete-img-{{ $image->id }}').submit(); }"
                                style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border-radius: 50%; width: 20px; height: 20px; border: none; font-size: 10px; cursor: pointer;">
                                ×
                            </button>
                        </div>
                    @endforeach
                </div>
                <div class="admin-form-group">
                    <input type="file" name="images[]" class="admin-form-control" multiple>
                    <p class="text-xs text-muted mt-2">Upload additional photos.</p>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Inventory Status</h4>
                <div class="admin-form-group">
                    <label>Quantity in Stock</label>
                    <input type="number" name="quantity" class="admin-form-control" value="{{ $vehicle->quantity }}"
                        min="0" required>
                </div>
                <div class="admin-form-group">
                    <label>Daily Rental Rate ($)</label>
                    <input type="number" name="daily_rate" class="admin-form-control" value="{{ $vehicle->daily_rate }}"
                        step="0.01" required>
                </div>
                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="Available" {{ $vehicle->status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="Maintenance" {{ $vehicle->status == 'Maintenance' ? 'selected' : '' }}>Maintenance
                        </option>
                        <option value="Out of Stock" {{ $vehicle->status == 'Out of Stock' ? 'selected' : '' }}>Out of
                            Stock</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Content: Specs & Categorization -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Vehicle Name / Model</label>
                    <input type="text" name="name" class="admin-form-control" value="{{ $vehicle->name }}" required>
                </div>
                <div class="admin-form-group">
                    <label>Vehicle Year</label>
                    <input type="number" name="model_year" class="admin-form-control" value="{{ $vehicle->model_year }}"
                        min="1900" max="{{ date('Y') + 1 }}" required>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Main Category</label>
                    <div class="search-field">
                        <select class="admin-form-control" name="category_id" id="mainCategorySelect"
                            onchange="updateSubCategories()" required>
                            <option value="">Select Main Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $vehicle->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="admin-form-group">
                    <label>Sub-category</label>
                    <div class="search-field">
                        <select class="admin-form-control" name="sub_category_id" id="subCategorySelect">
                            <option value="">Select Sub-category</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="admin-form-group">
                <label>Description</label>
                <textarea name="description" class="admin-form-control" rows="5"
                    placeholder="Detailed vehicle description and features...">{{ $vehicle->description }}</textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Fuel Type</label>
                    <input type="text" name="fuel_type" class="admin-form-control" value="{{ $vehicle->fuel_type }}">
                </div>
                <div class="admin-form-group">
                    <label>Transmission</label>
                    <input type="text" name="transmission" class="admin-form-control"
                        value="{{ $vehicle->transmission }}">
                </div>
                <div class="admin-form-group">
                    <label>Seating Capacity</label>
                    <input type="number" name="seating_capacity" class="admin-form-control"
                        value="{{ $vehicle->seating_capacity }}">
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline"
                    style="padding: 1rem 2.5rem;">Discard Changes</a>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Update Asset</button>
            </div>
        </div>
    </form>

    @foreach ($vehicle->images as $image)
        <form id="delete-img-{{ $image->id }}" action="{{ route('admin.vehicles.removeImage', $image->id) }}"
            method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endsection

@push('scripts')
    <script>
        const categories = @json($categories);
        const initialSubId = "{{ $vehicle->sub_category_id }}";

        function updateSubCategories() {
            const mainId = document.getElementById('mainCategorySelect').value;
            const subSelect = document.getElementById('subCategorySelect');
            subSelect.innerHTML = '<option value="">Select Sub-category</option>';

            if (mainId) {
                const parent = categories.find(c => c.id == mainId);
                if (parent && parent.children) {
                    parent.children.forEach(child => {
                        const option = document.createElement('option');
                        option.value = child.id;
                        option.text = child.name;
                        if (child.id == initialSubId) {
                            option.selected = true;
                        }
                        subSelect.appendChild(option);
                    });
                }
            }
        }

        window.onload = function() {
            updateSubCategories();
        };
    </script>
@endpush
