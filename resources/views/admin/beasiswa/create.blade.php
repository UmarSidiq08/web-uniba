@extends('layouts.admin')

@section('title', 'Tambah Beasiswa')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2"><i class="fas fa-plus"></i> Tambah Beasiswa</h1>
        <p class="text-muted mb-0">
            <i class="fas fa-info-circle me-2"></i>Lengkapi form di bawah untuk menambahkan program beasiswa baru
        </p>
    </div>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-graduation-cap text-primary me-2"></i>Form Tambah Beasiswa
                        </h6>
                    </div>
                    <div class="col-auto">
                        <span class="badge bg-info-soft text-info">
                            <i class="fas fa-asterisk me-1" style="font-size: 8px;"></i>Required Fields
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.beasiswa.store') }}" method="POST" id="beasiswaForm">
                    @csrf

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
                                       value="{{ old('nama_beasiswa') }}"
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
                                      required>{{ old('deskripsi') }}</textarea>
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
                                       value="{{ old('jumlah_dana') }}"
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
                                           value="{{ old('tanggal_buka') }}"
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
                                           value="{{ old('tanggal_tutup') }}"
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

                    <!-- Form Section 3: Required Documents -->
                    <div class="form-section mb-4">
                        <h6 class="section-title mb-3">
                            <i class="fas fa-file-upload text-primary me-2"></i>Dokumen yang Diperlukan
                        </h6>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label fw-semibold mb-0">
                                    <i class="fas fa-folder text-warning me-2"></i>Atur Dokumen Pendaftaran
                                    <span class="text-danger">*</span>
                                </label>
                                <div>

                                    <button type="button" class="btn btn-sm btn-outline-primary" id="addDocumentBtn">
                                        <i class="fas fa-plus me-2"></i>Tambah Dokumen
                                    </button>
                                </div>
                            </div>

                            <div id="documentsContainer" class="documents-container">
                                <!-- Documents will be added here dynamically -->
                            </div>

                            <div id="documentsEmpty" class="text-center py-5 text-muted" style="display: none;">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i>
                                <p class="mb-2">Belum ada dokumen yang ditambahkan</p>
                                <small>Klik "Tambah Dokumen" atau "Muat Default" untuk memulai</small>
                            </div>

                            @error('documents')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror

                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>Tentukan dokumen apa saja yang perlu diupload oleh pendaftar. Minimal harus ada 1 dokumen.
                            </small>
                        </div>
                    </div>

                    <!-- Form Section 4: Status & Requirements -->
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
                                <option value="">-- Pilih Status --</option>
                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                    Aktif (Bisa dilamar)
                                </option>
                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                    Nonaktif (Tidak bisa dilamar)
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
                                      required>{{ old('persyaratan') }}</textarea>
                            @error('persyaratan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                <i class="fas fa-lightbulb me-1"></i>Tuliskan persyaratan dengan jelas, gunakan numbering untuk kemudahan membaca
                            </small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="form-actions bg-light p-4 rounded-3 mt-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-info-circle me-2"></i>
                                <small>Pastikan semua data sudah benar sebelum menyimpan</small>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.beasiswa.index') }}"
                                   class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                <button type="button" class="btn btn-outline-warning" id="resetFormBtn">
                                    <i class="fas fa-undo me-2"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Simpan Beasiswa
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
                    <i class="fas fa-lightbulb text-warning me-2"></i>Tips Membuat Beasiswa
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Nama yang Jelas</h6>
                                    <small class="text-muted">Gunakan nama yang mudah dipahami dan mencerminkan jenis beasiswa</small>
                                </div>
                            </div>
                        </div>

                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-calendar-alt text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Periode yang Wajar</h6>
                                    <small class="text-muted">Berikan waktu yang cukup untuk pendaftaran, minimal 2 minggu</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="tip-item mb-3">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-list-ul text-warning"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Persyaratan Spesifik</h6>
                                    <small class="text-muted">Tuliskan persyaratan yang detail dan dapat diverifikasi</small>
                                </div>
                            </div>
                        </div>

                        <div class="tip-item">
                            <div class="d-flex">
                                <div class="tip-icon me-3">
                                    <i class="fas fa-file-alt text-primary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Dokumen yang Relevan</h6>
                                    <small class="text-muted">Tentukan dokumen yang benar-benar diperlukan untuk penilaian</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Document Template (Hidden) -->
<template id="documentTemplate">
    <div class="document-item card mb-3 border-1">
        <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0 text-dark fw-bold">
                    Dokumen <span class="document-number">1</span>
                </h6>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary move-up-btn" title="Pindah ke atas">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary move-down-btn" title="Pindah ke bawah">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-document-btn" title="Hapus dokumen">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Nama Dokumen
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control document-name"
                           placeholder="Contoh: Transkrip Nilai"
                           required>
                    <small class="form-text text-muted">Nama yang akan ditampilkan kepada pendaftar</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Key (Unik)
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           class="form-control document-key"
                           placeholder="file_transkrip"
                           pattern="^[a-z0-9_]+$"
                           required>
                    <small class="form-text text-muted">Hanya huruf kecil, angka, dan underscore</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Icon
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select document-icon" required>
                        <option value="">-- Pilih Icon --</option>
                        <optgroup label="Documents">
                            <option value="fas fa-file-pdf">PDF Document</option>
                            <option value="fas fa-file-image">Image File</option>
                            <option value="fas fa-file-alt">Text Document</option>
                            <option value="fas fa-file-contract">Contract</option>
                            <option value="fas fa-file-signature">Signature</option>
                        </optgroup>
                        <optgroup label="Identity">
                            <option value="fas fa-id-card">ID Card</option>
                            <option value="fas fa-passport">Passport</option>
                            <option value="fas fa-address-card">Address Card</option>
                        </optgroup>
                        <optgroup label="Academic">
                            <option value="fas fa-graduation-cap">Academic</option>
                            <option value="fas fa-certificate">Certificate</option>
                            <option value="fas fa-award">Award</option>
                            <option value="fas fa-medal">Medal</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        Warna Icon
                        <span class="text-danger">*</span>
                    </label>
                    <select class="form-select document-color" required>
                        <option value="">-- Pilih Warna --</option>
                        <option value="red">Merah</option>
                        <option value="blue">Biru</option>
                        <option value="green">Hijau</option>
                        <option value="yellow">Kuning</option>
                        <option value="purple">Ungu</option>
                        <option value="orange">Orange</option>
                        <option value="teal">Teal</option>
                        <option value="gray">Abu-abu</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">
                        Format File
                        <span class="text-danger">*</span>
                    </label>
                    <div class="format-checkboxes border p-3 rounded bg-light">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input document-format" type="checkbox" value="pdf" id="pdf-">
                                    <label class="form-check-label" for="pdf-">
                                        PDF
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input document-format" type="checkbox" value="jpg" id="jpg-">
                                    <label class="form-check-label" for="jpg-">
                                        JPG
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input document-format" type="checkbox" value="jpeg" id="jpeg-">
                                    <label class="form-check-label" for="jpeg-">
                                        JPEG
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input document-format" type="checkbox" value="png" id="png-">
                                    <label class="form-check-label" for="png-">
                                        PNG
                                    </label>
                                </div>
                            </div>
                        </div>
                        <small class="form-text text-muted mt-2">Pilih minimal 1 format file yang diperbolehkan</small>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">
                        Ukuran Max (MB)
                        <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input type="number"
                               class="form-control document-max-size"
                               min="1"
                               max="10"
                               value="5"
                               required>
                        <span class="input-group-text">MB</span>
                    </div>
                    <small class="form-text text-muted">Maksimal 10MB</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>
                    <input type="text"
                           class="form-control document-description"
                           placeholder="Deskripsi singkat dokumen (opsional)">
                    <small class="form-text text-muted">Keterangan tambahan untuk membantu pendaftar</small>
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input document-required"
                               type="checkbox"
                               id="required-"
                               checked>
                        <label class="form-check-label fw-semibold" for="required-">
                            Dokumen Wajib
                        </label>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="mt-3 p-3 bg-light rounded border">
                <h6 class="text-secondary mb-2 fw-semibold">
                    Preview
                </h6>
                <div class="document-preview d-flex align-items-center">
                    <div class="preview-icon me-3">
                        <i class="fas fa-file text-secondary" style="font-size: 2rem;"></i>
                    </div>
                    <div>
                        <h6 class="preview-name mb-1 text-dark">Nama Dokumen</h6>
                        <small class="preview-details text-muted">Format: - | Max: 5MB</small>
                        <div class="preview-required">
                            <span class="badge bg-warning text-dark">
                                Wajib
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Custom CSS -->
<style>
/* Status Badge Colors */
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
    border-bottom:1px solid #dee2e6;
}

