@extends('layouts.admin')

@section('admin_title', 'Register Driver')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.drivers.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Registry
        </a>
        <h1 class="text-2xl font-extrabold">Add Professional Driver</h1>
        <p class="text-muted mt-2">Create a new chauffeur profile for the rental service.</p>
    </div>

    <form class="admin-detail-grid" action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Sidebar: Image & Status -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <i data-lucide="user-circle" class="mx-auto mb-4 text-muted" style="width: 64px; height: 64px;"></i>
                <h4 class="text-sm font-bold mb-4">Profile Photo</h4>
                <div class="admin-form-group">
                    <input type="file" name="profile_picture" class="admin-form-control">
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Availability & Metrics</h4>
                <div class="admin-form-group">
                    <label>Employment Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="Available">Available</option>
                        <option value="On Trip">On Trip</option>
                        <option value="Off Duty">Off Duty</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Daily Service Rate ($)</label>
                    <input type="number" name="base_rate" class="admin-form-control" placeholder="50.00" step="0.01"
                        required>
                </div>
                <div class="admin-form-group">
                    <label>Years of Experience</label>
                    <input type="number" name="experience_years" class="admin-form-control" value="1" min="0"
                        required>
                </div>
            </div>
        </div>

        <!-- Main Content: Credentials & Bio -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Full Legal Name</label>
                    <input type="text" name="name" class="admin-form-control" placeholder="e.g. Johnathan Doe"
                        required>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="admin-form-control" placeholder="+1 (555) 000-0000"
                        required>
                </div>
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="admin-form-control" placeholder="john@example.com">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Professional License Number</label>
                <input type="text" name="license_number" class="admin-form-control" placeholder="DL-123456789" required>
            </div>

            <div class="admin-form-group">
                <label>Professional Biography</label>
                <textarea name="biography" class="admin-form-control" rows="5"
                    placeholder="Highlight driver skills, specialties, and language proficiency..."></textarea>
            </div>

            <div class="admin-form-group mt-8">
                <label class="mb-4 block">Qualified Vehicle Categories</label>
                <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    @foreach ($categories as $category)
                        @if (!$category->parent_id)
                            {{-- Only show main categories for qualification or logic choice --}}
                            <label
                                class="flex items-center gap-3 p-4 glass-card cursor-pointer hover:bg-glass-10 transition-colors">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="w-4 h-4">
                                <span class="text-sm font-bold">{{ $category->name }}</span>
                            </label>
                        @endif
                    @endforeach
                </div>
                <p class="text-xs text-muted mt-4 italic">Select all vehicle types this driver is licensed and qualified to
                    operate.</p>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline"
                    style="padding: 1rem 2.5rem;">Discard</a>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Register Chauffeur</button>
            </div>
        </div>
    </form>
@endsection
