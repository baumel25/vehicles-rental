<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | LuxDrive</title>

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

<body class="bg-bg-main text-text-main">

    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div style="padding: 2.5rem 1.5rem;">
                <div class="logo">
                    <div class="logo-icon">
                        <i data-lucide="shield-check" style="color: white; width: 22px; height: 22px;"></i>
                    </div>
                    <span style="font-size: 1.5rem;">Lux<span class="primary-span">Admin</span></span>
                </div>
            </div>

            <nav class="admin-nav">
                <a href="/admin/dashboard"
                    class="admin-nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> Dashboard
                </a>
                <a href="/admin/vehicles" class="admin-nav-link {{ request()->is('admin/vehicles*') ? 'active' : '' }}">
                    <i data-lucide="car"></i> Fleet Management
                </a>
                <a href="/admin/drivers" class="admin-nav-link {{ request()->is('admin/drivers*') ? 'active' : '' }}">
                    <i data-lucide="users"></i> Drivers List
                </a>
                <a href="/admin/reservations"
                    class="admin-nav-link {{ request()->is('admin/reservations*') ? 'active' : '' }}">
                    <i data-lucide="calendar"></i> Reservations
                </a>
                <a href="#" class="admin-nav-link">
                    <i data-lucide="settings"></i> Settings
                </a>
            </nav>

            <div style="margin-top: auto; padding: 2rem 1.5rem; border-top: 1px solid var(--glass-border);">
                <a href="/" class="admin-nav-link">
                    <i data-lucide="log-out"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <!-- Mobile Toggle -->
            <div class="admin-header">
                <div class="flex items-center gap-4">
                    <button class="mobile-toggle" id="adminSidebarToggle" style="display: none;">
                        <i data-lucide="menu"></i>
                    </button>
                    <h2 class="text-2xl font-extrabold">@yield('admin_title')</h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="search-field"
                        style="width: 300px; background: rgba(255,255,255,0.05); padding: 0.8rem 1.2rem; border-radius: 12px; border: 1px solid var(--glass-border);">
                        <i data-lucide="search" class="icon-sm"></i>
                        <input type="text" placeholder="Search anything..."
                            style="background: transparent; border: none; color: white; width: 100%;">
                    </div>
                    <div
                        style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 800;">
                        A
                    </div>
                </div>
            </div>

            @yield('admin_content')
        </main>
    </div>

    <script>
        lucide.createIcons();

        // Admin Sidebar Logic
        const sidebarToggle = document.getElementById('adminSidebarToggle');
        const sidebar = document.getElementById('adminSidebar');

        if (sidebarToggle) {
            sidebarToggle.onclick = () => {
                sidebar.classList.toggle('active');
            };
        }

        // Handle responsive display
        function checkWidth() {
            if (window.innerWidth <= 1024) {
                sidebarToggle.style.display = 'block';
            } else {
                sidebarToggle.style.display = 'none';
                sidebar.classList.remove('active');
            }
        }

        window.onresize = checkWidth;
        checkWidth();
    </script>
</body>

</html>
