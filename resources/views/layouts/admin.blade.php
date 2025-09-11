<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'orange-primary': '#FF8A00',
                        'orange-secondary': '#FFB347',
                        'orange-dark': '#E67700',
                        'yellow-warm': '#FFD700',
                        'yellow-light': '#FFF3A0',
                        'cream-base': '#FFF8DC',
                        'cream-light': '#FFFACD',
                        'amber-warm': '#FFBF00',
                    }
                }
            }
        }
    </script>

    <style>
        .navbar {
            transition: all 0.3s ease-in-out;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            background: linear-gradient(135deg, #FF8A00, #FFD700, #FFBF00) !important;
        }

        .navbar.sticky {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            background: rgba(255, 138, 0, 0.95) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        body.navbar-fixed {
            padding-top: 76px;
        }

        html {
            scroll-behavior: smooth;
        }

        .navbar-brand {
            transition: transform 0.2s ease;
            font-weight: 600;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: #ffffff !important;
        }

        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s ease;
            font-weight: 500;
            color: #ffffff !important;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background: linear-gradient(90deg, #fff, #FFF3A0);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            box-shadow: 0 0 8px rgba(255,255,255,0.8);
        }

        .navbar-nav .nav-link:hover::after {
            width: 80%;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
            text-shadow: 0 0 10px rgba(255,255,255,0.5);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border-radius: 8px;
            margin-top: 8px;
            background: linear-gradient(135deg, #FFF8DC, #FFFACD);
        }

        .dropdown-item {
            transition: all 0.2s ease;
            padding: 0.7rem 1.5rem;
            color: #495057;
        }

        .dropdown-item:hover {
            background: linear-gradient(45deg, #FF8A00, #FFBF00);
            color: white;
            transform: translateX(5px);
        }

        .sidebar {
            background: linear-gradient(180deg, #FFF8DC 0%, #FFFACD 100%) !important;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            min-height: calc(100vh - 56px);
            padding-top: 1rem;
        }

        .sidebar .nav-link {
            color: #495057;
            padding: 0.75rem 1rem;
            margin: 0.2rem 0.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(45deg, #FF8A00, #FFD700);
            color: white;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(255, 138, 0, 0.3);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(45deg, #FF8A00, #FFBF00);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 138, 0, 0.4);
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 100%;
            background: white;
            border-radius: 0 4px 4px 0;
        }

        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }

        main {
            background: linear-gradient(135deg, #FFFACD, #FFF8DC);
            min-height: calc(100vh - 56px);
            padding: 1.5rem;
        }

        .alert {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(45deg, #dc3545, #fd7e14);
            color: white;
        }

        .btn-primary {
            background: linear-gradient(45deg, #FF8A00, #FFBF00);
            border: none;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #E67700, #FFD700);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 138, 0, 0.4);
            color: white;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1019;
            display: none;
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed;
                top: 56px;
                left: -100%;
                width: 250px;
                height: calc(100vh - 56px);
                transition: left 0.3s ease;
                z-index: 1020;
            }

            .sidebar.show {
                left: 0;
            }

            main {
                margin-left: 0;
                width: 100%;
            }

            .navbar-toggler {
                border: 2px solid rgba(255,255,255,0.3);
                border-radius: 6px;
                color: white;
            }

            .navbar-toggler:focus {
                box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
            }

            body.navbar-fixed {
                padding-top: 66px;
            }
        }

        .card {
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .card-header {
            background: linear-gradient(45deg, #FFF8DC, #FFFACD);
            border-bottom: 1px solid rgba(255, 138, 0, 0.1);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #FF8A00, #FFBF00);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #E67700, #FFD700);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-cream-light to-cream-base">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" id="mainNavbar">
        <div class="container-fluid">
            <a class="navbar-brand text-white font-bold hover:scale-105 transition-transform duration-200" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-user-shield mr-2"></i> Admin Panel
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler d-md-none" type="button" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>

            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white font-medium hover:text-yellow-100 transition-colors duration-300" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle mr-1"></i> {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item hover:bg-orange-primary hover:text-white transition-all duration-200" href="{{ route('home') }}">
                            <i class="fas fa-home mr-2"></i> Lihat Website
                        </a></li>
                        <li><hr class="dropdown-divider border-orange-200"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item hover:bg-orange-primary hover:text-white transition-all duration-200 w-full text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar" id="sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-orange-primary hover:to-yellow-warm transition-all duration-300"
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt text-orange-primary"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.beasiswa.*') ? 'active' : '' }} text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-orange-primary hover:to-yellow-warm transition-all duration-300"
                               href="{{ route('admin.beasiswa.index') }}">
                                <i class="fas fa-graduation-cap text-orange-primary"></i> Kelola Beasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }} text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-orange-primary hover:to-yellow-warm transition-all duration-300"
                               href="{{ route('admin.pendaftar.index') }}">
                                <i class="fas fa-users text-orange-primary"></i> Kelola Pendaftar
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10">
                @if(session('success'))
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl shadow-lg mb-6 p-4 flex items-center justify-between" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="text-white hover:text-green-100 transition-colors" data-bs-dismiss="alert">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-xl shadow-lg mb-6 p-4 flex items-center justify-between" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-3"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="text-white hover:text-red-100 transition-colors" data-bs-dismiss="alert">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <div class="sidebar-overlay d-md-none" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.getElementById('mainNavbar');
            const body = document.body;
            let lastScrollTop = 0;

            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 100) {
                    navbar.classList.add('sticky');
                    body.classList.add('navbar-fixed');
                } else {
                    navbar.classList.remove('sticky');
                    body.classList.remove('navbar-fixed');
                }

                lastScrollTop = scrollTop;
            }

            let ticking = false;
            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(handleScroll);
                    ticking = true;
                    setTimeout(() => ticking = false, 16);
                }
            }

            window.addEventListener('scroll', requestTick);
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
                overlay.style.display = 'none';
            } else {
                sidebar.classList.add('show');
                overlay.style.display = 'block';
            }
        }

        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.querySelector('.navbar-toggler');

            if (window.innerWidth < 768 &&
                !sidebar.contains(e.target) &&
                !toggleBtn.contains(e.target) &&
                sidebar.classList.contains('show')) {
                toggleSidebar();
            }
        });
    </script>

    @yield('scripts')
</body>
</html>