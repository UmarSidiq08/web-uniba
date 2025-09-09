@extends('layouts.app')

@section('title', 'Status Pendaftaran Beasiswa')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
        <div>
            <h1 class="h2">
                <i class="fas fa-clipboard-check text-primary me-2"></i>Status Pendaftaran Beasiswa
            </h1>
            <p class="text-muted mb-0">
                <i class="fas fa-user me-2"></i>{{ Auth::user()->name }} - {{ $userApplication->email }}
            </p>
        </div>
        <div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Main Status Card -->
            <div class="card status-main-card shadow-lg">
                <!-- Status Header with Visual Indicator -->
                <div class="card-header status-header p-0">
                    <div class="status-banner
                        @if($userApplication->status == 'pending') status-pending
                        @elseif($userApplication->status == 'diterima') status-accepted
                        @else status-rejected @endif">

                        <div class="status-icon">
                            @if($userApplication->status == 'pending')
                                <i class="fas fa-hourglass-half"></i>
                            @elseif($userApplication->status == 'diterima')
                                <i class="fas fa-check-circle"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                        </div>

                        <div class="status-content">
                            <h3 class="status-title">
                                @if($userApplication->status == 'pending')
                                    SEDANG DIPROSES
                                @elseif($userApplication->status == 'diterima')
                                    SELAMAT! ANDA DITERIMA
                                @else
                                    BELUM BERHASIL KALI INI
                                @endif
                            </h3>
                            <p class="status-subtitle">
                                @if($userApplication->status == 'pending')
                                    Pendaftaran Anda sedang dalam tahap review
                                @elseif($userApplication->status == 'diterima')
                                    Pendaftaran beasiswa Anda telah disetujui
                                @else
                                    Pendaftaran belum dapat disetujui saat ini
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Progress Timeline -->
                    <div class="timeline-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-route text-info me-2"></i>Progress Pendaftaran
                        </h6>

                        <div class="progress-timeline">
                            <div class="timeline-step completed">
                                <div class="step-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <div class="step-content">
                                    <h6 class="step-title">Pendaftaran Dikirim</h6>
                                    <p class="step-date">{{ $userApplication->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <div class="timeline-step {{ $userApplication->status != 'pending' ? 'completed' : 'active' }}">
                                <div class="step-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <div class="step-content">
                                    <h6 class="step-title">Review Dokumen</h6>
                                    <p class="step-date">
                                        @if($userApplication->status == 'pending')
                                            Sedang diproses...
                                        @else
                                            {{ $userApplication->updated_at->format('d M Y, H:i') }}
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="timeline-step {{ $userApplication->status == 'diterima' ? 'completed' : ($userApplication->status == 'ditolak' ? 'rejected' : '') }}">
                                <div class="step-icon">
                                    @if($userApplication->status == 'diterima')
                                        <i class="fas fa-trophy"></i>
                                    @elseif($userApplication->status == 'ditolak')
                                        <i class="fas fa-times"></i>
                                    @else
                                        <i class="fas fa-flag-checkered"></i>
                                    @endif
                                </div>
                                <div class="step-content">
                                    <h6 class="step-title">Hasil Akhir</h6>
                                    <p class="step-date">
                                        @if($userApplication->status == 'pending')
                                            Menunggu keputusan...
                                        @else
                                            {{ $userApplication->updated_at->format('d M Y, H:i') }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Beasiswa Information -->
                    <div class="beasiswa-info-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-graduation-cap text-success me-2"></i>Informasi Beasiswa
                        </h6>

                        <div class="beasiswa-card">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="beasiswa-name">{{ $userApplication->beasiswa->nama_beasiswa }}</h5>
                                    <p class="beasiswa-desc">{{ Str::limit($userApplication->beasiswa->deskripsi, 150) }}</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="beasiswa-amount">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>
                                        <span class="amount-text">Rp {{ number_format($userApplication->beasiswa->jumlah_dana, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Details -->
                    <div class="application-details mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-file-alt text-warning me-2"></i>Detail Pendaftaran Anda
                        </h6>

                        <div class="details-grid">
                            <div class="detail-item">
                                <label class="detail-label">Nama Lengkap</label>
                                <p class="detail-value">{{ $userApplication->nama_lengkap }}</p>
                            </div>
                            <div class="detail-item">
                                <label class="detail-label">NIM</label>
                                <p class="detail-value">{{ $userApplication->nim }}</p>
                            </div>
                            <div class="detail-item">
                                <label class="detail-label">Email</label>
                                <p class="detail-value">{{ $userApplication->email }}</p>
                            </div>
                            <div class="detail-item">
                                <label class="detail-label">No. HP</label>
                                <p class="detail-value">{{ $userApplication->no_hp }}</p>
                            </div>
                        </div>

                        @if($userApplication->alasan_mendaftar)
                        <div class="reason-section mt-3">
                            <label class="detail-label">Alasan Mendaftar</label>
                            <div class="reason-text">
                                {{ $userApplication->alasan_mendaftar }}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Documents Section -->
                    <div class="documents-section">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-folder-open text-info me-2"></i>Dokumen yang Diunggah
                        </h6>

                        <div class="row">
                            @if($userApplication->file_transkrip)
                            <div class="col-md-4 mb-3">
                                <div class="document-item">
                                    <div class="doc-icon">
                                        <i class="fas fa-file-pdf text-danger"></i>
                                    </div>
                                    <div class="doc-info">
                                        <h6 class="doc-title">Transkrip Nilai</h6>
                                        <a href="{{ asset('storage/documents/' . $userApplication->file_transkrip) }}"
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($userApplication->file_ktp)
                            <div class="col-md-4 mb-3">
                                <div class="document-item">
                                    <div class="doc-icon">
                                        <i class="fas fa-id-card text-primary"></i>
                                    </div>
                                    <div class="doc-info">
                                        <h6 class="doc-title">KTP</h6>
                                        <a href="{{ asset('storage/documents/' . $userApplication->file_ktp) }}"
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if($userApplication->file_kk)
                            <div class="col-md-4 mb-3">
                                <div class="document-item">
                                    <div class="doc-icon">
                                        <i class="fas fa-users text-success"></i>
                                    </div>
                                    <div class="doc-info">
                                        <h6 class="doc-title">Kartu Keluarga</h6>
                                        <a href="{{ asset('storage/documents/' . $userApplication->file_kk) }}"
                                           target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Footer -->
                <div class="card-footer bg-light border-0">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            @if($userApplication->status == 'pending')
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Informasi:</strong> Silakan tunggu proses review dari admin. Kami akan memberikan update status secepat mungkin.
                                </div>
                            @elseif($userApplication->status == 'diterima')
                                <div class="alert alert-success mb-0">
                                    <i class="fas fa-celebration me-2"></i>
                                    <strong>Selamat!</strong> Silakan tunggu informasi lebih lanjut melalui email atau kontak yang terdaftar.
                                </div>
                            @else
                                <div class="alert alert-secondary mb-0">
                                    <i class="fas fa-heart me-2"></i>
                                    <strong>Jangan menyerah!</strong> Tetap semangat dan coba daftar beasiswa lainnya yang tersedia.
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 text-end">
                            <button onclick="window.print()" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-print me-1"></i>Cetak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
:root {
    --mint-primary: #00c9a7;
    --mint-secondary: #00bcd4;
    --mint-dark: #00a693;
    --mint-light: #4dd0e1;
    --status-pending: #ffc107;
    --status-accepted: #28a745;
    --status-rejected: #dc3545;
}

.status-main-card {
    border: none;
    border-radius: 20px;
    overflow: hidden;
}

.status-header {
    background: white;
}

.status-banner {
    padding: 3rem 2rem;
    text-align: center;
    color: white;
    position: relative;
    background: linear-gradient(135deg, var(--mint-primary), var(--mint-secondary));
}

.status-banner.status-pending {
    background: linear-gradient(135deg, #ffc107, #fd7e14);
}

.status-banner.status-accepted {
    background: linear-gradient(135deg, #28a745, #20c997);
}

.status-banner.status-rejected {
    background: linear-gradient(135deg, #dc3545, #e83e8c);
}

.status-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.status-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.status-subtitle {
    font-size: 1.1rem;
    margin-bottom: 0;
    opacity: 0.9;
}

.section-title {
    font-weight: 600;
    color: #495057;
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 0.5rem;
}

/* Timeline Styles */
.progress-timeline {
    position: relative;
    padding: 1rem 0;
}

.timeline-step {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    position: relative;
}

.timeline-step::before {
    content: '';
    position: absolute;
    left: 25px;
    top: 50px;
    width: 2px;
    height: 40px;
    background: #dee2e6;
    z-index: 1;
}

.timeline-step:last-child::before {
    display: none;
}

.timeline-step.completed::before {
    background: var(--mint-primary);
}

.step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 1rem;
    position: relative;
    z-index: 2;
    background: #f8f9fa;
    color: #6c757d;
    border: 3px solid #dee2e6;
}

.timeline-step.completed .step-icon {
    background: var(--mint-primary);
    color: white;
    border-color: var(--mint-primary);
}

.timeline-step.active .step-icon {
    background: var(--status-pending);
    color: white;
    border-color: var(--status-pending);
    animation: pulse 2s infinite;
}

.timeline-step.rejected .step-icon {
    background: var(--status-rejected);
    color: white;
    border-color: var(--status-rejected);
}

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(255, 193, 7, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
    }
}

.step-content {
    flex: 1;
}

.step-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.25rem;
}

.step-date {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0;
}

/* Beasiswa Card */
.beasiswa-card {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 1.5rem;
}

.beasiswa-name {
    color: var(--mint-primary);
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.beasiswa-desc {
    color: #6c757d;
    margin-bottom: 0;
}

.amount-text {
    font-size: 1.25rem;
    font-weight: bold;
    color: #28a745;
}

/* Details Grid */
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 1rem;
}

.detail-item {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid var(--mint-primary);
}

.detail-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 0.25rem;
    display: block;
}

.detail-value {
    color: #495057;
    font-weight: 500;
    margin-bottom: 0;
}

.reason-section {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid var(--mint-secondary);
}

.reason-text {
    color: #495057;
    font-style: italic;
    line-height: 1.6;
    margin-bottom: 0;
}

/* Document Items */
.document-item {
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 10px;
    padding: 1rem;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
}

.document-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.doc-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.doc-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .status-banner {
        padding: 2rem 1rem;
    }

    .status-title {
        font-size: 1.5rem;
    }

    .status-subtitle {
        font-size: 1rem;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }

    .timeline-step {
        margin-bottom: 1.5rem;
    }
}

/* Print Styles */
@media print {
    .btn,
    .card-footer {
        display: none !important;
    }

    .status-banner {
        background: #f8f9fa !important;
        color: #495057 !important;
    }

    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
}

.alert {
    border: none;
    border-radius: 10px;
}

.alert-info {
    background: linear-gradient(135deg, #d1ecf1, #b8daff);
    color: #0c5460;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda, #c3e6cb);
    color: #155724;
}

.alert-secondary {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    color: #495057;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto refresh untuk status pending
    @if($userApplication->status == 'pending')
    setInterval(function() {
        // Optional: Auto refresh setiap 30 detik untuk status pending
        // location.reload();
    }, 30000);
    @endif

    // Smooth scroll untuk timeline
    const timelineSteps = document.querySelectorAll('.timeline-step');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
            }
        });
    });

    timelineSteps.forEach(step => {
        step.style.opacity = '0';
        step.style.transform = 'translateX(-20px)';
        step.style.transition = 'all 0.6s ease';
        observer.observe(step);
    });
});
</script>
@endsection
