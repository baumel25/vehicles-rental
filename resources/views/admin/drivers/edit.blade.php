@extends('layouts.admin')

@section('admin_title', 'Edit Driver')

@section('admin_content')
    <div class="mb-12">
        <a href="{{ route('admin.drivers.index') }}" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Registry
        </a>
        <h1 class="text-2xl font-extrabold">Edit Profile: {{ $driver->name }}</h1>
        <p class="text-muted mt-2">Update professional credentials and chauffeur status.</p>
    </div>

    <form class="admin-detail-grid" action="{{ route('admin.drivers.update', $driver->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Sidebar: Image & Status -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                @if ($driver->profile_picture)
                    <img src="{{ asset('storage/' . $driver->profile_picture) }}"
                        style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; margin: 0 auto 1.5rem; border: 3px solid var(--primary);">
                @else
                    <i data-lucide="user-circle" class="mx-auto mb-4 text-muted" style="width: 64px; height: 64px;"></i>
                @endif
                <h4 class="text-sm font-bold mb-4">Update Profile Photo</h4>
                <div class="admin-form-group">
                    <input type="file" name="profile_picture" class="admin-form-control">
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Availability & Metrics</h4>
                <div class="admin-form-group">
                    <label>Employment Status</label>
                    <select name="status" class="admin-form-control">
                        <option value="Available" {{ $driver->status == 'Available' ? 'selected' : '' }}>Available</option>
                        <option value="On Trip" {{ $driver->status == 'On Trip' ? 'selected' : '' }}>On Trip</option>
                        <option value="Off Duty" {{ $driver->status == 'Off Duty' ? 'selected' : '' }}>Off Duty</option>
                    </select>
                </div>
                <div class="admin-form-group">
                    <label>Daily Service Rate ($)</label>
                    <input type="number" name="base_rate" class="admin-form-control" value="{{ $driver->base_rate }}"
                        step="0.01" required>
                </div>
                <div class="admin-form-group">
                    <label>Years of Experience</label>
                    <input type="number" name="experience_years" class="admin-form-control"
                        value="{{ $driver->experience_years }}" min="0" required>
                </div>
            </div>
        </div>

        <!-- Main Content: Credentials & Bio -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Full Legal Name</label>
                    <input type="text" name="name" class="admin-form-control" value="{{ $driver->name }}" required>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="admin-form-control" value="{{ $driver->phone }}" required>
                </div>
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" class="admin-form-control" value="{{ $driver->email }}">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Professional License Number</label>
                <input type="text" name="license_number" class="admin-form-control"
                    value="{{ $driver->license_number }}" required>
            </div>

            <div class="admin-form-group">
                <label>Professional Biography</label>
                <textarea name="biography" class="admin-form-control" rows="5">{{ $driver->biography }}</textarea>
            </div>

            <div class="admin-form-group mt-8">
                <label class="mb-4 block">Update Qualified Categories</label>
                <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    @foreach ($categories as $category)
                        {{-- @if (!$category->parent_id) --}}
                        <label
                            class="flex items-center gap-3 p-4 glass-card cursor-pointer hover:bg-glass-10 transition-colors">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ $driver->categories->contains($category->id) ? 'checked' : '' }} class="w-4 h-4">
                            <span class="text-sm font-bold">{{ $category->name }}</span>
                        </label>
                        {{-- @endif --}}
                    @endforeach
                </div>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <a href="{{ route('admin.drivers.index') }}" class="btn btn-outline"
                    style="padding: 1rem 2.5rem;">Cancel</a>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Save Changes</button>
            </div>
        </div>
    </form>
@endsection
