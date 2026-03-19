<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | LuxDrive</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Global CSS -->
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-bg-main text-text-main flex items-center justify-center min-h-screen">

    <div class="container w-600">
        <div class="glass-card p-12 text-center animate-slide-up">
            <div class="logo justify-center mb-8">
                <div class="logo-icon">
                    <i data-lucide="shield-check" style="color: white; width: 22px; height: 22px;"></i>
                </div>
                <span style="font-size: 2rem;">Lux<span class="primary-span">Admin</span></span>
            </div>

            <h1 class="text-2xl mb-2">Welcome Back</h1>
            <p class="text-muted mb-12">Authorized Personnel Access Only</p>

            <form action="/admin/dashboard" class="text-left"
                onsubmit="event.preventDefault(); window.location.href='/admin/dashboard';">
                <div class="input-block mb-6">
                    <label>Admin Email</label>
                    <input type="email" placeholder="admin@luxdrive.com" required>
                </div>

                <div class="input-block mb-12">
                    <label>Security Key</label>
                    <input type="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary full-width p-12">
                    Authenticate & Access
                </button>
            </form>

            <a href="/"
                class="flex items-center justify-center gap-2 mt-8 text-xs text-muted font-bold hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="icon-sm"></i> Back to Primary Site
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