/* Input group styling */
.input-group-text {
    border: 1px solid #ced4da;
}

.input-group .form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
}

/* Document management styling */
.documents-container {
    max-height: 600px;
    overflow-y: auto;
}

.document-item {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.document-item:hover {
    border-color: #007bff;
    box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
}

.document-item .card-header {
    background: linear-gradient(45deg, #f8f9fa, #e9ecef);
    border-bottom: 1px solid #dee2e6;
}

.document-number {
    font-weight: bold;
    color: #007bff;
}

/* Format checkboxes styling */
.format-checkboxes {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.format-checkboxes .form-check {
    margin-bottom: 0.5rem;
}

.format-checkboxes .form-check-input:checked {
    background-color: #007bff;
    border-color: #007bff;
}

/* Preview section */
.document-preview {
    background: rgba(13, 202, 240, 0.1);
    border-radius: 8px;
}

.preview-icon i {
    transition: all 0.3s ease;
}

.preview-name {
    font-weight: 600;
    color: #212529;
}

.preview-details {
    font-size: 0.875rem;
}

.preview-required .badge {
    font-size: 0.75rem;
}

/* Button styling */
.btn {
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.btn-outline-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(25, 135, 84, 0.2);
}

.btn-outline-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
}

.btn-outline-secondary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(108, 117, 125, 0.2);
}

.btn-outline-danger:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
}

