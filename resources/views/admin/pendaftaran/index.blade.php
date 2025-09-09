@extends('layouts.admin')

@section('title', 'Kelola Pendaftar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-users"></i> Kelola Pendaftar</h1>
</div>


<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h6 class="card-title mb-0">
                    <i class="fas fa-list"></i> Daftar Pendaftar
                    @if($pendaftars->total() > 0)
                        <span class="badge bg-primary ms-2">{{ $pendaftars->total() }} Total</span>
                    @endif
                </h6>
            </div>
            <div class="col-auto">
                <small class="text-muted">
                    Menampilkan {{ $pendaftars->firstItem() ?? 0 }} - {{ $pendaftars->lastItem() ?? 0 }}
                    dari {{ $pendaftars->total() }} data
                </small>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        @if($pendaftars->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="min-width: 200px;">
                                <i class="fas fa-user"></i> Pendaftar
                            </th>
                            <th style="min-width: 180px;">
                                <i class="fas fa-graduation-cap"></i> Beasiswa
                            </th>
                            <th style="min-width: 200px;">
                                <i class="fas fa-envelope"></i> Kontak
                            </th>
                            <th class="text-center" style="width: 120px;">
                                <i class="fas fa-info-circle"></i> Status
                            </th>
                            <th class="text-center" style="width: 130px;">
                                <i class="fas fa-calendar"></i> Tanggal
                            </th>
                            <th class="text-center" style="width: 100px;">
                                <i class="fas fa-cogs"></i> Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftars as $index => $pendaftar)
                        <tr>
                            <td class="text-center fw-bold text-muted">
                                {{ $pendaftars->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="d-flex align-items-start">
                                    <div class="avatar-initial rounded-circle bg-primary text-white me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 14px;">
                                        {{ strtoupper(substr($pendaftar->nama_lengkap, 0, 2)) }}
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $pendaftar->nama_lengkap }}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-id-card me-1"></i>{{ $pendaftar->nim }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <h6 class="mb-1 text-primary">{{ $pendaftar->beasiswa->nama_beasiswa }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-money-bill-wave me-1"></i>
                                        Rp {{ number_format($pendaftar->beasiswa->jumlah_dana, 0, ',', '.') }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <div class="mb-1">
                                        <i class="fas fa-envelope text-muted me-1"></i>
                                        <small>{{ $pendaftar->email }}</small>
                                    </div>
                                    <div>
                                        <i class="fas fa-phone text-muted me-1"></i>
                                        <small>{{ $pendaftar->no_hp }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($pendaftar->status == 'pending')
                                    <span class="badge bg-warning-soft text-warning px-3 py-2">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                @elseif($pendaftar->status == 'diterima')
                                    <span class="badge bg-success-soft text-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger-soft text-danger px-3 py-2">
                                        <i class="fas fa-times-circle me-1"></i>Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div>
                                    <small class="fw-semibold">{{ $pendaftar->created_at->format('d M Y') }}</small>
                                    <br>
                                    <small class="text-muted">{{ $pendaftar->created_at->format('H:i') }}</small>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.pendaftar.show', $pendaftar) }}"
                                       class="btn btn-outline-info btn-sm"
                                       title="Lihat Detail"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Simple form delete (fallback) -->
                                    <form action="{{ route('admin.pendaftar.destroy', $pendaftar) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pendaftar {{ $pendaftar->nama_lengkap }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus Data"
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
                    <div class="empty-state-icon bg-light rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-users fa-2x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">Belum Ada Pendaftar</h5>
                    <p class="text-muted mb-0">Belum ada mahasiswa yang mendaftar beasiswa saat ini</p>
                </div>
            </div>
        @endif
    </div>

    @if($pendaftars->hasPages())
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Menampilkan {{ $pendaftars->firstItem() }} - {{ $pendaftars->lastItem() }}
                dari {{ $pendaftars->total() }} data
            </small>
            {{ $pendaftars->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Custom CSS for better badges -->
<style>
.bg-warning-soft { background-color: #fff3cd !important; }
.bg-success-soft { background-color: #d1edff !important; }
.bg-danger-soft { background-color: #f8d7da !important; }

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

.avatar-initial {
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
    font-weight: 500;
}

.btn-group .btn {
    border-radius: 0.375rem;
}

.btn-group .btn:not(:last-child) {
    margin-right: 0.25rem;
}

.empty-state-icon {
    transition: all 0.3s ease;
}

.empty-state:hover .empty-state-icon {
    transform: scale(1.05);
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
});
</script>
@endsection
