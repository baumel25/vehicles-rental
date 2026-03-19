@extends('layouts.admin')

@section('admin_title', 'Register Driver')

@section('admin_content')
    <div class="mb-12">
        <a href="/admin/drivers" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Registry
        </a>
        <h1 class="text-2xl font-extrabold">Onboard New Chauffeur</h1>
        <p class="text-muted mt-2">Add a professional driver to your service network.</p>
    </div>

    <form class="admin-detail-grid">
        <!-- Sidebar: Photo & Stats -->
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10 text-center">
                <div
                    style="width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.05); border: 2px dashed var(--glass-border); margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="user" class="text-muted" style="width: 48px; height: 48px;"></i>
                </div>
                <h4 class="text-sm font-bold mb-4">Profile Photo</h4>
                <button type="button" class="btn btn-outline full-width">Upload Photo</button>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Availability & Rating</h4>
                <div class="admin-form-group">
                    <label>Daily Service Rate ($)</label>
                    <input type="number" class="admin-form-control" placeholder="40.00">
                </div>
                <div class="admin-form-group">
                    <label>Availability Status</label>
                    <div class="search-field">
                        <select class="admin-form-control">
                            <option value="available">Available</option>
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
                    <input type="text" class="admin-form-control" placeholder="e.g. John Doe">
                </div>
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <input type="email" class="admin-form-control" placeholder="john@example.com">
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 2rem;">
                <div class="admin-form-group">
                    <label>Years of Experience</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. 8 Years">
                </div>
                <div class="admin-form-group">
                    <label>Specialty</label>
                    <input type="text" class="admin-form-control" placeholder="e.g. VIP Escort, Luxury Sedans">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Professional Biography</label>
                <textarea class="admin-form-control" rows="5" placeholder="Detailed professional background..."></textarea>
            </div>

            <div class="flex gap-4 mt-8 pt-8" style="border-top: 1px solid var(--glass-border);">
                <button type="button" class="btn btn-outline" style="padding: 1rem 2.5rem;">Cancel</button>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Register Driver</button>
            </div>
        </div>
    </form>
@endsection
