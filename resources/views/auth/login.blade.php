@extends('layouts.app')

@section('title', 'Login | LuxDrive')

@section('content')
    <div class="section flex items-center justify-center" style="min-height: 80vh;">
        <div class="glass-card animate-slide-up" style="max-width: 500px; width: 100%; padding: 3rem;">
            <div class="text-center mb-10">
                <h1 class="mb-2">Welcome <span class="text-gradient">Back</span></h1>
                <p class="text-muted">Enter your credentials to access your account.</p>
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

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="admin-form-group">
                    <label>Email Address</label>
                    <div class="search-field"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                        <i data-lucide="mail" class="icon-sm text-primary"></i>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            placeholder="name@example.com"
                            style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label>Password</label>
                    <div class="search-field"
                        style="background: rgba(255, 255, 255, 0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 12px; display: flex; align-items: center; gap: 1rem;">
                        <i data-lucide="lock" class="icon-sm text-primary"></i>
                        <input type="password" name="password" required placeholder="••••••••"
                            style="background: transparent; border: none; color: white; width: 100%; outline: none;">
                    </div>
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4">
                        <span class="text-sm text-muted">Remember me</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-primary">Forgot password?</a>
                </div>

                <button type="submit" class="btn btn-primary full-width p-12 mb-8">
                    Sign In
                </button>

                <p class="text-center text-muted">
                    Don't have an account? <a href="{{ route('register') }}" class="text-primary font-bold">Create one</a>
                </p>
            </form>
        </div>
    </div>
@endsection