.btn-outline-warning:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(255, 193, 7, 0.2);
}

/* Form actions */
.form-actions {
    background: linear-gradient(45deg, #f8f9fa, #ffffff);
    border: 1px solid #e9ecef;
}

/* Tips section */
.tip-item {
    transition: all 0.3s ease;
}

.tip-item:hover {
    transform: translateX(5px);
}

.tip-icon {
    font-size: 1.25rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-actions {
        text-align: center;
    }

    .form-actions .d-flex {
        flex-direction: column;
        gap: 1rem;
    }

    .document-item .btn-group {
        flex-direction: column;
    }

    .document-item .btn-group .btn {
        border-radius: 4px !important;
        margin-bottom: 2px;
    }
}

/* Animation classes */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.document-item.new-item {
    animation: slideIn 0.5s ease-out;
}

/* Loading states */
.btn.loading {
    pointer-events: none;
    position: relative;
}

.btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 16px;
    height: 16px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Validation styling */
.is-invalid {
    border-color: #dc3545;
}

.is-valid {
    border-color: #198754;
}

.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}

/* Custom scrollbar */
.documents-container::-webkit-scrollbar {
    width: 6px;
}

.documents-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.documents-container::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.documents-container::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>

<!-- JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let documentCounter = 0;
    let documentsData = [];

    const documentsContainer = document.getElementById('documentsContainer');
    const documentsEmpty = document.getElementById('documentsEmpty');
    const addDocumentBtn = document.getElementById('addDocumentBtn');
    const resetFormBtn = document.getElementById('resetFormBtn');
    const beasiswaForm = document.getElementById('beasiswaForm');

    // Initialize
    updateDocumentsVisibility();

    // Add document button click
    addDocumentBtn.addEventListener('click', function() {
        addDocumentItem();
    });

    // Load default documents


    // Reset form
    resetFormBtn.addEventListener('click', function() {
        if (confirm('Yakin ingin reset semua data? Semua yang sudah diisi akan hilang.')) {
            beasiswaForm.reset();
            documentsData = [];
            updateDocumentsDisplay();
            updateDocumentsVisibility();
        }
    });

    // Date validation
    const tanggalBukaInput = document.getElementById('tanggal_buka');
    const tanggalTutupInput = document.getElementById('tanggal_tutup');
    const dateRangeInfo = document.getElementById('dateRangeInfo');
    const dateRangeText = document.getElementById('dateRangeText');

    function updateDateRange() {
        const tanggalBuka = tanggalBukaInput.value;
        const tanggalTutup = tanggalTutupInput.value;

        if (tanggalBuka && tanggalTutup) {
            const buka = new Date(tanggalBuka);
            const tutup = new Date(tanggalTutup);
            const diffTime = Math.abs(tutup - buka);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (tutup > buka) {
                dateRangeText.textContent = `Periode pendaftaran: ${diffDays} hari`;
                dateRangeInfo.classList.remove('d-none');
                dateRangeInfo.className = 'alert alert-info-soft';
            } else {
                dateRangeText.textContent = 'Tanggal tutup harus lebih besar dari tanggal buka';
                dateRangeInfo.classList.remove('d-none');
                dateRangeInfo.className = 'alert alert-danger';
            }
        } else {
            dateRangeInfo.classList.add('d-none');
        }
    }

    tanggalBukaInput.addEventListener('change', updateDateRange);
    tanggalTutupInput.addEventListener('change', updateDateRange);

    // Form submission
    beasiswaForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (documentsData.length === 0) {
            alert('Minimal harus ada 1 dokumen yang diperlukan.');
            return;
        }

        // Validate documents
        let hasError = false;
        let errorMessage = '';

        documentsData.forEach((doc, index) => {
            if (!doc.name.trim()) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Nama wajib diisi.\n`;
            }
            if (!doc.key.trim()) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Key wajib diisi.\n`;
            }
            if (!doc.icon) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Icon wajib dipilih.\n`;
            }
            if (!doc.color) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Warna wajib dipilih.\n`;
            }
            if (doc.formats.length === 0) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Format file wajib dipilih.\n`;
            }
        });

        // Check unique keys
        const keys = documentsData.map(doc => doc.key);
        const uniqueKeys = [...new Set(keys)];
        if (keys.length !== uniqueKeys.length) {
            hasError = true;
            errorMessage += 'Setiap dokumen harus memiliki key yang unik.\n';
        }

        if (hasError) {
            alert('Terdapat kesalahan:\n\n' + errorMessage);
            return;
        }

        // Remove any existing document inputs
        const existingInputs = beasiswaForm.querySelectorAll('input[name^="documents"]');
        existingInputs.forEach(input => input.remove());

        // Add documents data as separate inputs for each document
        documentsData.forEach((doc, index) => {
            // Create inputs for each document field
            const fields = ['name', 'key', 'icon', 'color', 'max_size', 'description', 'required'];

            fields.forEach(field => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `documents[${index}][${field}]`;

                if (field === 'required') {
                    input.value = doc[field] ? '1' : '0';
                } else {
                    input.value = doc[field] || '';
                }

                beasiswaForm.appendChild(input);
            });

            // Add formats array
            doc.formats.forEach((format, formatIndex) => {
                const formatInput = document.createElement('input');
                formatInput.type = 'hidden';
                formatInput.name = `documents[${index}][formats][${formatIndex}]`;
                formatInput.value = format;
                beasiswaForm.appendChild(formatInput);
            });
        });

        // Submit form
        const submitBtn = beasiswaForm.querySelector('button[type="submit"]');
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;

        beasiswaForm.submit();
    });

    function addDocumentItem(data = null) {
        documentCounter++;

        const template = document.getElementById('documentTemplate');
        const clone = template.content.cloneNode(true);

        // Update document number
        clone.querySelector('.document-number').textContent = documentCounter;

        // Set unique IDs for form elements
        const documentElement = clone.querySelector('.document-item');
        documentElement.setAttribute('data-index', documentsData.length);

        // Update checkbox IDs to be unique
        const formatCheckboxes = clone.querySelectorAll('.document-format');
        formatCheckboxes.forEach((checkbox, index) => {
            const format = checkbox.value;
            checkbox.id = `${format}-${documentCounter}`;
            clone.querySelector(`label[for="${format}-"]`).setAttribute('for', checkbox.id);
        });

        const requiredCheckbox = clone.querySelector('.document-required');
        requiredCheckbox.id = `required-${documentCounter}`;
        clone.querySelector(`label[for="required-"]`).setAttribute('for', requiredCheckbox.id);

        // Add event listeners
        setupDocumentEvents(clone, documentsData.length);

        // Pre-fill data if provided
        if (data) {
            fillDocumentData(clone, data);
        }

        documentsContainer.appendChild(clone);

        // Add to documents data
        const newDocData = data || {
            name: '',
            key: '',
            icon: '',
            color: '',
            formats: [],
            max_size: 5,
            description: '',
            required: true
        };

        documentsData.push(newDocData);
        updateDocumentsVisibility();

        // Add animation class
        const newItem = documentsContainer.lastElementChild;
        newItem.classList.add('new-item');
        setTimeout(() => newItem.classList.remove('new-item'), 500);

        // Scroll to new item
        newItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function setupDocumentEvents(documentElement, index) {
        const nameInput = documentElement.querySelector('.document-name');
        const keyInput = documentElement.querySelector('.document-key');
        const iconSelect = documentElement.querySelector('.document-icon');
        const colorSelect = documentElement.querySelector('.document-color');
        const formatCheckboxes = documentElement.querySelectorAll('.document-format');
        const maxSizeInput = documentElement.querySelector('.document-max-size');
        const descriptionInput = documentElement.querySelector('.document-description');
        const requiredCheckbox = documentElement.querySelector('.document-required');
        const removeBtn = documentElement.querySelector('.remove-document-btn');
        const moveUpBtn = documentElement.querySelector('.move-up-btn');
        const moveDownBtn = documentElement.querySelector('.move-down-btn');

        // Preview elements
        const previewIcon = documentElement.querySelector('.preview-icon i');
        const previewName = documentElement.querySelector('.preview-name');
        const previewDetails = documentElement.querySelector('.preview-details');
        const previewRequired = documentElement.querySelector('.preview-required');

        function updateDocumentData() {
            if (documentsData[index]) {
                documentsData[index].name = nameInput.value;
                documentsData[index].key = keyInput.value;
                documentsData[index].icon = iconSelect.value;
                documentsData[index].color = colorSelect.value;
                documentsData[index].formats = Array.from(formatCheckboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);
                documentsData[index].max_size = parseInt(maxSizeInput.value) || 5;
                documentsData[index].description = descriptionInput.value;
                documentsData[index].required = requiredCheckbox.checked;

                updatePreview();
            }
        }

        function updatePreview() {
            const data = documentsData[index];
            if (!data) return;

            // Update icon
            previewIcon.className = data.icon || 'fas fa-file text-secondary';
            previewIcon.classList.add(`text-${data.color || 'secondary'}`);

            // Update name
            previewName.textContent = data.name || 'Nama Dokumen';

            // Update details
            const formats = data.formats.length > 0
                ? data.formats.map(f => f.toUpperCase()).join(', ')
                : '-';
            previewDetails.textContent = `Format: ${formats} | Max: ${data.max_size}MB`;

            // Update required badge
            if (data.required) {
                previewRequired.innerHTML = '<span class="badge bg-warning text-dark"><i class="fas fa-star me-1"></i>Wajib</span>';
            } else {
                previewRequired.innerHTML = '<span class="badge bg-secondary"><i class="fas fa-minus me-1"></i>Opsional</span>';
            }
        }

        function generateKeyFromName() {
            if (!keyInput.value && nameInput.value) {
                const key = nameInput.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s]/g, '')
                    .replace(/\s+/g, '_')
                    .substring(0, 50);
                keyInput.value = key;
                updateDocumentData();
            }
        }

        // Event listeners
        nameInput.addEventListener('input', () => {
            updateDocumentData();
            generateKeyFromName();
        });

        keyInput.addEventListener('input', updateDocumentData);
        iconSelect.addEventListener('change', updateDocumentData);
        colorSelect.addEventListener('change', updateDocumentData);
        maxSizeInput.addEventListener('input', updateDocumentData);
        descriptionInput.addEventListener('input', updateDocumentData);
        requiredCheckbox.addEventListener('change', updateDocumentData);

        formatCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDocumentData);
        });

        // Remove document
        removeBtn.addEventListener('click', function() {
            if (confirm('Yakin ingin hapus dokumen ini?')) {
                removeDocumentItem(index);
            }
        });

        // Move up
        moveUpBtn.addEventListener('click', function() {
            moveDocument(index, index - 1);
        });

        // Move down
        moveDownBtn.addEventListener('click', function() {
            moveDocument(index, index + 1);
        });

        // Initial preview update
        updatePreview();
    }

    function fillDocumentData(documentElement, data) {
        documentElement.querySelector('.document-name').value = data.name || '';
        documentElement.querySelector('.document-key').value = data.key || '';
        documentElement.querySelector('.document-icon').value = data.icon || '';
        documentElement.querySelector('.document-color').value = data.color || '';
        documentElement.querySelector('.document-max-size').value = data.max_size || 5;
        documentElement.querySelector('.document-description').value = data.description || '';
        documentElement.querySelector('.document-required').checked = data.required !== false;

        if (data.formats && Array.isArray(data.formats)) {
            const formatCheckboxes = documentElement.querySelectorAll('.document-format');
            formatCheckboxes.forEach(checkbox => {
                checkbox.checked = data.formats.includes(checkbox.value);
            });
        }
    }

    function removeDocumentItem(index) {
        documentsData.splice(index, 1);
        updateDocumentsDisplay();
        updateDocumentsVisibility();
    }

    function moveDocument(fromIndex, toIndex) {
        if (toIndex < 0 || toIndex >= documentsData.length) return;

        const item = documentsData.splice(fromIndex, 1)[0];
        documentsData.splice(toIndex, 0, item);
        updateDocumentsDisplay();
    }

    function updateDocumentsDisplay() {
        documentsContainer.innerHTML = '';
        documentCounter = 0;

        documentsData.forEach((data, index) => {
            addDocumentItem(data);
        });
    }

    function updateDocumentsVisibility() {
        if (documentsData.length === 0) {
            documentsEmpty.style.display = 'block';
        } else {
            documentsEmpty.style.display = 'none';
        }
    }

    function loadDefaultDocuments() {
        documentsData = [];

        const defaultDocs = [
            {
                name: 'Transkrip Nilai',
                key: 'file_transkrip',
                icon: 'fas fa-file-pdf',
                color: 'red',
                formats: ['pdf'],
                max_size: 5,
                description: 'Transkrip nilai terbaru',
                required: true
            },
            {
                name: 'KTP',
                key: 'file_ktp',
                icon: 'fas fa-id-card',
                color: 'blue',
                formats: ['pdf', 'jpg', 'jpeg', 'png'],
                max_size: 5,
                description: 'Kartu Tanda Penduduk',
                required: true
            },
            {
                name: 'Kartu Keluarga',
                key: 'file_kk',
                icon: 'fas fa-users',
                color: 'green',
                formats: ['pdf', 'jpg', 'jpeg', 'png'],
                max_size: 5,
                description: 'Kartu Keluarga',
                required: true
            }
        ];

        defaultDocs.forEach(doc => {
            documentsData.push(doc);
        });

        updateDocumentsDisplay();
        updateDocumentsVisibility();
    }
});
</script>
@endsection
