@extends('layouts.app')

@section('title', 'Persyaratan Beasiswa')

@section('content')
    <div class="container">
        <!-- Enhanced Hero Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="hero-section position-relative overflow-hidden rounded-3 shadow-lg">
                    <div class="hero-background"></div>
                    <div class="hero-content position-relative p-5 text-white">
                        <div class="row align-items-center min-vh-40">
                            <div class="col-lg-8">
                                <div class="hero-text">
                                    <span class="badge bg-light text-primary fs-6 mb-3 px-3 py-2">
                                        <i class="fas fa-info-circle me-2"></i>Panduan Lengkap
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 hero-title">
                                        <i class="fas fa-list-check me-3"></i>
                                        Persyaratan Pendaftaran
                                        <span class="text-warning">Beasiswa</span>
                                    </h1>
                                    <p class="lead mb-4 hero-description">
                                        Pelajari semua ketentuan dan persyaratan yang harus dipenuhi untuk mendaftar program beasiswa
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center">
                                <div class="hero-illustration">
                                    <div class="floating-icon">
                                        <i class="fas fa-clipboard-check fa-6x text-warning opacity-75"></i>
                                    </div>
                                    <div class="floating-elements">
                                        <div class="floating-element element-1">
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <div class="floating-element element-2">
                                            <i class="fas fa-certificate text-info"></i>
                                        </div>
                                        <div class="floating-element element-3">
                                            <i class="fas fa-award text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="persyaratan-detail" class="row">
            <div class="col-12">
                <!-- Persyaratan Umum -->
                <div id="persyaratan-umum" class="card mb-5 shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-list-ul me-2"></i>Ketentuan Persyaratan Umum
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Setiap pendaftar wajib mengisi formulir pendaftaran dengan lengkap
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Masing-masing peserta hanya diperkenankan memilih 1 (satu) kategori beasiswa
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Data yang diisikan harus sesuai dengan data asli
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Siswa SMK reguler kelas XI (sebelas) sampai XII (dua belas)
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Wajib terdaftar sebagai siswa aktif SMK dari semua jurusan
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Tidak sedang menerima beasiswa dari lembaga lain
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Tidak sedang dikenakan sanksi pelanggaran tata tertib sekolah
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Tidak sedang dalam proses hukum atau pelanggaran hukum lainnya
                                    </li>
                                    <li class="list-group-item border-0 ps-0">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Proses seleksi berdasarkan peringkat dan kelengkapan persyaratan
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            <a href="{{ route('home') }}" class="btn btn-primary w-100 py-3 fs-5">
                Pendaftaran Beasiswa
            </a>
        </div>
    </div>

    <style>
        .hero-section {
            min-height: 500px;
            position: relative;
        }

        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            z-index: 1;
        }

        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>') repeat;
            z-index: 2;
        }

        .hero-content {
            z-index: 3;
        }

        .min-vh-40 {
            min-height: 40vh;
        }

        .hero-title {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-description {
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .floating-icon {
            animation: float 6s ease-in-out infinite;
        }

        .floating-elements {
            position: relative;
        }

        .floating-element {
            position: absolute;
            font-size: 1.5rem;
            animation: float 4s ease-in-out infinite;
        }

        .element-1 {
            top: -20px;
            right: 50px;
            animation-delay: -1s;
        }

        .element-2 {
            top: 50px;
            right: -20px;
            animation-delay: -2s;
        }

        .element-3 {
            top: 100px;
            right: 80px;
            animation-delay: -3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .icon-box {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cta-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .smooth-scroll {
            scroll-behavior: smooth;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 400px;
            }
            
            .hero-content {
                padding: 2rem 1rem !important;
            }
            
            .display-4 {
                font-size: 2.5rem;
            }
            
            .floating-element {
                display: none;
            }
        }
    </style>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('.smooth-scroll').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
@endsection