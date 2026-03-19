@extends('layouts.admin')

@section('admin_title', 'Category Management')

@section('admin_content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-bold">Fleet Categories</h3>
            <p class="text-xs text-muted font-bold mt-2">Organize your fleet into main and sub-categories</p>
        </div>
        <button class="btn btn-primary" onclick="openModal('addCategoryModal')"
            style="padding: 0.8rem 1.5rem; font-size: 0.85rem;">
            <i data-lucide="plus" class="icon-sm" style="margin-right: 0.5rem;"></i> Add Main Category
        </button>
    </div>

    <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(400px, 1fr)); gap: 2rem;">
        <!-- Cars Category -->
        <div class="glass-card p-10">
            <div class="flex justify-between items-start mb-8">
                <div class="flex items-center gap-4">
                    <div class="stat-icon" style="background: rgba(62, 123, 250, 0.1);">
                        <i data-lucide="car"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold">Luxury Cars</h4>
                        <span class="text-xs text-muted font-bold">Main Category</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="btn-info" onclick="openModal('editCategoryModal')"><i data-lucide="edit-3"
                            class="icon-sm"></i></button>
                    <button class="btn-info" style="color: #ef4444;"><i data-lucide="trash-2" class="icon-sm"></i></button>
                </div>
            </div>

            <div class="mb-6">
                <h5 class="text-xs text-muted uppercase font-bold mb-4">Sub-categories</h5>
                <div class="flex flex-col gap-3">
                    <div class="glass-card"
                        style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02);">
                        <a href="/admin/categories/1"
                            class="text-sm font-bold hover:text-primary transition-colors">Sedans</a>
                        <span class="text-xs text-muted">12 Vehicles</span>
                    </div>
                    <div class="glass-card"
                        style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02);">
                        <a href="/admin/categories/2"
                            class="text-sm font-bold hover:text-primary transition-colors">SUVs</a>
                        <span class="text-xs text-muted">8 Vehicles</span>
                    </div>
                </div>
            </div>

            <button class="btn btn-outline full-width mt-4" onclick="openModal('addSubCategoryModal')">
                <i data-lucide="plus" class="icon-xs" style="margin-right: 0.5rem;"></i> Add Sub-category
            </button>
        </div>

        <!-- Bikes Category -->
        <div class="glass-card p-10">
            <div class="flex justify-between items-start mb-8">
                <div class="flex items-center gap-4">
                    <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: var(--secondary);">
                        <i data-lucide="bike"></i>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold">Sports Bikes</h4>
                        <span class="text-xs text-muted font-bold">Main Category</span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="btn-info"><i data-lucide="edit-3" class="icon-sm"></i></button>
                    <button class="btn-info" style="color: #ef4444;"><i data-lucide="trash-2" class="icon-sm"></i></button>
                </div>
            </div>

            <div class="mb-6">
                <h5 class="text-xs text-muted uppercase font-bold mb-4">Sub-categories</h5>
                <div class="flex flex-col gap-3">
                    <div class="glass-card"
                        style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02);">
                        <a href="#" class="text-sm font-bold hover:text-primary transition-colors">Super Sport</a>
                        <span class="text-xs text-muted">6 Vehicles</span>
                    </div>
                </div>
            </div>

            <button class="btn btn-outline full-width mt-4">
                <i data-lucide="plus" class="icon-xs" style="margin-right: 0.5rem;"></i> Add Sub-category
            </button>
        </div>
    </div>
@endsection

@push('modals')
    <!-- Add Category Modal -->
    <div class="modal-overlay" id="addCategoryModal">
        <div class="modal-content animate-slide-up">
            <button class="mobile-close" onclick="closeModal('addCategoryModal')"><i data-lucide="x"></i></button>
            <h3 class="text-xl font-bold mb-8">Add Main Category</h3>
            <form>
                <div class="admin-form-group">
                    <label>Category Name</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. Electric Vehicles">
                </div>
                <div class="admin-form-group">
                    <label>Icon (Lucide name)</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. zap">
                </div>
                <div class="flex gap-4 mt-8">
                    <button type="button" class="btn btn-outline flex-1"
                        onclick="closeModal('addCategoryModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary flex-1">Create Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Sub-category Modal -->
    <div class="modal-overlay" id="addSubCategoryModal">
        <div class="modal-content animate-slide-up">
            <button class="mobile-close" onclick="closeModal('addSubCategoryModal')"><i data-lucide="x"></i></button>
            <h3 class="text-xl font-bold mb-8">Add Sub-category</h3>
            <p class="text-xs text-muted font-bold mb-4 uppercase">Under: Luxury Cars</p>
            <form>
                <div class="admin-form-group">
                    <label>Sub-category Name</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. Convertibles">
                </div>
                <div class="admin-form-group">
                    <label>Description (Optional)</label>
                    <textarea class="admin-form-control" rows="3"></textarea>
                </div>
                <div class="flex gap-4 mt-8">
                    <button type="button" class="btn btn-outline flex-1"
                        onclick="closeModal('addSubCategoryModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary flex-1">Create Sub-category</button>
                </div>
            </form>
        </div>
    </div>
@endpush
