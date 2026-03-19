@extends('layouts.admin')

@section('admin_title', 'Add New Vehicle')

@section('admin_content')
    <div class="mb-12">
        <a href="/admin/vehicles" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Fleet
        </a>
        <h1 class="text-2xl font-extrabold">Register New Vehicle</h1>
        <p class="text-muted mt-2">Fill in the details to add a new asset to your premium fleet.</p>
    </div>

    <form class="admin-detail-grid">
        <!-- Sidebar: Image & Status -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <i data-lucide="image" class="mx-auto mb-4 text-muted" style="width: 48px; height: 48px;"></i>
                <h4 class="text-sm font-bold mb-4">Vehicle Thumbnail</h4>
                <div
                    style="border: 2px dashed var(--glass-border); padding: 2.5rem; border-radius: 16px; margin-bottom: 1.5rem;">
                    <p class="text-xs text-muted">Click to upload or drag image here</p>
                </div>
                <button type="button" class="btn btn-outline full-width">Upload Image</button>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Inventory Status</h4>
                <div class="admin-form-group">
                    <label>Quantity in Stock</label>
                    <input type="number" class="admin-form-control" value="1">
                </div>
                <div class="admin-form-group">
                    <label>Daily Rental Rate ($)</label>
                    <input type="number" class="admin-form-control" placeholder="100.00">
                </div>
            </div>
        </div>

        <!-- Main Content: Specs & Categorization -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Vehicle Name / Model</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. BMW M8 Competition">
                </div>
                <div class="admin-form-group">
                    <label>Vehicle Year</label>
                    <input type="text" class="admin-form-control" placeholder="2024">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Main Category</label>
                    <div class="search-field">
                        <select class="admin-form-control">
                            <option value="1">Luxury Cars</option>
                            <option value="2">Sports Bikes</option>
                        </select>
                    </div>
                </div>
                <div class="admin-form-group">
                    <label>Sub-category</label>
                    <div class="search-field">
                        <select class="admin-form-control">
                            <option value="1">Sedans</option>
                            <option value="2">SUVs</option>
                            <option value="3">Convertibles</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="admin-form-group">
                <label>Description</label>
                <textarea class="admin-form-control" rows="5" placeholder="Detailed vehicle description and features..."></textarea>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Fuel Type</label>
                    <input type="text" class="admin-form-control" placeholder="Petrol">
                </div>
                <div class="admin-form-group">
                    <label>Transmission</label>
                    <input type="text" class="admin-form-control" placeholder="Automatic">
                </div>
                <div class="admin-form-group">
                    <label>Seating Capacity</label>
                    <input type="number" class="admin-form-control" value="4">
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <button type="button" class="btn btn-outline" style="padding: 1rem 2.5rem;">Discard Changes</button>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Save Vehicle</button>
            </div>
        </div>
    </form>
@endsection
