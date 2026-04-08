<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Access | LuxDrive Portfolio</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Global CSS -->
    <link rel="stylesheet" href="/css/app.css">

    <link rel="stylesheet" href="/css/admin-login.css">
</head>

<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="admin-login-wrapper animate-slide-up">
        <div class="login-glass-card">

            <div class="login-avatar">
                <i data-lucide="shield-alert" style="color: var(--primary); width: 32px; height: 32px;"></i>
            </div>

            <h1 class="login-title">Command Center</h1>
            <p class="login-subtitle">Secure gateway for authorized platform administration.</p>

            @if ($errors->any())
                <div class="login-error">
                    <div class="flex items-center gap-2 mb-2 font-bold">
                        <i data-lucide="alert-circle" class="icon-sm"></i> Access Denied
                    </div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.authenticate') }}" method="POST">
                @csrf

                <div class="login-input-group">
                    <label>Administrator Email</label>
                    <div class="login-input-wrapper">
                        <input type="email" name="email" class="login-input" value="{{ old('email') }}"
                            placeholder="admin@luxdrive.com" required autocomplete="email">
                        <i data-lucide="mail"></i>
                    </div>
                </div>

                <div class="login-input-group">
                    <label>Security Credential</label>
                    <div class="login-input-wrapper">
                        <input type="password" name="password" class="login-input" placeholder="••••••••" required>
                        <i data-lucide="key"></i>
                    </div>
                </div>

                <div class="login-options">
                    <label class="login-checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Maintain Secure Session</span>
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Initialize Uplink <i data-lucide="arrow-right"></i>
                </button>
            </form>

            <a href="/" class="login-return">
                <i data-lucide="home" class="icon-sm"></i> Return to Public Sector
            </a>

        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
