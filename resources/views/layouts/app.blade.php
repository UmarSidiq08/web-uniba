<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Beasiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'mint-primary': '#00c9a7',
                        'mint-secondary': '#00bcd4',
                        'mint-dark': '#00a693',
                        'mint-light': '#4dd0e1',
                        'mint-blue': '#0891b2',
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom gradient backgrounds that can't be done with Tailwind alone */
        .navbar-gradient {
            background: linear-gradient(135deg, #00c9a7, #00bcd4, #0891b2) !important;
        }

        .navbar-sticky {
            background: rgba(0, 201, 167, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .nav-link-underline::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: linear-gradient(90deg, #fff, #4dd0e1);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
        }

        .nav-link-underline:hover::after,
        .nav-link-underline.active::after {
            width: 80%;
        }

        .dropdown-item-gradient:hover {
            background: linear-gradient(45deg, #00c9a7, #0891b2);
            color: white;
        }

        .alert-gradient-success {
            background: linear-gradient(45deg, #00a693, #00bcd4);
        }

        .alert-gradient-danger {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
        }

        .footer-gradient {
            background: linear-gradient(45deg, #212529, #495057) !important;
        }

        .btn-gradient-primary {
            background: linear-gradient(45deg, #00c9a7, #0891b2);
        }

        .btn-gradient-primary:hover {
            background: linear-gradient(45deg, #00a693, #00bcd4);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50">
    <nav class="navbar-gradient fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out shadow-lg" id="mainNavbar">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-3">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="text-white text-xl font-semibold hover:scale-105 transition-transform duration-200 drop-shadow-sm hover:drop-shadow-lg">
                    <i class="fas fa-graduation-cap mr-2"></i> Pendaftaran Beasiswa
                </a>

                <!-- Mobile menu button -->
                <button class="lg:hidden text-white border-2 border-white border-opacity-30 rounded p-2 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-25"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <!-- Left Navigation -->
                    <div class="flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg">
                            <i class="fas fa-home mr-1"></i> Home
                        </a>
                        <a href="{{ route('persyaratan') }}" class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg">
                            <i class="fas fa-list-check mr-1"></i> Persyaratan
                        </a>
                    </div>

                    <!-- Right Navigation -->
                    <div class="flex items-center space-x-4">
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard Admin
                                </a>
                            @endif

                            <!-- User Dropdown -->
                            <div class="relative dropdown">
                                <button class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg flex items-center space-x-1"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                    <i class="fas fa-user-circle mr-1"></i>
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down text-sm ml-1"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-2xl border-0 py-2">
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST" class="block">
                                            @csrf
                                            <button type="submit" class="dropdown-item-gradient w-full text-left px-6 py-3 text-gray-700 hover:text-white transition-all duration-200 hover:translate-x-1">
                                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg">
                                <i class="fas fa-sign-in-alt mr-1"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="nav-link-underline relative text-white font-medium hover:text-gray-100 transition-colors duration-300 hover:drop-shadow-lg">
                                <i class="fas fa-user-plus mr-1"></i> Register
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile Navigation (Collapsible) -->
                <div class="collapse navbar-collapse lg:hidden" id="navbarNav">
                    <div class="absolute top-full left-0 right-0 bg-mint-primary bg-opacity-96 mt-4 mx-4 rounded-lg shadow-xl border border-white border-opacity-20 p-4">
                        <!-- Mobile Left Navigation -->
                        <div class="space-y-2 mb-4">
                            <a href="{{ route('home') }}" class="block text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2">
                                <i class="fas fa-home mr-2"></i> Home
                            </a>
                            <a href="{{ route('persyaratan') }}" class="block text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2">
                                <i class="fas fa-list-check mr-2"></i> Persyaratan
                            </a>
                        </div>

                        <!-- Mobile Right Navigation -->
                        <div class="space-y-2 border-t border-white border-opacity-30 pt-4">
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard Admin
                                    </a>
                                @endif

                                <div class="block text-white font-medium py-2">
                                    <i class="fas fa-user-circle mr-2"></i> {{ auth()->user()->name }}
                                </div>

                                <form action="{{ route('logout') }}" method="POST" class="block">
                                    @csrf
                                    <button type="submit" class="text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2 text-left w-full">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                                </a>
                                <a href="{{ route('register') }}" class="block text-white font-medium hover:text-gray-100 transition-colors duration-300 py-2">
                                    <i class="fas fa-user-plus mr-2"></i> Register
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with top padding to compensate for fixed navbar -->
    <main class="pt-20 pb-4">
        @if (session('success'))
            <div class="container mx-auto px-4">
                <div class="alert-gradient-success text-white rounded-xl shadow-lg mb-6 p-4 flex items-center justify-between" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="text-white hover:text-gray-200 transition-colors" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mx-auto px-4">
                <div class="alert-gradient-danger text-white rounded-xl shadow-lg mb-6 p-4 flex items-center justify-between" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle mr-3"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button type="button" class="text-white hover:text-gray-200 transition-colors" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer-gradient text-white text-center py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-center items-center">
                <p class="mb-0 flex items-center">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    &copy; 2025 Sistem Pendaftaran Beasiswa
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Sticky Navbar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNavbar');
            let lastScrollTop = 0;

            // Function to handle scroll behavior
            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 100) {
                    // Add sticky styles when scrolled down
                    navbar.classList.add('navbar-sticky');
                    navbar.classList.add('shadow-2xl');
                } else {
                    // Remove sticky styles when at top
                    navbar.classList.remove('navbar-sticky');
                    navbar.classList.remove('shadow-2xl');
                }

                lastScrollTop = scrollTop;
            }

            // Add scroll event listener with throttling for better performance
            let ticking = false;

            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(handleScroll);
                    ticking = true;
                    setTimeout(() => ticking = false, 16); // ~60fps
                }
            }

            window.addEventListener('scroll', requestTick);

            // Add active class to current page nav link
            const currentLocation = location.pathname;
            const menuItems = document.querySelectorAll('.nav-link-underline');

            menuItems.forEach(item => {
                if (item.getAttribute('href') === currentLocation) {
                    item.classList.add('active');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const offsetTop = target.offsetTop - navbar.offsetHeight - 20;
                        window.scrollTo({
                            top: offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                const navbarCollapse = document.getElementById('navbarNav');
                const toggleButton = document.querySelector('[data-bs-target="#navbarNav"]');

                if (navbarCollapse && !navbarCollapse.contains(e.target) && !toggleButton.contains(e.target)) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            });
        });
    </script>

    @yield('scripts')
</body>

</html>
