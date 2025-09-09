@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<!-- Welcome Header -->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
        <p class="text-muted mb-0">
            <i class="fas fa-user me-2"></i>Selamat datang, <strong>{{ auth()->user()->name }}</strong>
            <span class="mx-2">•</span>
            <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::now()->format('l, d F Y') }}
        </p>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-0 bg-primary text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total Beasiswa</h6>
                        <h4 class="mb-0 fw-bold">
                            <span class="counter" data-target="{{ $totalBeasiswa ?? 0 }}">0</span>
                        </h4>
                        <small class="opacity-75">
                            <i class="fas fa-arrow-up me-1"></i>Program Tersedia
                        </small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-graduation-cap fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-0 bg-success text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Beasiswa Aktif</h6>
                        <h4 class="mb-0 fw-bold">
                            <span class="counter" data-target="{{ $beasiswaAktif ?? 0 }}">0</span>
                        </h4>
                        <small class="opacity-75">
                            <i class="fas fa-check-circle me-1"></i>Aktif Saat Ini
                        </small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-0 bg-info text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Total Pendaftar</h6>
                        <h4 class="mb-0 fw-bold">
                            <span class="counter" data-target="{{ $totalPendaftar ?? 0 }}">0</span>
                        </h4>
                        <small class="opacity-75">
                            <i class="fas fa-users me-1"></i>Mahasiswa Terdaftar
                        </small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-0 bg-warning text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title mb-1">Menunggu Review</h6>
                        <h4 class="mb-0 fw-bold">
                            <span class="counter" data-target="{{ $pendaftarPending ?? 0 }}">0</span>
                        </h4>
                        <small class="opacity-75">
                            <i class="fas fa-clock me-1"></i>Perlu Ditinjau
                        </small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-clock fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Cards -->
<div class="row">
    <!-- Status Overview -->
    <div class="col-lg-8 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-chart-pie text-primary me-2"></i>Status Pendaftar Overview
                        </h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <div class="status-card bg-warning-soft p-4 rounded-3 h-100 border">
                            <div class="status-icon mb-3">
                                <div class="icon-circle bg-warning text-white rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                    <i class="fas fa-clock fa-xl"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold text-warning mb-1">
                                <span class="counter" data-target="{{ $pendaftarPending ?? 0 }}">0</span>
                            </h3>
                            <p class="text-muted mb-2 fw-semibold">Menunggu Review</p>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: {{ $totalPendaftar > 0 ? (($pendaftarPending ?? 0) / $totalPendaftar) * 100 : 0 }}%"></div>
                            </div>
                            <small class="text-muted fw-medium">
                                {{ $totalPendaftar > 0 ? number_format((($pendaftarPending ?? 0) / $totalPendaftar) * 100, 1) : 0 }}% dari total
                            </small>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="status-card bg-success-soft p-4 rounded-3 h-100 border">
                            <div class="status-icon mb-3">
                                <div class="icon-circle bg-success text-white rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                    <i class="fas fa-check-circle fa-xl"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold text-success mb-1">
                                <span class="counter" data-target="{{ $pendaftarDiterima ?? 0 }}">0</span>
                            </h3>
                            <p class="text-muted mb-2 fw-semibold">Diterima</p>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $totalPendaftar > 0 ? (($pendaftarDiterima ?? 0) / $totalPendaftar) * 100 : 0 }}%"></div>
                            </div>
                            <small class="text-muted fw-medium">
                                {{ $totalPendaftar > 0 ? number_format((($pendaftarDiterima ?? 0) / $totalPendaftar) * 100, 1) : 0 }}% dari total
                            </small>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="status-card bg-danger-soft p-4 rounded-3 h-100 border">
                            <div class="status-icon mb-3">
                                <div class="icon-circle bg-danger text-white rounded-circle mx-auto d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                                    <i class="fas fa-times-circle fa-xl"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold text-danger mb-1">
                                <span class="counter" data-target="{{ $pendaftarDitolak ?? 0 }}">0</span>
                            </h3>
                            <p class="text-muted mb-2 fw-semibold">Ditolak</p>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-danger" style="width: {{ $totalPendaftar > 0 ? (($pendaftarDitolak ?? 0) / $totalPendaftar) * 100 : 0 }}%"></div>
                            </div>
                            <small class="text-muted fw-medium">
                                {{ $totalPendaftar > 0 ? number_format((($pendaftarDitolak ?? 0) / $totalPendaftar) * 100, 1) : 0 }}% dari total
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="card-title mb-0">
                    <i class="fas fa-bolt text-primary me-2"></i>Menu Cepat
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-success btn-lg text-start text-decoration-none">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="quick-action-icon bg-white text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-plus-circle"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold">Tambah Beasiswa</div>
                                <small class="opacity-75">Buat program beasiswa baru</small>
                            </div>
                            <div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.beasiswa.index') }}" class="btn btn-primary btn-lg text-start text-decoration-none">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="quick-action-icon bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold">Kelola Beasiswa</div>
                                <small class="opacity-75">Edit dan monitor beasiswa</small>
                            </div>
                            <div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-info btn-lg text-start text-decoration-none">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="quick-action-icon bg-white text-info rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-bold">Kelola Pendaftar</div>
                                <small class="opacity-75">Review beasiswa</small>
                            </div>
                            <div>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Message if no data -->
