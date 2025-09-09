@extends('layouts.admin')

@section('title', 'Edit Beasiswa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2"><i class="fas fa-edit"></i> Edit Beasiswa</h1>
        <p class="text-muted mb-0">
            <i class="fas fa-info-circle me-2"></i>Perbarui informasi beasiswa yang sudah ada
        </p>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-graduation-cap text-warning me-2"></i>Form Edit Beasiswa
                        </h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-warning-soft text-warning">
                            <i class="fas fa-edit me-1" style="font-size: 8px;"></i>Edit Mode
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.beasiswa.update', $beasiswa) }}" method="POST" id="beasiswaForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Form Section 1: Basic Information -->
                    <div class="form-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-info-circle text-primary me-2"></i>Informasi Dasar
                        </h6>
                        
                        <div class="mb-3">
                            <label for="nama_beasiswa" class="form-label fw-semibold">
                                <i class="fas fa-trophy text-warning me-2"></i>Nama Beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-graduation-cap text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0 @error('nama_beasiswa') is-invalid @enderror" 
                                       id="nama_beasiswa" 
                                       name="nama_beasiswa" 
                                       value="{{ old('nama_beasiswa', $beasiswa->nama_beasiswa) }}" 
                                       placeholder="Contoh: Beasiswa Prestasi Akademik 2025"
                                       required>
                                @error('nama_beasiswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">
                                <i class="fas fa-align-left text-info me-2"></i>Deskripsi Beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4"
                                      placeholder="Jelaskan tujuan, target penerima, dan manfaat beasiswa ini..."
                                      required>{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>Berikan deskripsi yang jelas dan menarik untuk calon pendaftar
                            </small>
                        </div>
                    </div>

                    <!-- Form Section 2: Financial & Schedule -->
                    <div class="form-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-calendar-dollar text-success me-2"></i>Dana & Jadwal
                        </h6>

                        <div class="mb-3">
                            <label for="jumlah_dana" class="form-label fw-semibold">
                                <i class="fas fa-money-bill-wave text-success me-2"></i>Jumlah Dana
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">Rp</span>
                                <input type="number" 
                                       class="form-control border-start-0 @error('jumlah_dana') is-invalid @enderror" 
                                       id="jumlah_dana" 
                                       name="jumlah_dana" 
                                       value="{{ old('jumlah_dana', $beasiswa->jumlah_dana) }}" 
                                       min="0"
                                       step="100000"
                                       placeholder="5000000"
                                       required>
                                @error('jumlah_dana')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i>Masukkan jumlah dana dalam Rupiah (contoh: 5000000 untuk 5 juta)
                            </small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_buka" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-plus text-success me-2"></i>Tanggal Buka
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar text-muted"></i>
                                    </span>
                                    <input type="date" 
                                           class="form-control border-start-0 @error('tanggal_buka') is-invalid @enderror" 
                                           id="tanggal_buka" 
                                           name="tanggal_buka" 
                                           value="{{ old('tanggal_buka', \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('Y-m-d')) }}" 
                                           required>
                                    @error('tanggal_buka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal_tutup" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-times text-danger me-2"></i>Tanggal Tutup
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar text-muted"></i>
                                    </span>
                                    <input type="date" 
                                           class="form-control border-start-0 @error('tanggal_tutup') is-invalid @enderror" 
                                           id="tanggal_tutup" 
                                           name="tanggal_tutup" 
                                           value="{{ old('tanggal_tutup', \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('Y-m-d')) }}" 
                                           required>
                                    @error('tanggal_tutup')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div id="dateRangeInfo" class="alert alert-info-soft d-none">
                            <i class="fas fa-info-circle me-2"></i>
                            <span id="dateRangeText"></span>
                        </div>
                    </div>

                    <!-- Form Section 3: Status & Requirements -->
                    <div class="form-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-cogs text-warning me-2"></i>Status & Persyaratan
                        </h6>

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">
                                <i class="fas fa-toggle-on text-primary me-2"></i>Status Beasiswa
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="aktif" {{ old('status', $beasiswa->status) == 'aktif' ? 'selected' : '' }}>
                                    <i class="fas fa-check-circle"></i> Aktif (Bisa dilamar)
                                </option>
                                <option value="nonaktif" {{ old('status', $beasiswa->status) == 'nonaktif' ? 'selected' : '' }}>
                                    <i class="fas fa-times-circle"></i> Nonaktif (Tidak bisa dilamar)
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="persyaratan" class="form-label fw-semibold">
                                <i class="fas fa-list-check text-info me-2"></i>Persyaratan Pendaftaran
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" 
                                      id="persyaratan" 
                                      name="persyaratan" 
                                      rows="8"
                                      placeholder="Contoh:&#10;1. Mahasiswa aktif semester 3 ke atas&#10;2. IPK minimal 3.0&#10;3. Tidak sedang menerima beasiswa lain&#10;4. Melampirkan transkrip nilai terbaru&#10;5. Surat rekomendasi dari dosen"
                                      required>{{ old('persyaratan', $beasiswa->persyaratan) }}</textarea>
                            @error('persyaratan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>Tuliskan persyaratan dengan jelas, gunakan numbering untuk kemudahan membaca
                            </small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions bg-light p-3 rounded-3 mt-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Pastikan semua perubahan sudah benar sebelum menyimpan</small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.beasiswa.index') }}" 
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="reset" class="btn btn-outline-warning">
                                    <i class="fas fa-undo me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-2"></i>Update Beasiswa
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Tips Card -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white py-3">
                <h6 class="card-title mb-0">
                    <i class="fas fa-lightbulb text-warning me-2"></i>Tips Edit Beasiswa
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-exclamation-triangle text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Hati-hati Mengubah Tanggal</h6>
                                    <small class="text-muted">Perubahan tanggal dapat mempengaruhi pendaftar yang sudah ada</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-eye text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Preview Perubahan</h6>
                                    <small class="text-muted">Pastikan semua informasi sudah sesuai sebelum menyimpan</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-users text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Dampak ke Pendaftar</h6>
                                    <small class="text-muted">Pertimbangkan dampak perubahan terhadap calon pendaftar</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tip-item">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-bell text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Notifikasi</h6>
                                    <small class="text-muted">Sistem akan memberitahu perubahan penting kepada pendaftar</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS -->
<style>
/* Status Badge Colors - Same as dashboard */
.bg-success-soft { background-color: #d1edff !important; }
.bg-warning-soft { background-color: #fff3cd !important; }
.bg-danger-soft { background-color: #f8d7da !important; }
.bg-info-soft { background-color: #d1ecf1 !important; }
.bg-secondary-soft { background-color: #e2e3e5 !important; }

/* Alert styling */
.alert-info-soft {
    background-color: #d1ecf1;
    border: 1px solid #bee5eb;
    color: #0c5460;
    border-radius: 8px;
}

/* Form sections */
.form-section {
    border-left: 4px solid var(--mint-primary, #00c9a7);
    padding-left: 1rem;
    margin-left: 0.5rem;
}

.section-title {
    font-weight: 600;
    color: #495057;
    font-size: 1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e9ecef;
}

/* Input group styling */
.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
    color: #6c757d;
}

.form-control {
    border-radius: 0.375rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--mint-primary, #00c9a7);
    box-shadow: 0 0 0 0.2rem rgba(0, 201, 167, 0.25);
}

/* Form labels */
.form-label {
    color: #495057;
    margin-bottom: 0.5rem;
}

/* Button enhancements */
.btn {
    border-radius: 0.375rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(45deg, var(--mint-primary, #00c9a7), var(--mint-blue, #0891b2));
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(45deg, var(--mint-dark, #00a693), var(--mint-secondary, #00bcd4));
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 201, 167, 0.4);
}

.btn-warning {
    background: linear-gradient(45deg, #ffc107, #ff9800);
    border: none;
    color: white;
}

.btn-warning:hover {
    background: linear-gradient(45deg, #e0a800, #f57c00);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
}

.btn-outline-secondary:hover,
.btn-outline-warning:hover {
    transform: translateY(-1px);
}

/* Form actions */
.form-actions {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border: 1px solid #dee2e6;
}

/* Tips section */
.tip-item {
    transition: all 0.3s ease;
    padding: 0.75rem;
    border-radius: 8px;
}

.tip-item:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
}

.tip-icon {
    width: 20px;
    text-align: center;
}

/* Card consistency */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.card-header {
    border-bottom: 2px solid #dee2e6;
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
}

.card-title {
    font-weight: 600;
    font-size: 0.875rem;
    color: #495057;
}

/* Responsive */
@media (max-width: 768px) {
    .form-section {
        border-left: none;
        border-top: 3px solid var(--mint-primary, #00c9a7);
        padding-left: 0;
        padding-top: 1rem;
        margin-left: 0;
    }
    
    .form-actions {
        padding: 1.5rem;
    }
    
    .d-flex.gap-2 {
        flex-direction: column;
        width: 100%;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Custom mint-blue variables */
:root {
    --mint-primary: #00c9a7;
    --mint-secondary: #00bcd4;
    --mint-dark: #00a693;
    --mint-light: #4dd0e1;
    --mint-blue: #0891b2;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tanggalBuka = document.getElementById('tanggal_buka');
    const tanggalTutup = document.getElementById('tanggal_tutup');
    const dateRangeInfo = document.getElementById('dateRangeInfo');
    const dateRangeText = document.getElementById('dateRangeText');
    const jumlahDanaInput = document.getElementById('jumlah_dana');
    
    // Date range calculator
    function calculateDateRange() {
        if (tanggalBuka.value && tanggalTutup.value) {
            const startDate = new Date(tanggalBuka.value);
            const endDate = new Date(tanggalTutup.value);
            const timeDiff = endDate - startDate;
            const daysDiff = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            
            if (daysDiff > 0) {
                dateRangeInfo.classList.remove('d-none');
                dateRangeText.textContent = `Periode pendaftaran: ${daysDiff} hari (${startDate.toLocaleDateString('id-ID')} - ${endDate.toLocaleDateString('id-ID')})`;
                
                if (daysDiff < 7) {
                    dateRangeInfo.className = 'alert alert-warning';
                    dateRangeText.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>' + dateRangeText.textContent + ' - Periode terlalu singkat!';
                } else {
                    dateRangeInfo.className = 'alert alert-info-soft';
                    dateRangeText.innerHTML = '<i class="fas fa-info-circle me-2"></i>' + dateRangeText.textContent;
                }
            } else {
                dateRangeInfo.className = 'alert alert-danger';
                dateRangeInfo.classList.remove('d-none');
                dateRangeText.innerHTML = '<i class="fas fa-times-circle me-2"></i>Tanggal tutup harus setelah tanggal buka!';
            }
        } else {
            dateRangeInfo.classList.add('d-none');
        }
    }
    
    // Initial calculation on page load
    calculateDateRange();
    
    // Event listeners
    tanggalBuka.addEventListener('change', calculateDateRange);
    tanggalTutup.addEventListener('change', calculateDateRange);
    
    // Form validation
    document.getElementById('beasiswaForm').addEventListener('submit', function(e) {
        const startDate = new Date(tanggalBuka.value);
        const endDate = new Date(tanggalTutup.value);
        
        if (endDate <= startDate) {
            e.preventDefault();
            alert('Tanggal tutup harus setelah tanggal buka!');
            return false;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds (in case of validation errors)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });
    
    // Auto-resize textarea
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Initial resize for existing content
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
    });
    
    // Show changes indicator
    const originalValues = {};
    document.querySelectorAll('input, select, textarea').forEach(field => {
        originalValues[field.name] = field.value;
        
        field.addEventListener('change', function() {
            if (this.value !== originalValues[this.name]) {
                this.classList.add('changed');
            } else {
                this.classList.remove('changed');
            }
        });
    });
    
    // Tooltip initialization
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>

<style>
/* Additional style for changed fields indicator */
.form-control.changed,
.form-select.changed {
    border-left: 4px solid #ffc107 !important;
    background-color: #fff3cd;
}

.changed + .input-group-text {
    background-color: #fff3cd;
}
</style>
@endsection