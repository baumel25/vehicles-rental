<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LuxDrive | Premium Vehicle Rentals')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Direct link to Vanilla CSS in public directory -->
    <link rel="stylesheet" href="/css/app.css">

    @stack('styles')
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i data-lucide="car" style="color: white; width: 24px; height: 24px;"></i>
                </div>
                <span>Lux<span class="primary-span">Drive</span></span>
            </a>

            <ul class="nav-links">
                <li><a href="/">Home</a></li>
                <li><a href="/vehicles">Fleet</a></li>
                <li><a href="/drivers">Drivers</a></li>
                <li><a href="#">About</a></li>
            </ul>

            <div class="flex items-center gap-4 nav-auth">
                <a href="#" style="font-size: 0.9rem; font-weight: 500;">Sign In</a>
                <a href="/vehicles" class="btn btn-primary nav-auth-btn">Rent Now</a>
            </div>

            <button class="mobile-toggle" id="menuOpen">
                <i data-lucide="menu"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay" id="menuOverlay"></div>
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-close" id="menuClose">
            <i data-lucide="x"></i>
        </button>

        <div class="logo mb-8">
            <div class="logo-icon" style="width: 32px; height: 32px;">
                <i data-lucide="car" style="color: white; width: 18px; height: 18px;"></i>
            </div>
            <span style="font-size: 1.25rem;">Lux<span class="primary-span">Drive</span></span>
        </div>

        <nav class="mobile-nav-links">
            <a href="/">Home</a>
            <a href="/vehicles">Fleet</a>
            <a href="/drivers">Our Drivers</a>
            <a href="#">About</a>
            <a href="#" class="btn btn-primary mt-4">Sign In</a>
        </nav>
    </div>

    <!-- Page Content -->
    <main style="padding-top: var(--header-height);">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="logo footer-logo">
                        <div class="logo-icon footer-logo-icon">
                            <i data-lucide="car" style="color: white;"></i>
                        </div>
                        <span style="font-size: 1.25rem;">Lux<span class="primary-span">Drive</span></span>
                    </div>
                    <p class="footer-text">
                        Experience the ultimate in luxury and convenience with our premium vehicle rental services. Your
                        journey, our passion.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i data-lucide="instagram"
                                style="width: 18px; height: 18px;"></i></a>
                        <a href="#" class="social-icon"><i data-lucide="twitter"
                                style="width: 18px; height: 18px;"></i></a>
                        <a href="#" class="social-icon"><i data-lucide="facebook"
                                style="width: 18px; height: 18px;"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="/">Home</a></li>
                        <li><a href="/vehicles">Fleet</a></li>
                        <li><a href="#">Our Drivers</a></li>
                        <li><a href="#">Pricing</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Support</h4>
                    <ul class="footer-links">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <ul class="footer-links">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" style="width: 16px; height: 16px; color: var(--primary);"></i>
                            contact@luxdrive.com
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" style="width: 16px; height: 16px; color: var(--primary);"></i>
                            +1 (555) 123-4567
                        </li>
                        <p style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2rem;">
                            © 2026 LuxDrive. All rights reserved.
                        </p>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Mobile Menu Logic
        const menuOpen = document.getElementById('menuOpen');
        const menuClose = document.getElementById('menuClose');
        const mobileMenu = document.getElementById('mobileMenu');
        const menuOverlay = document.getElementById('menuOverlay');

        function toggleMenu() {
            mobileMenu.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        }

        menuOpen.onclick = toggleMenu;
        menuClose.onclick = toggleMenu;
        menuOverlay.onclick = toggleMenu;
    </script>
    @stack('scripts')
</body>

</html>
