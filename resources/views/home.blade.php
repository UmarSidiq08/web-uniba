@extends('layouts.app')

@section('title', 'Pendaftaran Beasiswa')

@section('content')
    <div class="container mx-auto px-4">
        <!-- Hero Carousel (unchanged) -->
        <div class="mb-12">
            <div class="w-full">
                <div id="heroCarousel" class="carousel slide rounded-2xl overflow-hidden shadow-2xl" data-bs-ride="carousel"
                    data-bs-interval="5000">
                    <div class="carousel-indicators">
                        @if ($beasiswas->count() > 0)
                            @foreach ($beasiswas as $index => $beasiswa)
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                                    @if ($index == 0) class="active" aria-current="true" @endif
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        @else
                            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        @endif
                    </div>

                    <!-- Carousel Inner -->
                    <div class="carousel-inner rounded-2xl">
                        @if ($beasiswas->count() > 0)
                            @foreach ($beasiswas as $index => $beasiswa)
                                <div class="carousel-item @if ($index == 0) active @endif">
                                    <div class="carousel-slide flex items-center min-h-[450px] h-[450px] px-6 py-12 text-white relative overflow-hidden cursor-pointer transition-all duration-300"
                                        style="background: {{ $beasiswa->isActive() ? 'linear-gradient(135deg, #7FFFD4 0%, #40E0D0 30%, #4682B4 100%)' : 'linear-gradient(135deg, #FFB6C1 0%, #FFA07A 30%, #CD5C5C 100%)' }};"
                                        data-scholarship-id="{{ $beasiswa->id }}">
                                        <div
                                            class="absolute inset-0 bg-black bg-opacity-10 hover:bg-opacity-5 transition-all duration-300">
                                        </div>
                                        <div class="container mx-auto relative z-10">
                                            <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
                                                <div class="md:col-span-8">
                                                    <!-- Status Badge -->
                                                    <div class="mb-4">
                                                        @if ($beasiswa->isActive())
                                                            <span
                                                                class="inline-flex items-center px-4 py-2 bg-green-500 text-white text-base font-semibold rounded-full shadow-lg">
                                                                <i class="fas fa-circle mr-2"></i>Pendaftaran Dibuka
                                                            </span>
                                                        @else
                                                            <span
                                                                class="inline-flex items-center px-4 py-2 bg-red-500 text-white text-base font-semibold rounded-full shadow-lg">
                                                                <i class="fas fa-circle mr-2"></i>Pendaftaran Ditutup
                                                            </span>
                                                        @endif
                                                    </div>

                                                    <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">
                                                        <i
                                                            class="fas fa-graduation-cap mr-2"></i>{{ $beasiswa->nama_beasiswa }}
                                                    </h1>

                                                    <p class="text-xl mb-4 drop-shadow-md">
                                                        {{ Str::limit($beasiswa->deskripsi, 150) }}</p>

                                                    <!-- Quick Info -->
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                                        <div>
                                                            <p class="mb-2 flex items-center">
                                                                <i class="fas fa-calendar mr-2"></i>
                                                                <strong class="mr-2">Di Buka:</strong>
                                                                {{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('d M Y') }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="mb-2 flex items-center">
                                                                <i class="fas fa-money-bill-wave mr-2"></i>
                                                                <strong class="mr-2">Dana:</strong>
                                                                Rp {{ number_format($beasiswa->jumlah_dana, 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                        <div>
                                                            <p class="mb-2 flex items-center">
                                                                <i class="fas fa-calendar mr-2"></i>
                                                                <strong class="mr-2">Batas:</strong>
                                                                {{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    @php
                                                        // Get specific application for this scholarship in carousel
                                                        $thisCarouselApplication = $userApplications->get(
                                                            $beasiswa->id,
                                                        );
                                                    @endphp

                                                    @if ($thisCarouselApplication)
                                                        <!-- User has application for THIS beasiswa -->
                                                        <a href="{{ route('status') }}"
                                                            class="carousel-cta-btn inline-flex items-center px-8 py-4 bg-white bg-opacity-95 text-gray-800 font-semibold rounded-full border-none transition-all duration-300 shadow-lg hover:bg-white hover:-translate-y-1 hover:shadow-2xl hover:text-teal-500 uppercase tracking-wider">
                                                            <i class="fas fa-check-circle mr-2"></i>Lihat Status Pendaftaran
                                                        </a>
                                                    @elseif($activeUserApplication)
                                                        <!-- User has active application in OTHER beasiswa -->
                                                        @if ($activeUserApplication->status == 'pending')
                                                            <button
                                                                class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full opacity-75 cursor-not-allowed"
                                                                disabled
                                                                title="Anda sudah mendaftar di beasiswa {{ $registeredBeasiswa ? $registeredBeasiswa->nama_beasiswa : 'lain' }}">
                                                                <i class="fas fa-user-check mr-2"></i>Sudah Mendaftar
                                                                Beasiswa Lain
                                                            </button>
                                                        @elseif($activeUserApplication->status == 'diterima')
                                                            <button
                                                                class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full opacity-75 cursor-not-allowed"
                                                                disabled
                                                                title="Anda sudah diterima di beasiswa {{ $registeredBeasiswa ? $registeredBeasiswa->nama_beasiswa : 'lain' }}">
                                                                <i class="fas fa-check-circle mr-2"></i>Sudah Diterima
                                                                Beasiswa Lain
                                                            </button>
                                                        @endif
                                                    @elseif($beasiswa->isActive())
                                                        <a href="{{ route('pendaftar.create', $beasiswa) }}"
                                                            class="carousel-cta-btn inline-flex items-center px-8 py-4 bg-white bg-opacity-95 text-gray-800 font-semibold rounded-full border-none transition-all duration-300 shadow-lg hover:bg-white hover:-translate-y-1 hover:shadow-2xl hover:text-teal-500 uppercase tracking-wider">
                                                            <i class="fas fa-paper-plane mr-2"></i>Daftar Sekarang
                                                        </a>
                                                    @else
                                                        <button
                                                            class="inline-flex items-center px-8 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full opacity-75 cursor-not-allowed"
                                                            disabled>
                                                            <i class="fas fa-lock mr-2"></i>Pendaftaran Ditutup
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="md:col-span-4 text-center">
                                                    <div class="carousel-icon-container relative inline-block">
                                                        <i class="fas fa-trophy text-8xl opacity-75"></i>
                                                        <div
                                                            class="icon-decoration absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-32 h-32 border-4 border-white border-opacity-30 rounded-full animate-pulse">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default slide if no scholarships -->
                            <div class="carousel-item active">
                                <div class="carousel-slide flex items-center min-h-[450px] h-[450px] px-6 py-12 text-white"
                                    style="background: linear-gradient(135deg, #7FFFD4 0%, #40E0D0 30%, #4682B4 100%);">
                                    <div class="container mx-auto">
                                        <div class="grid grid-cols-1 md:grid-cols-12 items-center gap-6">
                                            <div class="md:col-span-8">
                                                <h1 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">
                                                    <i class="fas fa-graduation-cap mr-2"></i>Sistem Pendaftaran Beasiswa
                                                </h1>
                                                <p class="text-xl mb-6 drop-shadow-md">Temukan dan daftarkan diri Anda untuk
                                                    berbagai program beasiswa yang tersedia</p>
                                                <p class="mb-6">Saat ini belum ada beasiswa yang tersedia. Silakan cek
                                                    kembali nanti!</p>
                                            </div>
                                            <div class="md:col-span-4 text-center">
                                                <i class="fas fa-graduation-cap text-8xl opacity-75"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Carousel Controls -->
                    @if ($beasiswas->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            </div>
        </div>

    <!-- Beasiswa List -->
    <div class="w-full" id="beasiswa-list">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">
                <i class="fas fa-graduation-cap text-teal-500 mr-4"></i>Beasiswa Tersedia
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Jelajahi berbagai program beasiswa yang dapat membantu mewujudkan impian pendidikan Anda
            </p>
        </div>

        @if($beasiswas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($beasiswas as $beasiswa)
                    @php
                        // Get specific application for this scholarship
                        $thisBeasiswaApplication = $userApplications->get($beasiswa->id);

                            // Determine if this card should be disabled
                            $shouldDisableCard = false;
                            if ($activeUserApplication) {
                                // Disable if user has pending OR accepted application in OTHER scholarship
                                if (
                                    ($activeUserApplication->status == 'pending' ||
                                        $activeUserApplication->status == 'diterima') &&
                                    $activeUserApplication->beasiswa_id != $beasiswa->id
                                ) {
                                    $shouldDisableCard = true;
                                }
                            }
                        @endphp

                        <div
                            class="scholarship-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden relative group animate-fadeInUp @if ($shouldDisableCard) opacity-70 grayscale-20 @endif">
                            <!-- Top gradient line -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-500 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left">
                            </div>

                            <!-- Card Header - Improved alignment and spacing -->
                            <div class="p-4 pb-2">
                                <div class="mb-3">
                                    <div class="scholarship-badge">
                                        @if ($thisBeasiswaApplication)
                                            @if ($thisBeasiswaApplication->status == 'pending')
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white text-sm font-semibold rounded-full shadow-lg animate-pulse">
                                                    <i class="fas fa-clock mr-1.5 text-xs"></i>Pending
                                                </span>
                                            @elseif($thisBeasiswaApplication->status == 'diterima')
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                                    <i class="fas fa-check-circle mr-1.5 text-xs"></i>Diterima
                                                </span>
                                            @elseif($thisBeasiswaApplication->status == 'ditolak')
                                                <span
                                                    class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                                    <i class="fas fa-times-circle mr-1.5 text-xs"></i>Ditolak
                                                </span>
                                            @endif
                                        @elseif($beasiswa->isActive())
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                                <i class="fas fa-circle mr-1.5 text-xs"></i>Aktif
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1.5 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-semibold rounded-full shadow-lg">
                                                <i class="fas fa-circle mr-1.5 text-xs"></i>Ditutup
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex justify-between items-start">
                                    <h5 class="text-xl font-bold text-gray-800 leading-tight flex-1 pr-3">
                                        {{ $beasiswa->nama_beasiswa }}</h5>
                                    <div class="text-2xl text-teal-500 opacity-80 flex-shrink-0">
                                        @if ($thisBeasiswaApplication)
                                            @if ($thisBeasiswaApplication->status == 'diterima')
                                                <i class="fas fa-medal text-yellow-500"></i>
                                            @elseif($thisBeasiswaApplication->status == 'ditolak')
                                                <i class="fas fa-times-circle text-red-500"></i>
                                            @else
                                                <i class="fas fa-clock text-blue-500"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-trophy"></i>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-gray-600 text-sm leading-relaxed mt-2">
                                    {{ Str::limit($beasiswa->deskripsi, 120) }}</p>
                            </div>

                            <!-- Card Body - Reduced spacing -->
                            <div class="px-4 pb-3">
                                <!-- Scholarship Info Grid - More compact -->
                                <div class="space-y-2">
                                    <div
                                        class="flex items-start space-x-3 p-2.5 bg-gray-50 rounded-xl hover:bg-blue-50 transition-colors duration-300 group">
                                        <div class="text-lg text-green-500 mt-0.5">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                        <div class="flex-1">
                                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Dana
                                                Beasiswa</label>
                                            <p class="text-sm text-green-600 font-medium">Rp
                                                {{ number_format($beasiswa->jumlah_dana, 0, ',', '.') }}</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start space-x-3 p-2.5 bg-gray-50 rounded-xl hover:bg-blue-50 transition-colors duration-300 group">
                                        <div class="text-lg text-blue-500 mt-0.5">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="flex-1">
                                            <label
                                                class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Periode</label>
                                            <p class="text-sm text-gray-800 font-medium">
                                                {{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('d M') }} -
                                                {{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex items-start space-x-3 p-2.5 bg-gray-50 rounded-xl hover:bg-blue-50 transition-colors duration-300 group">
                                        <div class="text-lg text-yellow-500 mt-0.5">
                                            <i class="fas fa-list-check"></i>
                                        </div>
                                        <div class="flex-1">
                                            <label
                                                class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Persyaratan</label>
                                            <p class="text-sm text-gray-700 leading-tight">
                                                {{ Str::limit($beasiswa->persyaratan, 100) }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Time Status - More compact -->
                                @php
                                    $today = now();
                                    $openDate = \Carbon\Carbon::parse($beasiswa->tanggal_buka);
                                    $closeDate = \Carbon\Carbon::parse($beasiswa->tanggal_tutup);
                                @endphp

                                <div class="mt-3">
                                    @if ($today < $openDate)
                                        <div
                                            class="bg-gradient-to-r from-yellow-100 to-yellow-200 border border-yellow-300 rounded-lg p-2 text-center">
                                            <div
                                                class="text-sm font-semibold text-yellow-800 flex items-center justify-center">
                                                <i class="fas fa-clock mr-2"></i>
                                                Dibuka dalam {{ $today->diffInDays($openDate) }} hari
                                            </div>
                                        </div>
                                    @elseif ($today >= $openDate && $today <= $closeDate)
                                        <div
                                            class="bg-gradient-to-r from-green-100 to-green-200 border border-green-300 rounded-lg p-2 text-center">
                                            <div
                                                class="text-sm font-semibold text-green-800 flex items-center justify-center">
                                                <i class="fas fa-calendar-check mr-2"></i>
                                                Tersisa {{ $today->diffInDays($closeDate) }} hari
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="bg-gradient-to-r from-red-100 to-red-200 border border-red-300 rounded-lg p-2 text-center">
                                            <div
                                                class="text-sm font-semibold text-red-800 flex items-center justify-center">
                                                <i class="fas fa-calendar-times mr-2"></i>
                                                Pendaftaran ditutup
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Footer - Button logic based on status -->
                            <div class="px-4 pb-4">
                                @if ($thisBeasiswaApplication)
                                    <!-- User has application for THIS beasiswa -->
                                    <a href="{{ route('status') }}"
                                        class="btn-scholarship w-full flex items-center justify-center py-3 px-5 bg-gradient-to-r from-cyan-500 to-cyan-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:from-cyan-600 hover:to-cyan-700 hover:-translate-y-1 hover:shadow-xl relative overflow-hidden group">
                                        <i class="fas fa-eye mr-2"></i>Lihat Status
                                        <div
                                            class="btn-shine absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-white via-opacity-30 to-transparent group-hover:left-[100%] transition-all duration-500">
                                        </div>
                                    </a>
                                @elseif($activeUserApplication)
                                    <!-- User has active application in OTHER beasiswa -->
                                    @if ($activeUserApplication->status == 'pending')
                                        <button
                                            class="w-full flex items-center justify-center py-3 px-5 bg-gray-300 text-gray-600 font-semibold rounded-xl cursor-not-allowed"
                                            disabled
                                            title="Anda sudah mendaftar di beasiswa {{ $registeredBeasiswa ? $registeredBeasiswa->nama_beasiswa : 'lain' }}">
                                            <i class="fas fa-user-check mr-2"></i>Sudah Mendaftar Beasiswa Lain
                                        </button>
                                    @elseif($activeUserApplication->status == 'diterima')
                                        <button
                                            class="w-full flex items-center justify-center py-3 px-5 bg-gray-300 text-gray-600 font-semibold rounded-xl cursor-not-allowed"
                                            disabled
                                            title="Anda sudah diterima di beasiswa {{ $registeredBeasiswa ? $registeredBeasiswa->nama_beasiswa : 'lain' }}">
                                            <i class="fas fa-check-circle mr-2"></i>Sudah Diterima Beasiswa Lain
                                        </button>
                                    @endif
                                @elseif($beasiswa->isActive())
                                    <!-- Normal registration for users with no active application -->
                                    <a href="{{ route('pendaftar.create', $beasiswa) }}"
                                        class="btn-scholarship w-full flex items-center justify-center py-3 px-5 bg-gradient-to-r from-teal-500 to-blue-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:from-teal-600 hover:to-blue-700 hover:-translate-y-1 hover:shadow-xl relative overflow-hidden group">
                                        <i class="fas fa-paper-plane mr-2"></i>Daftar Sekarang
                                        <div
                                            class="btn-shine absolute top-0 left-[-100%] w-full h-full bg-gradient-to-r from-transparent via-white via-opacity-30 to-transparent group-hover:left-[100%] transition-all duration-500">
                                        </div>
                                    </a>
                                @else
                                    <!-- Scholarship is not active -->
                                    <button
                                        class="w-full flex items-center justify-center py-3 px-5 bg-gray-300 text-gray-600 font-semibold rounded-xl cursor-not-allowed"
                                        disabled>
                                        <i class="fas fa-lock mr-2"></i>Pendaftaran Ditutup
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 text-gray-600">
                    <div class="text-8xl opacity-50 mb-8">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4 text-gray-700">Belum Ada Beasiswa Tersedia</h4>
                    <p class="text-lg max-w-lg mx-auto leading-relaxed">
                        Saat ini belum ada program beasiswa yang dibuka.
                        Silakan cek kembali nanti atau hubungi admin untuk informasi lebih lanjut.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Custom Tailwind Extensions -->
    <style>
        /* Carousel indicators custom styling */
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border: 2px solid white;
        }

        .carousel-indicators .active {
            background-color: white;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 30px;
            height: 30px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
        }

        /* Animation keyframes */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease forwards;
        }

        /* Staggered animation delays */
        .scholarship-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .scholarship-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .scholarship-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .scholarship-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .scholarship-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .scholarship-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        /* Grayscale utility */
        .grayscale-20 {
            filter: grayscale(20%);
        }

        /* Custom hover effects for carousel slides */
        .carousel-slide[data-scholarship-id]:hover {
            transform: scale(1.02);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .carousel-slide {
                min-height: 350px;
                height: 350px;
                padding: 2rem 1rem;
            }

            .text-4xl.md\:text-5xl {
                font-size: 2rem !important;
            }

            .text-8xl {
                font-size: 3rem !important;
            }

            .icon-decoration {
                width: 80px;
                height: 80px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Carousel click to register functionality
            document.querySelectorAll('.carousel-slide[data-scholarship-id]').forEach(slide => {
                slide.addEventListener('click', function(e) {
                    // Avoid triggering when clicking on the button itself
                    if (!e.target.closest('.carousel-cta-btn') && !e.target.closest('.btn')) {
                        const scholarshipId = this.getAttribute('data-scholarship-id');

                        // Check if the slide is for an active scholarship
                        const ctaButton = this.querySelector('.carousel-cta-btn');
                        if (ctaButton && !ctaButton.disabled) {
                            // Add visual feedback
                            this.style.transform = 'scale(0.98)';
                            setTimeout(() => {
                                this.style.transform = '';
                                window.location.href = ctaButton.href;
                            }, 150);
                        }
                    }
                });
            });

            // Add loading animation to scholarship cards
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.scholarship-card').forEach(card => {
                card.style.animationPlayState = 'paused';
                observer.observe(card);
            });

            // Enhanced carousel auto-play pause on hover
            const carousel = document.getElementById('heroCarousel');
            if (carousel) {
                carousel.addEventListener('mouseenter', () => {
                    carousel.setAttribute('data-bs-interval', 'false');
                });

                carousel.addEventListener('mouseleave', () => {
                    carousel.setAttribute('data-bs-interval', '5000');
                });
            }

            // Add click analytics and visual feedback
            document.querySelectorAll('.btn-scholarship').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    // Add loading state
                    const originalText = this.innerHTML;

                    if (this.href && this.href.includes('create')) {
                        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                    } else if (this.href && this.href.includes('status')) {
                        this.innerHTML =
                            '<i class="fas fa-spinner fa-spin mr-2"></i>Memuat Status...';
                    }

                    // Reset after a short delay (in case of slow navigation)
                    setTimeout(() => {
                        if (this.innerHTML.includes('Memproses') || this.innerHTML.includes(
                                'Memuat')) {
                            this.innerHTML = originalText;
                        }
                    }, 3000);

                    // Track scholarship clicks
                    const scholarshipTitle = this.closest('.scholarship-card').querySelector(
                        '.text-xl.font-bold').textContent;
                    console.log('Scholarship action clicked:', scholarshipTitle);
                });
            });

            // Add tooltip functionality for disabled buttons
            document.querySelectorAll('button[disabled][title]').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    // Create tooltip
                    const tooltip = document.createElement('div');
                    tooltip.className =
                        'custom-tooltip absolute bg-black bg-opacity-80 text-white text-sm px-3 py-2 rounded-md whitespace-nowrap z-50 pointer-events-none transform -translate-x-1/2 bottom-full left-1/2 mb-2';
                    tooltip.textContent = this.getAttribute('title');

                    // Add arrow
                    const arrow = document.createElement('div');
                    arrow.className =
                        'absolute top-full left-1/2 transform -translate-x-1/2 border-4 border-transparent border-t-black border-t-opacity-80';
                    tooltip.appendChild(arrow);

                    this.classList.add('relative');
                    this.appendChild(tooltip);
                });

                btn.addEventListener('mouseleave', function() {
                    const tooltip = this.querySelector('.custom-tooltip');
                    if (tooltip) {
                        tooltip.remove();
                    }
                });
            });

            // Add visual feedback for carousel interactions
            document.querySelectorAll('.carousel-indicators button').forEach(indicator => {
                indicator.addEventListener('click', function() {
                    // Add ripple effect
                    this.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 200);
                });
            });

            // Auto-update carousel indicators when new scholarships are added
            const updateCarouselIndicators = () => {
                const indicators = document.querySelector('.carousel-indicators');
                const slides = document.querySelectorAll('.carousel-item');

        if (indicators && slides.length > 0) {
            indicators.innerHTML = '';
            slides.forEach((slide, index) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.setAttribute('data-bs-target', '#heroCarousel');
                button.setAttribute('data-bs-slide-to', index);
                button.setAttribute('aria-label', `Slide ${index + 1}`);

                        if (index === 0) {
                            button.className = 'active';
                            button.setAttribute('aria-current', 'true');
                        }

                        indicators.appendChild(button);
                    });
                }
            };

            // Call update function on page load
            updateCarouselIndicators();

            // Enhanced user feedback for registered users
            const userRegistrationAlert = document.querySelector('.alert-info');
            if (userRegistrationAlert) {
                // Add close animation
                const closeBtn = userRegistrationAlert.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        userRegistrationAlert.style.transition = 'all 0.3s ease';
                        userRegistrationAlert.style.transform = 'translateY(-20px)';
                        userRegistrationAlert.style.opacity = '0';
                    });
                }

                // Auto-hide after 10 seconds
                setTimeout(() => {
                    if (userRegistrationAlert && !userRegistrationAlert.classList.contains('show')) {
                        userRegistrationAlert.style.transition = 'all 0.5s ease';
                        userRegistrationAlert.style.transform = 'translateY(-20px)';
                        userRegistrationAlert.style.opacity = '0.7';
                    }
                }, 10000);

            }
        });
    </script>
@endsection