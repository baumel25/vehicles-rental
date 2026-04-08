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
        @foreach ($categories as $category)
            <div class="glass-card p-10">
                <div class="flex justify-between items-start mb-8">
                    <div class="flex items-center gap-4">
                        <div class="stat-icon" style="background: rgba(62, 123, 250, 0.1);">
                            @if ($category->thumbnail)
                                <img src="{{ asset('storage/' . $category->thumbnail) }}"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: inherit;">
                            @else
                                <i data-lucide="folder"></i>
                            @endif
                        </div>
                        <div>
                            <h4 class="text-lg font-bold">{{ $category->name }}</h4>
                            <span class="text-xs text-muted font-bold">Main Category</span>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button class="btn-info" onclick="openEditModal({{ $category }})">
                            <i data-lucide="edit-3" class="icon-sm"></i>
                        </button>
                        <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST"
                            onsubmit="return confirm('Delete this category and all its sub-categories?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-info" style="color: #ef4444;"><i data-lucide="trash-2"
                                    class="icon-sm"></i></button>
                        </form>
                    </div>
                </div>

                <div class="mb-6">
                    <h5 class="text-xs text-muted uppercase font-bold mb-4">Sub-categories</h5>
                    <div class="flex flex-col gap-3">
                        @forelse($category->children as $child)
                            <div class="glass-card"
                                style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.02);">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.categories.show', $child->id) }}"
                                        class="text-sm font-bold hover:text-primary transition-colors">{{ $child->name }}</a>
                                    <button class="btn-info p-0" style="background:transparent; border:none;"
                                        onclick="openEditModal({{ $child }})">
                                        <i data-lucide="edit-3" class="icon-xs" style="width:12px;"></i>
                                    </button>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-muted">Sub-category</span>
                                    <form action="{{ route('admin.categories.delete', $child->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this sub-category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-0"
                                            style="background:transparent; border:none; color: #ef4444;"><i
                                                data-lucide="trash-2" class="icon-xs" style="width:12px;"></i></button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-muted italic">No sub-categories yet</p>
                        @endforelse
                    </div>
                </div>

                <button class="btn btn-outline full-width mt-4"
                    onclick="openAddSubModal({{ $category->id }}, '{{ $category->name }}')">
                    <i data-lucide="plus" class="icon-xs" style="margin-right: 0.5rem;"></i> Add Sub-category
                </button>
            </div>
        @endforeach
    </div>
@endsection

@push('modals')
    <!-- Add/Edit Category Modal -->
    <div class="modal-overlay" id="categoryModal">
        <div class="modal-content animate-slide-up">
            <button class="mobile-close" onclick="closeModal('categoryModal')"><i data-lucide="x"></i></button>
            <h3 class="text-xl font-bold mb-8" id="modalTitle">Add Main Category</h3>
            <form id="categoryForm" action="{{ route('admin.categories.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>
                <input type="hidden" name="parent_id" id="parentIdInput">

                <div class="admin-form-group">
                    <label>Category Name</label>
                    <input type="text" name="name" id="nameInput" class="admin-form-control"
                        placeholder="e.g. Electric Vehicles" required>
                </div>

                <div class="admin-form-group">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="admin-form-control">
                    <div id="currentThumbnail" class="mt-2"></div>
                </div>

                <div class="admin-form-group" id="descriptionGroup">
                    <label>Description (Optional)</label>
                    <textarea name="description" id="descriptionInput" class="admin-form-control" rows="3"></textarea>
                </div>

                <div class="flex gap-4 mt-8">
                    <button type="button" class="btn btn-outline flex-1"
                        onclick="closeModal('categoryModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary flex-1">Save Category</button>
                </div>
            </form>
        </div>
    </div>
@endpush

@push('scripts')
    <script>
        function openAddSubModal(parentId, parentName) {
            document.getElementById('modalTitle').innerText = 'Add Sub-category under ' + parentName;
            document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('parentIdInput').value = parentId;
            document.getElementById('nameInput').value = '';
            document.getElementById('descriptionInput').value = '';
            document.getElementById('currentThumbnail').innerHTML = '';
            openModal('categoryModal');
        }

        function openEditModal(category) {
            document.getElementById('modalTitle').innerText = 'Edit ' + (category.parent_id ? 'Sub-category' :
                'Main Category');
            document.getElementById('categoryForm').action = "/admin/categories/" + category.id;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('parentIdInput').value = category.parent_id || '';
            document.getElementById('nameInput').value = category.name;
            document.getElementById('descriptionInput').value = category.description || '';

            if (category.thumbnail) {
                document.getElementById('currentThumbnail').innerHTML = '<img src="/storage/' + category.thumbnail +
                    '" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">';
            } else {
                document.getElementById('currentThumbnail').innerHTML = '';
            }

            openModal('categoryModal');
        }

        // Adjust openModal for add main category
        const originalOpenModal = window.openModal;
        window.openModal = function(id) {
            if (id === 'addCategoryModal') {
                document.getElementById('modalTitle').innerText = 'Add Main Category';
                document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
                document.getElementById('methodField').innerHTML = '';
                document.getElementById('parentIdInput').value = '';
                document.getElementById('nameInput').value = '';
                document.getElementById('descriptionInput').value = '';
                document.getElementById('currentThumbnail').innerHTML = '';
                id = 'categoryModal';
            }
            originalOpenModal(id);
        };
    </script>
@endpush
