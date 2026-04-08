@extends('layouts.app')

@section('title', 'Create Account | LuxDrive')

@section('content')
    <div class="section flex items-center justify-center" style="min-height: 80vh;">
        <div class="glass-card animate-slide-up" style="max-width: 600px; width: 100%; padding: 3rem;">
            <div class="text-center mb-10">
                <h1 class="mb-2">Get <span class="text-gradient">Started</span></h1>
                <p class="text-muted">Create an account to browse and book our premium fleet.</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/50 p-4 rounded-xl mb-8">
                    <ul class="text-sm text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="admin-form-group">
                    <label>Full Name</label>
                    <div class="search-field"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                        <i data-lucide="user" class="icon-sm text-primary"></i>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            placeholder="Your Full Name"
                            style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Email Address</label>
                    <div class="search-field"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                        <i data-lucide="mail" class="icon-sm text-primary"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="name@example.com"
                            style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="admin-form-group">
                        <label>Password</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                            <i data-lucide="lock" class="icon-sm text-primary"></i>
                            <input type="password" name="password" required placeholder="••••••••"
                                style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                        </div>
                    </div>
                    <div class="admin-form-group">
                        <label>Confirm Password</label>
                        <div class="search-field"
                            style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                            <i data-lucide="shield-check" class="icon-sm text-primary"></i>
                            <input type="password" name="password_confirmation" required placeholder="••••••••"
                                style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary full-width p-12 mb-8 mt-4">
                    Create Account
                </button>

                <p class="text-center text-muted">
                    Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold">Sign in here</a>
                </p>
            </form>
        </div>
    </div>
@endsection
