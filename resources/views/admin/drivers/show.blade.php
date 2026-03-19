@extends('layouts.admin')

@section('admin_title', 'Driver Profile')

@section('admin_content')
    <div class="mb-12">
        <a href="/admin/drivers" class="flex items-center gap-2 text-muted mb-6 font-bold">
            <i data-lucide="arrow-left" class="icon-sm"></i> Back to Registry
        </a>
        <div class="flex justify-between items-end">
            <div class="flex items-center gap-8">
                <img src="https://i.pravatar.cc/150?u=john"
                    style="width: 120px; height: 120px; border-radius: 50%; border: 3px solid var(--primary); object-fit: cover;">
                <div>
                    <span class="badge"
                        style="background: rgba(34, 197, 94, 0.1); color: #22c55e; margin-bottom: 1rem;">Status:
                        Available</span>
                    <h1 class="text-2xl font-extrabold" style="font-size: 3rem;">John Doe</h1>
                    <p class="text-lg text-muted mt-2">Senior Chauffeur • 8 Years Exp.</p>
                </div>
            </div>
            <div class="flex gap-4">
                <button class="btn btn-outline"
                    style="padding: 0.8rem 1.5rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.2);">Deactivate
                    Profile</button>
                <a href="/admin/drivers/1/edit" class="btn btn-primary" style="padding: 0.8rem 2.5rem;">Edit Profile</a>
            </div>
        </div>
    </div>

    <div class="admin-detail-grid">
        <div class="flex flex-col gap-8">
            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-6">Performance Matrix</h4>
                <div class="flex flex-col gap-4">
                    <div
                        style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <span class="text-xs text-muted font-bold uppercase block mb-1">Average Rating</span>
                        <div class="flex items-center gap-2">
                            <span class="text-2xl font-extrabold">4.9</span>
                            <i data-lucide="star"
                                style="width: 20px; height: 20px; color: var(--secondary); fill: currentColor;"></i>
                        </div>
                    </div>
                    <div
                        style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <span class="text-xs text-muted font-bold uppercase block mb-1">Total Trips</span>
                        <span class="text-2xl font-extrabold">312</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-10">
                <h4 class="text-sm font-bold mb-4">Contact Information</h4>
                <div class="flex flex-col gap-4">
                    <div>
                        <span class="text-xs text-muted font-bold block mb-1">Email</span>
                        <span class="text-sm font-bold">john.doe@luxdrive.com</span>
                    </div>
                    <div>
                        <span class="text-xs text-muted font-bold block mb-1">Phone</span>
                        <span class="text-sm font-bold">+1 (555) 012-3456</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-8">
            <div class="glass-card p-12">
                <h3 class="text-xl font-bold mb-8">Professional Bio</h3>
                <p class="text-muted line-height-relaxed text-lg">
                    John is a veteran chauffeur with specializing in high-profile luxury transport. With over 8 years of
                    experience navigating the city's complex routes and providing elite customer service, he consistently
                    maintains one of the highest ratings in our registry.
                </p>

                <div class="mt-12">
                    <h4 class="text-sm font-bold mb-4">Expertise</h4>
                    <div class="flex gap-2 flex-wrap">
                        <span class="badge">VIP Escort</span>
                        <span class="badge">Defensive Driving</span>
                        <span class="badge">Luxury Sedans</span>
                        <span class="badge">Multi-lingual</span>
                    </div>
                </div>
            </div>

            <div class="glass-card p-12">
                <h3 class="text-xl font-bold mb-8">Active Assignments</h3>
                <div class="text-center py-8">
                    <i data-lucide="calendar-check" class="text-muted mx-auto mb-4" style="width: 48px; height: 48px;"></i>
                    <p class="text-muted font-bold">No active assignments for today.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
