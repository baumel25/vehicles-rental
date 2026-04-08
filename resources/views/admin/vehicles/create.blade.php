@extends('layouts.admin')

@section('admin_title', 'Add New Vehicle')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
        </a>
        <h1 class="text-2xl font-extrabold">Register New Vehicle</h1>
        <p class="text-muted mt-2">Fill in the details to add a new asset to your premium fleet.</p>
    </div>

    <form class="admin-detail-grid" action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Sidebar: Image & Status -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <i data-lucide="image" class="mx-auto mb-4 text-muted" style="width: 48px; height: 48px;"></i>
                <h4 class="text-sm font-bold mb-4">Main Thumbnail</h4>
                <div class="admin-form-group">
                    <input type="file" name="thumbnail" class="admin-form-control" required>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Gallery Images</h4>
                <p class="text-xs text-muted mb-4">Upload additional photos of the vehicle.</p>
                <div class="admin-form-group">
                    <input type="file" name="images[]" class="admin-form-control" multiple>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Inventory Status</h4>
                <div class="admin-form-group">
                    <label>Quantity in Stock</label>
                    <input type="number" name="quantity" class="admin-form-control" value="1" min="1" required>
                </div>
                <div class="admin-form-group">
                    <label>Daily Rental Rate ($)</label>
                    <input type="number" name="daily_rate" class="admin-form-control" placeholder="100.00" step="0.01"
                        required>
                </div>
                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="Available">Available</option>
                        <option value="Maintenance">Maintenance</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Content: Specs & Categorization -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Vehicle Name / Model</label>
                    <input type="text" name="name" class="admin-form-control" placeholder="e.g. BMW M8 Competition"
                        required>
                </div>
                <div class="admin-form-group">
                    <label>Vehicle Year</label>
                    <input type="number" name="model_year" class="admin-form-control" placeholder="2024" min="1900"
                        max="{{ date('Y') + 1 }}" required>
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                    placeholder="Detailed vehicle description and features..."></textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Fuel Type</label>
                    <input type="text" name="fuel_type" class="admin-form-control" placeholder="Petrol">
                </div>
                <div class="admin-form-group">
                    <label>Transmission</label>
                    <input type="text" name="transmission" class="admin-form-control" placeholder="Automatic">
                </div>
                <div class="admin-form-group">
                    <label>Seating Capacity</label>
                    <input type="number" name="seating_capacity" class="admin-form-control" value="4">
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline"
                    style="padding: 1rem 2.5rem;">Discard Changes</a>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Save Vehicle</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const categories = @json($categories);

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
                        subSelect.appendChild(option);
                    });
                }
            }
        }
    </script>
@endpush
