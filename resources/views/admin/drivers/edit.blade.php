@extends('layouts.admin')

@section('admin_title', 'Update Driver')

@section('admin_content')
    <div class="mb-12">
        <a href="/admin/drivers/1" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Profile
        </a>
        <h1 class="text-2xl font-extrabold">Edit Chauffeur Profile</h1>
        <p class="text-muted mt-2">Modifying: <span class="text-primary font-bold">John Doe</span></p>
    </div>

    <form class="admin-detail-grid">
        <!-- Sidebar: Photo & Stats -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <img src="https://i.pravatar.cc/150?u=john"
                    style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); margin: 0 auto 1.5rem; object-fit: cover;">
                <h4 class="text-sm font-bold mb-4">Update Profile Photo</h4>
                <button type="button" class="btn btn-outline full-width">Replace Photo</button>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Availability & Pricing</h4>
                <div class="admin-form-group">
                    <label>Daily Service Rate ($)</label>
                    <input type="number" class="admin-form-control" value="40.00">
                </div>
                <div class="admin-form-group">
                    <label>Availability Status</label>
                    <div class="search-field">
                        <select class="admin-form-control">
                            <option value="available" selected>Available</option>
                            <option value="on-task">On Task</option>
                            <option value="off-duty">Off Duty</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content: Personal Info & Experience -->
        <div class="glass-card p-12">
            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Full Name</label>
                    <input type="text" class="admin-form-control" value="John Doe">
                </div>
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <input type="email" class="admin-form-control" value="john.doe@luxdrive.com">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Years of Experience</label>
                    <input type="text" class="admin-form-control" value="8 Years">
                </div>
                <div class="admin-form-group">
                    <label>Specialty</label>
                    <input type="text" class="admin-form-control" value="VIP Escort, Luxury Sedans">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Professional Biography</label>
                <textarea class="admin-form-control" rows="5">John is a veteran chauffeur specializing in high-profile luxury transport. With over 8 years of experience navigating the city's complex routes.</textarea>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <button type="button" class="btn btn-outline" style="padding: 1rem 2.5rem;">Discard Edits</button>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Save Profile</button>
            </div>
        </div>
    </form>
@endsection
