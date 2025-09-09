@extends('layouts.admin')

@section('title', 'Kelola Beasiswa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-graduation-cap"></i> Kelola Beasiswa</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Beasiswa
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-0 bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Total Beasiswa</h6>
                        <h4 class="mb-0">{{ $beasiswas->total() ?? 0 }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-graduation-cap fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Beasiswa Aktif</h6>
                        <h4 class="mb-0">{{ $beasiswas->where('status', 'aktif')->count() }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-check-circle fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Total Pendaftar</h6>
                        <h4 class="mb-0">{{ $beasiswas->sum(function($b) { return $b->pendaftars->count(); }) }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title mb-1">Total Dana</h6>
                        <h4 class="mb-0 small">Rp {{ number_format($beasiswas->sum('jumlah_dana'), 0, ',', '.') }}</h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-money-bill-wave fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="card-title mb-0">
                    <i class="fas fa-list"></i> Daftar Beasiswa
                    @if($beasiswas->total() > 0)
                        <span class="badge bg-primary ms-2">{{ $beasiswas->total() }} Total</span>
                    @endif
                </h6>
            </div>
            <div class="col-auto">
                <small class="text-muted">
                    Menampilkan {{ $beasiswas->firstItem() ?? 0 }} - {{ $beasiswas->lastItem() ?? 0 }} 
                    dari {{ $beasiswas->total() }} data
                </small>
            </div>
        </div>
    </div>
    
    <div class="card-body p-0">
        @if($beasiswas->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="min-width: 250px;">
                                <i class="fas fa-graduation-cap"></i> Beasiswa
                            </th>
                            <th class="text-center" style="width: 150px;">
                                <i class="fas fa-money-bill-wave"></i> Dana
                            </th>
                            <th class="text-center" style="width: 180px;">
                                <i class="fas fa-calendar"></i> Periode
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="fas fa-info-circle"></i> Status
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="fas fa-users"></i> Pendaftar
                            </th>
                            <th class="text-center" style="width: 120px;">
                                <i class="fas fa-cogs"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beasiswas as $index => $beasiswa)
                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ $beasiswas->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-start">
                                    <div class="scholarship-icon rounded-circle bg-gradient-primary text-white me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $beasiswa->nama_beasiswa }}</h6>
                                        <small class="text-muted">{{ Str::limit($beasiswa->deskripsi, 60) }}</small>
                                        @if($beasiswa->persyaratan)
                                            <br><span class="badge bg-light text-dark mt-1">
                                                <i class="fas fa-list-ul me-1"></i>{{ Str::words($beasiswa->persyaratan, 3) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="dana-wrapper">
                                    <span class="fw-bold text-success h6 mb-0">
                                        Rp {{ number_format($beasiswa->jumlah_dana, 0, ',', '.') }}
                                    </span>
                                    <br>
                                    <small class="text-muted">
                                        @if($beasiswa->jumlah_dana >= 20000000)
                                            <span class="badge bg-success-soft text-success">Tinggi</span>
                                        @elseif($beasiswa->jumlah_dana >= 10000000)
                                            <span class="badge bg-warning-soft text-warning">Sedang</span>
                                        @else
                                            <span class="badge bg-info-soft text-info">Dasar</span>
                                        @endif
                                    </small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="periode-info">
                                    <div class="mb-1">
                                        <small class="fw-semibold text-success">
                                            <i class="fas fa-play me-1"></i>{{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('d M Y') }}
                                        </small>
                                    </div>
                                    <div>
                                        <small class="fw-semibold text-danger">
                                            <i class="fas fa-stop me-1"></i>{{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}
                                        </small>
                                    </div>
                                    <small class="text-muted">
                                        ({{ \Carbon\Carbon::parse($beasiswa->tanggal_buka)->diffInDays(\Carbon\Carbon::parse($beasiswa->tanggal_tutup)) }} hari)
                                    </small>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($beasiswa->status == 'aktif')
                                    @if($beasiswa->isActive())
                                        <span class="badge bg-success-soft text-success px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>Aktif
                                        </span>
                                    @else
                                        <span class="badge bg-warning-soft text-warning px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>Berakhir
                                        </span>
                                    @endif
                                @else
                                    <span class="badge bg-secondary-soft text-secondary px-3 py-2">
                                        <i class="fas fa-times-circle me-1"></i>Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="pendaftar-stats">
                                    <span class="badge bg-info-soft text-info fs-6 px-3 py-2">
                                        <i class="fas fa-users me-1"></i>{{ $beasiswa->pendaftars->count() }}
                                    </span>
                                    @if($beasiswa->pendaftars->count() > 0)
                                        <br><small class="text-muted mt-1">
                                            <a href="{{ route('admin.pendaftar.index', ['beasiswa' => $beasiswa->id]) }}" class="text-decoration-none">
                                                Lihat Detail
                                            </a>
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group-vertical btn-group-sm" role="group">
                                    <a href="{{ route('admin.beasiswa.show', $beasiswa) }}" 
                                       class="btn btn-outline-info btn-sm mb-1" 
                                       title="Lihat Detail"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.beasiswa.edit', $beasiswa) }}" 
                                       class="btn btn-outline-warning btn-sm mb-1" 
                                       title="Edit Beasiswa"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.beasiswa.destroy', $beasiswa) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus beasiswa {{ $beasiswa->nama_beasiswa }}? Data pendaftar juga akan terhapus!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm" 
                                                title="Hapus Beasiswa"
                                                data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <div class="empty-state-icon bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                        <i class="fas fa-graduation-cap fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum Ada Beasiswa</h5>
                    <p class="text-muted mb-3">Silakan tambahkan beasiswa baru untuk memulai program bantuan pendidikan</p>
                    <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Beasiswa Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
    
    @if($beasiswas->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $beasiswas->firstItem() }} - {{ $beasiswas->lastItem() }} 
                dari {{ $beasiswas->total() }} data
            </small>
            {{ $beasiswas->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Custom CSS -->
<style>
/* Status Badge Colors */
.bg-success-soft { background-color: #d1edff !important; }
.bg-warning-soft { background-color: #fff3cd !important; }
.bg-danger-soft { background-color: #f8d7da !important; }
.bg-info-soft { background-color: #d1ecf1 !important; }
.bg-secondary-soft { background-color: #e2e3e5 !important; }

/* Table Styling */
.table th {
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
    border-bottom: 2px solid #dee2e6;
}

.table td {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}

/* Scholarship Icon */
.scholarship-icon {
    font-size: 1.2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Dana Wrapper */
.dana-wrapper {
    line-height: 1.2;
}

/* Periode Info */
.periode-info {
    line-height: 1.3;
}

/* Button Groups */
.btn-group-vertical .btn {
    border-radius: 0.375rem !important;
    margin-bottom: 0.25rem;
}

.btn-group-vertical .btn:last-child {
    margin-bottom: 0;
}

/* Badge Improvements */
.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.badge.fs-6 {
    font-size: 0.9rem !important;
}

/* Stats Cards */
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

/* Empty State */
.empty-state-icon {
    transition: all 0.3s ease;
}

.empty-state:hover .empty-state-icon {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-group-vertical {
        flex-direction: row;
    }
    
    .stats-card .card-body {
        padding: 1rem;
    }
    
    .scholarship-icon {
        width: 35px !important;
        height: 35px !important;
        font-size: 1rem;
    }
}
</style>

<script>
// Tooltip initialization
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Add smooth animations
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.style.transition = 'all 0.3s ease';
    });
});
</script>
@endsection