@if(($totalBeasiswa ?? 0) == 0)
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <div class="empty-state-icon bg-light rounded-circle mx-auto mb-4 d-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                    <i class="fas fa-graduation-cap fa-4x text-muted"></i>
                </div>
                <h4 class="text-muted mb-3">Selamat Datang di Sistem Beasiswa!</h4>
                <p class="text-muted mb-4">
                    Belum ada data beasiswa dalam sistem. Mari mulai dengan menambahkan program beasiswa pertama Anda.
                </p>
                <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Tambah Beasiswa Pertama
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Custom CSS -->
<style>
/* Status Badge Colors - Same as kelola beasiswa */
.bg-success-soft { background-color: #d1edff !important; }
.bg-warning-soft { background-color: #fff3cd !important; }
.bg-danger-soft { background-color: #f8d7da !important; }
.bg-info-soft { background-color: #d1ecf1 !important; }
.bg-secondary-soft { background-color: #e2e3e5 !important; }

/* Stats Cards - Same gradient style as kelola beasiswa */
.card.bg-primary, .card.bg-success, .card.bg-info, .card.bg-warning {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%);
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
}

.card.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%) !important;
}

.card.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
}

.card:hover {
    transform: translateY(-2px);
}

/* Status Cards */
.status-card {
    transition: all 0.3s ease;
    border: 1px solid #e9ecef !important;
}

.status-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.icon-circle {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Quick Action Buttons */
.btn-lg {
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-lg:hover {
    transform: translateX(5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

.quick-action-icon {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Counter Animation */
.counter {
    display: inline-block;
    transition: all 0.3s ease;
}

/* Avatar Initial - Same style as kelola beasiswa */
.avatar-initial {
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Progress bars */
.progress {
    border-radius: 10px;
    overflow: hidden;
    background-color: rgba(0,0,0,0.1);
}

.progress-bar {
    border-radius: 10px;
}

/* Info Items */
.info-item {
    transition: all 0.2s ease;
    background-color: #f8f9fa;
}

.info-item:hover {
    background-color: #e9ecef;
    transform: translateX(2px);
}

/* Recent Items */
.recent-item {
    transition: all 0.2s ease;
}

.recent-item:hover {
    background-color: #f8f9fa;
}

/* Empty State - Same as kelola beasiswa */
.empty-state-icon {
    transition: all 0.3s ease;
}

.empty-state:hover .empty-state-icon {
    transform: scale(1.05);
}

/* Badge improvements - Same as kelola beasiswa */
.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.badge.fs-6 {
    font-size: 0.9rem !important;
}

/* Card Header consistency */
.card-header {
    border-bottom: 2px solid #dee2e6;
}

.card-title {
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
}

/* Responsive adjustments - Same as kelola beasiswa */
@media (max-width: 768px) {
    .card {
        margin-bottom: 1rem;
    }

    .btn-lg {
        font-size: 1rem;
        padding: 0.75rem 1rem;
    }

    .status-card {
        margin-bottom: 1rem;
    }

    .avatar-initial {
        width: 35px !important;
        height: 35px !important;
        font-size: 12px;
    }

    .icon-circle {
        width: 45px !important;
        height: 45px !important;
    }

    .quick-action-icon {
        width: 35px !important;
        height: 35px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter animation - Enhanced version
    function animateCounter(element, target) {
        let current = 0;
        const increment = Math.max(1, target / 50);
        const duration = 1500;
        const stepTime = duration / 50;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, stepTime);
    }

    // Initialize counters with staggered delay
    setTimeout(() => {
        document.querySelectorAll('.counter').forEach((counter, index) => {
            const target = parseInt(counter.getAttribute('data-target'));
            setTimeout(() => {
                animateCounter(counter, target);
            }, index * 150);
        });
    }, 300);

    // Tooltip initialization - Same as kelola beasiswa
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Add smooth animations to all cards
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.style.transition = 'all 0.3s ease';
    });

    // Real-time clock update
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID');
        const clockElements = document.querySelectorAll('.system-clock');
        clockElements.forEach(el => el.textContent = timeString);
    }

    setInterval(updateClock, 1000);
    updateClock();

    // Enhanced hover effects for stats cards
    document.querySelectorAll('.card.bg-primary, .card.bg-success, .card.bg-info, .card.bg-warning').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 6px 20px rgba(0,0,0,0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1)';
        });
    });
});
</script>
@endsection
