@extends('layouts.admin')

@section('title', 'Edit Beasiswa')

@section('content')
<div class="flex justify-between flex-wrap md:flex-nowrap items-center pt-3 pb-2 mb-3 border-b">
    <div>
        <h1 class="text-2xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit Beasiswa
        </h1>
        <p class="text-gray-600 mb-0 flex items-center mt-1">
            <i class="fas fa-info-circle mr-2"></i>Perbarui informasi beasiswa yang sudah ada
        </p>
    </div>
</div>

<div class="max-w-6xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg">
        <div class="bg-white py-3 px-4 border-b">
            <div class="flex items-center justify-between">
                <div>
                    <h6 class="text-base font-semibold mb-0 flex items-center">
                        <i class="fas fa-graduation-cap text-yellow-500 mr-2"></i>Form Edit Beasiswa
                    </h6>
                </div>
                <div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-edit mr-1" style="font-size: 8px;"></i>Edit Mode
                    </span>
                </div>
            </div>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.beasiswa.update', $beasiswa) }}" method="POST" id="beasiswaForm">
                @csrf
                @method('PUT')

                <!-- Form Section 1: Basic Information -->
                <div class="form-section mb-6">
                    <h6 class="section-title mb-4 text-gray-700 font-semibold flex items-center pb-2 border-b border-gray-200">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>Informasi Dasar
                    </h6>

                    <div class="mb-4">
                        <label for="nama_beasiswa" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-trophy text-yellow-500 mr-2"></i>Nama Beasiswa
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-graduation-cap text-gray-400"></i>
                            </div>
                            <input type="text"
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('nama_beasiswa') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   id="nama_beasiswa"
                                   name="nama_beasiswa"
                                   value="{{ old('nama_beasiswa', $beasiswa->nama_beasiswa) }}"
                                   placeholder="Contoh: Beasiswa Prestasi Akademik 2025"
                                   required>
                        </div>
                        @error('nama_beasiswa')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-align-left text-blue-500 mr-2"></i>Deskripsi Beasiswa
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('deskripsi') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                  id="deskripsi"
                                  name="deskripsi"
                                  rows="4"
                                  placeholder="Jelaskan tujuan, target penerima, dan manfaat beasiswa ini..."
                                  required>{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                            <i class="fas fa-lightbulb mr-1"></i>Berikan deskripsi yang jelas dan menarik untuk calon pendaftar
                        </p>
                    </div>
                </div>

                <!-- Form Section 2: Financial & Schedule -->
                <div class="form-section mb-6">
                    <h6 class="section-title mb-4 text-gray-700 font-semibold flex items-center pb-2 border-b border-gray-200">
                        <i class="fas fa-calendar-dollar text-green-500 mr-2"></i>Dana & Jadwal
                    </h6>

                    <div class="mb-4">
                        <label for="jumlah_dana" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-money-bill-wave text-green-500 mr-2"></i>Jumlah Dana
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number"
                                   class="block w-full pl-12 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('jumlah_dana') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                   id="jumlah_dana"
                                   name="jumlah_dana"
                                   value="{{ old('jumlah_dana', $beasiswa->jumlah_dana) }}"
                                   min="0"
                                   step="100000"
                                   placeholder="5000000"
                                   required>
                        </div>
                        @error('jumlah_dana')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>Masukkan jumlah dana dalam Rupiah (contoh: 5000000 untuk 5 juta)
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="tanggal_buka" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-plus text-green-500 mr-2"></i>Tanggal Buka
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="date"
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('tanggal_buka') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                       id="tanggal_buka"
                                       name="tanggal_buka"
                                       value="{{ old('tanggal_buka', \Carbon\Carbon::parse($beasiswa->tanggal_buka)->format('Y-m-d')) }}"
                                       required>
                            </div>
                            @error('tanggal_buka')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tanggal_tutup" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-times text-red-500 mr-2"></i>Tanggal Tutup
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar text-gray-400"></i>
                                </div>
                                <input type="date"
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('tanggal_tutup') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                       id="tanggal_tutup"
                                       name="tanggal_tutup"
                                       value="{{ old('tanggal_tutup', \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('Y-m-d')) }}"
                                       required>
                            </div>
                            @error('tanggal_tutup')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div id="dateRangeInfo" class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-md hidden">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span id="dateRangeText"></span>
                    </div>
                </div>

                <!-- Form Section 3: Required Documents -->
                <div class="form-section mb-6">
                    <h6 class="section-title mb-4 text-gray-700 font-semibold flex items-center pb-2 border-b border-gray-200">
                        <i class="fas fa-file-upload text-blue-500 mr-2"></i>Dokumen yang Diperlukan
                    </h6>

                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-0">
                                <i class="fas fa-folder text-yellow-500 mr-2"></i>Atur Dokumen Pendaftaran
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="flex space-x-2">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-blue-300 shadow-sm text-sm leading-4 font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="addDocumentBtn">
                                    <i class="fas fa-plus mr-2"></i>Tambah Dokumen
                                </button>
                            </div>
                        </div>

                        <div id="documentsContainer" class="space-y-4 max-h-96 overflow-y-auto">
                            <!-- Documents will be added here dynamically -->
                        </div>

                        <div id="documentsEmpty" class="text-center py-8 text-gray-500 hidden">
                            <i class="fas fa-folder-open text-4xl mb-3 opacity-50"></i>
                            <p class="mb-2">Belum ada dokumen yang ditambahkan</p>
                            <small>Klik "Tambah Dokumen" atau "Muat Default" untuk memulai</small>
                        </div>

                        @error('documents')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                            <i class="fas fa-lightbulb mr-1"></i>Tentukan dokumen apa saja yang perlu diupload oleh pendaftar. Minimal harus ada 1 dokumen.
                        </p>
                    </div>
                </div>

                <!-- Form Section 4: Status & Requirements -->
                <div class="form-section mb-6">
                    <h6 class="section-title mb-4 text-gray-700 font-semibold flex items-center pb-2 border-b border-gray-200">
                        <i class="fas fa-cogs text-yellow-500 mr-2"></i>Status & Persyaratan
                    </h6>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-toggle-on text-blue-500 mr-2"></i>Status Beasiswa
                            <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                id="status"
                                name="status"
                                required>
                            <option value="aktif" {{ old('status', $beasiswa->status) == 'aktif' ? 'selected' : '' }}>
                                Aktif (Bisa dilamar)
                            </option>
                            <option value="nonaktif" {{ old('status', $beasiswa->status) == 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif (Tidak bisa dilamar)
                            </option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="persyaratan" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list-check text-blue-500 mr-2"></i>Persyaratan Pendaftaran
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-teal-500 focus:border-teal-500 @error('persyaratan') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @enderror"
                                  id="persyaratan"
                                  name="persyaratan"
                                  rows="8"
                                  placeholder="Contoh:&#10;1. Mahasiswa aktif semester 3 ke atas&#10;2. IPK minimal 3.0&#10;3. Tidak sedang menerima beasiswa lain&#10;4. Melampirkan transkrip nilai terbaru&#10;5. Surat rekomendasi dari dosen"
                                  required>{{ old('persyaratan', $beasiswa->persyaratan) }}</textarea>
                        @error('persyaratan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500 flex items-center">
                            <i class="fas fa-lightbulb mr-1"></i>Tuliskan persyaratan dengan jelas, gunakan numbering untuk kemudahan membaca
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="bg-gray-50 p-4 rounded-lg mt-6">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-info-circle mr-2"></i>
                            <small>Pastikan semua perubahan sudah benar sebelum menyimpan</small>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.beasiswa.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="reset" class="inline-flex items-center px-4 py-2 border border-yellow-300 shadow-sm text-sm font-medium rounded-md text-yellow-700 bg-white hover:bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <i class="fas fa-undo mr-2"></i>Reset
                            </button>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                <i class="fas fa-save mr-2"></i>Update Beasiswa
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tips Card -->
    <div class="bg-white shadow-sm rounded-lg mt-6">
        <div class="bg-white py-3 px-4 border-b">
            <h6 class="text-base font-semibold mb-0 flex items-center">
                <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Tips Edit Beasiswa
            </h6>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="tip-item flex items-start p-3 rounded-lg hover:bg-gray-50 transition-all duration-300">
                        <div class="tip-icon mr-3 mt-1">
                            <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                        </div>
                        <div>
                            <h6 class="font-medium mb-1">Hati-hati Mengubah Tanggal</h6>
                            <small class="text-gray-600">Perubahan tanggal dapat mempengaruhi pendaftar yang sudah ada</small>
                        </div>
                    </div>

                    <div class="tip-item flex items-start p-3 rounded-lg hover:bg-gray-50 transition-all duration-300">
                        <div class="tip-icon mr-3 mt-1">
                            <i class="fas fa-eye text-blue-500"></i>
                        </div>
                        <div>
                            <h6 class="font-medium mb-1">Preview Perubahan</h6>
                            <small class="text-gray-600">Pastikan semua informasi sudah sesuai sebelum menyimpan</small>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="tip-item flex items-start p-3 rounded-lg hover:bg-gray-50 transition-all duration-300">
                        <div class="tip-icon mr-3 mt-1">
                            <i class="fas fa-users text-blue-500"></i>
                        </div>
                        <div>
                            <h6 class="font-medium mb-1">Dampak ke Pendaftar</h6>
                            <small class="text-gray-600">Pertimbangkan dampak perubahan terhadap calon pendaftar</small>
                        </div>
                    </div>

                    <div class="tip-item flex items-start p-3 rounded-lg hover:bg-gray-50 transition-all duration-300">
                        <div class="tip-icon mr-3 mt-1">
                            <i class="fas fa-bell text-green-500"></i>
                        </div>
                        <div>
                            <h6 class="font-medium mb-1">Notifikasi</h6>
                            <small class="text-gray-600">Sistem akan memberitahu perubahan penting kepada pendaftar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Document Template (Hidden) -->
<template id="documentTemplate">
    <div class="document-item bg-white border-2 border-gray-200 rounded-lg hover:border-blue-400 hover:shadow-md transition-all duration-300">
        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 rounded-t-lg">
            <div class="flex justify-between items-center">
                <h6 class="text-base font-semibold text-gray-800 mb-0">
                    Dokumen <span class="document-number text-blue-600">1</span>
                </h6>
                <div class="flex space-x-1">
                    <button type="button" class="inline-flex items-center p-1 border border-gray-300 rounded text-gray-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 move-up-btn" title="Pindah ke atas">
                        <i class="fas fa-arrow-up text-xs"></i>
                    </button>
                    <button type="button" class="inline-flex items-center p-1 border border-gray-300 rounded text-gray-600 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 move-down-btn" title="Pindah ke bawah">
                        <i class="fas fa-arrow-down text-xs"></i>
                    </button>
                    <button type="button" class="inline-flex items-center p-1 border border-red-300 rounded text-red-600 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 remove-document-btn" title="Hapus dokumen">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Dokumen
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="document-name block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                           placeholder="Contoh: Transkrip Nilai"
                           required>
                    <p class="mt-1 text-sm text-gray-500">Nama yang akan ditampilkan kepada pendaftar</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Key (Unik)
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="document-key block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                           placeholder="file_transkrip"
                           pattern="^[a-z0-9_]+$"
                           required>
                    <p class="mt-1 text-sm text-gray-500">Hanya huruf kecil, angka, dan underscore</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Icon
                        <span class="text-red-500">*</span>
                    </label>
                    <select class="document-icon block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500" required>
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
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Warna Icon
                        <span class="text-red-500">*</span>
                    </label>
                    <select class="document-color block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500" required>
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

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Format File
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="format-checkboxes border border-gray-300 p-3 rounded-md bg-gray-50">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded document-format" type="checkbox" value="pdf" id="pdf-">
                                <label class="ml-2 block text-sm text-gray-900" for="pdf-">
                                    PDF
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded document-format" type="checkbox" value="jpg" id="jpg-">
                                <label class="ml-2 block text-sm text-gray-900" for="jpg-">
                                    JPG
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded document-format" type="checkbox" value="jpeg" id="jpeg-">
                                <label class="ml-2 block text-sm text-gray-900" for="jpeg-">
                                    JPEG
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded document-format" type="checkbox" value="png" id="png-">
                                <label class="ml-2 block text-sm text-gray-900" for="png-">
                                    PNG
                                </label>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Pilih minimal 1 format file yang diperbolehkan</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ukuran Max (MB)
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="number"
                               class="document-max-size block w-full px-3 py-2 pr-12 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                               min="1"
                               max="10"
                               value="5"
                               required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">MB</span>
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Maksimal 10MB</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <input type="text"
                           class="document-description block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"
                           placeholder="Deskripsi singkat dokumen (opsional)">
                    <p class="mt-1 text-sm text-gray-500">Keterangan tambahan untuk membantu pendaftar</p>
                </div>
                <div class="flex items-end">
                    <div class="flex items-center">
                        <input class="document-required h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded"
                               type="checkbox"
                               id="required-"
                               checked>
                        <label class="ml-2 block text-sm font-medium text-gray-900" for="required-">
                            Dokumen Wajib
                        </label>
                    </div>
                </div>
            </div>

            <!-- Preview Section -->
            <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h6 class="text-sm font-semibold text-gray-700 mb-3">
                    Preview
                </h6>
                <div class="document-preview flex items-center">
                    <div class="preview-icon mr-4">
                        <i class="fas fa-file text-gray-400 text-2xl"></i>
                    </div>
                    <div>
                        <h6 class="preview-name text-base font-medium text-gray-800 mb-1">Nama Dokumen</h6>
                        <p class="preview-details text-sm text-gray-600 mb-2">Format: - | Max: 5MB</p>
                        <div class="preview-required">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Wajib
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let documentCounter = 0;
    let documentsData = [];

    const documentsContainer = document.getElementById('documentsContainer');
    const documentsEmpty = document.getElementById('documentsEmpty');
    const addDocumentBtn = document.getElementById('addDocumentBtn');
    const beasiswaForm = document.getElementById('beasiswaForm');

    // Initialize with existing documents if any
    // PERBAIKAN: Pastikan data dokumen diambil dengan benar dari server
    const existingDocuments = @json($beasiswa->required_documents ?? []);
    console.log('Raw existing documents from server:', existingDocuments);

    // PERBAIKAN: Cek apakah data dokumen dalam format yang benar
    let processedDocuments = [];

    if (existingDocuments) {
        // Jika data dalam format string JSON, parse dulu
        if (typeof existingDocuments === 'string') {
            try {
                processedDocuments = JSON.parse(existingDocuments);
            } catch (e) {
                console.error('Error parsing documents JSON:', e);
                processedDocuments = [];
            }
        } else if (Array.isArray(existingDocuments)) {
            processedDocuments = existingDocuments;
        } else if (typeof existingDocuments === 'object') {
            // Jika berupa object, convert ke array
            processedDocuments = Object.values(existingDocuments);
        }
    }

    console.log('Processed documents:', processedDocuments);

    // Load existing documents on page load
    if (processedDocuments && processedDocuments.length > 0) {
        processedDocuments.forEach((doc, index) => {
            console.log(`Loading document ${index + 1}:`, doc);

            // PERBAIKAN: Pastikan semua field ada dengan nilai default
            const documentData = {
                name: doc.name || doc.nama || '',
                key: doc.key || doc.kunci || '',
                icon: doc.icon || 'fas fa-file',
                color: doc.color || doc.warna || 'blue',
                formats: (() => {
                    // Handle berbagai format data formats
                    if (Array.isArray(doc.formats)) return doc.formats;
                    if (Array.isArray(doc.format)) return doc.format;
                    if (typeof doc.formats === 'string') {
                        try {
                            return JSON.parse(doc.formats);
                        } catch {
                            return doc.formats.split(',').map(f => f.trim());
                        }
                    }
                    if (typeof doc.format === 'string') {
                        try {
                            return JSON.parse(doc.format);
                        } catch {
                            return doc.format.split(',').map(f => f.trim());
                        }
                    }
                    return ['pdf']; // default
                })(),
                max_size: parseInt(doc.max_size || doc.ukuran_max || doc.maxSize || 5),
                description: doc.description || doc.deskripsi || '',
                required: doc.required !== false && doc.required !== '0' && doc.required !== 0
            };

            console.log(`Processed document ${index + 1}:`, documentData);
            documentsData.push(documentData);
        });

        console.log('Final documentsData:', documentsData);

        // PERBAIKAN: Render dokumen setelah semua data diproses
        setTimeout(() => {
            renderAllDocuments();
            updateDocumentsVisibility();
        }, 100);
    } else {
        console.log('No existing documents found');
        updateDocumentsVisibility();
    }

    // Add document button click
    addDocumentBtn.addEventListener('click', function() {
        addDocumentItem();
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
                dateRangeText.textContent = `Periode pendaftaran: ${diffDays} hari (${buka.toLocaleDateString('id-ID')} - ${tutup.toLocaleDateString('id-ID')})`;
                dateRangeInfo.classList.remove('hidden');

                if (diffDays < 7) {
                    dateRangeInfo.className = 'bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md';
                    dateRangeText.innerHTML = '<i class="fas fa-exclamation-triangle mr-2"></i>' + dateRangeText.textContent + ' - Periode terlalu singkat!';
                } else {
                    dateRangeInfo.className = 'bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-md';
                    dateRangeText.innerHTML = '<i class="fas fa-info-circle mr-2"></i>' + dateRangeText.textContent;
                }
            } else {
                dateRangeInfo.className = 'bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md';
                dateRangeInfo.classList.remove('hidden');
                dateRangeText.innerHTML = '<i class="fas fa-times-circle mr-2"></i>Tanggal tutup harus setelah tanggal buka!';
            }
        } else {
            dateRangeInfo.classList.add('hidden');
        }
    }

    // Initial calculation on page load
    updateDateRange();

    tanggalBukaInput.addEventListener('change', updateDateRange);
    tanggalTutupInput.addEventListener('change', updateDateRange);

    // Form submission
    beasiswaForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const startDate = new Date(tanggalBukaInput.value);
        const endDate = new Date(tanggalTutupInput.value);

        if (endDate <= startDate) {
            alert('Tanggal tutup harus setelah tanggal buka!');
            return false;
        }

        if (documentsData.length === 0) {
            alert('Minimal harus ada 1 dokumen yang diperlukan.');
            return;
        }

        // Validate documents
        let hasError = false;
        let errorMessage = '';

        documentsData.forEach((doc, index) => {
            if (!doc.name || !doc.name.trim()) {
                hasError = true;
                errorMessage += `Dokumen ${index + 1}: Nama wajib diisi.\n`;
            }
            if (!doc.key || !doc.key.trim()) {
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
            if (!doc.formats || doc.formats.length === 0) {
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
            if (doc.formats && Array.isArray(doc.formats)) {
                doc.formats.forEach((format, formatIndex) => {
                    const formatInput = document.createElement('input');
                    formatInput.type = 'hidden';
                    formatInput.name = `documents[${index}][formats][${formatIndex}]`;
                    formatInput.value = format;
                    beasiswaForm.appendChild(formatInput);
                });
            }
        });

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner animate-spin mr-2"></i>Menyimpan...';
        submitBtn.disabled = true;

        // Re-enable after 3 seconds (in case of validation errors)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 3000);

        beasiswaForm.submit();
    });

    function renderAllDocuments() {
        console.log('Rendering all documents. Count:', documentsData.length);
        documentsContainer.innerHTML = '';
        documentCounter = 0;

        documentsData.forEach((data, index) => {
            console.log(`Rendering document ${index + 1}:`, data);
            createDocumentElement(data, index);
        });
    }

    function createDocumentElement(data, index) {
        documentCounter++;

        const template = document.getElementById('documentTemplate');
        if (!template) {
            console.error('Document template not found!');
            return;
        }

        const clone = template.content.cloneNode(true);

        // Update document number
        clone.querySelector('.document-number').textContent = documentCounter;

        // Set unique IDs for form elements
        const documentElement = clone.querySelector('.document-item');
        documentElement.setAttribute('data-index', index);

        // Update checkbox IDs to be unique
        const formatCheckboxes = clone.querySelectorAll('.document-format');
        formatCheckboxes.forEach((checkbox, checkboxIndex) => {
            const format = checkbox.value;
            const newId = `${format}-${documentCounter}`;
            checkbox.id = newId;
            const label = clone.querySelector(`label[for="${format}-"]`);
            if (label) {
                label.setAttribute('for', newId);
            }
        });

        const requiredCheckbox = clone.querySelector('.document-required');
        const requiredId = `required-${documentCounter}`;
        requiredCheckbox.id = requiredId;
        const requiredLabel = clone.querySelector(`label[for="required-"]`);
        if (requiredLabel) {
            requiredLabel.setAttribute('for', requiredId);
        }

        // PERBAIKAN: Fill dengan data yang ada SEBELUM menambahkan event listener
        fillDocumentData(clone, data);

        // Add event listeners
        setupDocumentEvents(clone, index);

        documentsContainer.appendChild(clone);
        console.log(`Document ${index + 1} rendered successfully`);
    }

    function addDocumentItem(data = null) {
        // Add to documents data first
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

        // Create the element
        createDocumentElement(newDocData, documentsData.length - 1);

        updateDocumentsVisibility();

        // Scroll to new item
        const newItem = documentsContainer.lastElementChild;
        if (newItem) {
            newItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
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
            const colorClasses = {
                'red': 'text-red-500',
                'blue': 'text-blue-500',
                'green': 'text-green-500',
                'yellow': 'text-yellow-500',
                'purple': 'text-purple-500',
                'orange': 'text-orange-500',
                'teal': 'text-teal-500',
                'gray': 'text-gray-500'
            };

            previewIcon.className = data.icon || 'fas fa-file';
            previewIcon.classList.add(colorClasses[data.color] || 'text-gray-400');
            previewIcon.classList.add('text-2xl');

            // Update name
            previewName.textContent = data.name || 'Nama Dokumen';

            // Update details
            const formats = data.formats && data.formats.length > 0
                ? data.formats.map(f => f.toUpperCase()).join(', ')
                : '-';
            previewDetails.textContent = `Format: ${formats} | Max: ${data.max_size}MB`;

            // Update required badge
            if (data.required) {
                previewRequired.innerHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-star mr-1"></i>Wajib</span>';
            } else {
                previewRequired.innerHTML = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="fas fa-minus mr-1"></i>Opsional</span>';
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

        // PERBAIKAN: Update preview setelah setup selesai
        setTimeout(() => {
            updatePreview();
        }, 10);
    }

    function fillDocumentData(documentElement, data) {
        console.log('Filling document data:', data);

        // PERBAIKAN: Set nilai dengan pengecekan yang lebih robust
        const nameInput = documentElement.querySelector('.document-name');
        const keyInput = documentElement.querySelector('.document-key');
        const iconSelect = documentElement.querySelector('.document-icon');
        const colorSelect = documentElement.querySelector('.document-color');
        const maxSizeInput = documentElement.querySelector('.document-max-size');
        const descriptionInput = documentElement.querySelector('.document-description');
        const requiredCheckbox = documentElement.querySelector('.document-required');

        if (nameInput) nameInput.value = data.name || '';
        if (keyInput) keyInput.value = data.key || '';
        if (iconSelect) iconSelect.value = data.icon || '';
        if (colorSelect) colorSelect.value = data.color || '';
        if (maxSizeInput) maxSizeInput.value = data.max_size || 5;
        if (descriptionInput) descriptionInput.value = data.description || '';
        if (requiredCheckbox) requiredCheckbox.checked = data.required !== false;

        // Set formats
        if (data.formats && Array.isArray(data.formats)) {
            const formatCheckboxes = documentElement.querySelectorAll('.document-format');
            formatCheckboxes.forEach(checkbox => {
                checkbox.checked = data.formats.includes(checkbox.value);
            });
        }

        console.log('Document data filled successfully');
    }

    function removeDocumentItem(index) {
        documentsData.splice(index, 1);
        renderAllDocuments();
        updateDocumentsVisibility();
    }

    function moveDocument(fromIndex, toIndex) {
        if (toIndex < 0 || toIndex >= documentsData.length) return;

        const item = documentsData.splice(fromIndex, 1)[0];
        documentsData.splice(toIndex, 0, item);
        renderAllDocuments();
    }

    function updateDocumentsVisibility() {
        if (documentsData.length === 0) {
            documentsEmpty.classList.remove('hidden');
        } else {
            documentsEmpty.classList.add('hidden');
        }
    }

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
        if (field.name && !field.name.startsWith('documents')) {
            originalValues[field.name] = field.value;

            field.addEventListener('change', function() {
                if (this.value !== originalValues[this.name]) {
                    this.classList.add('border-l-4', 'border-yellow-400', 'bg-yellow-50');
                } else {
                    this.classList.remove('border-l-4', 'border-yellow-400', 'bg-yellow-50');
                }
            });
        }
    });
});
</script>

<style>
/* Form sections */
.form-section {
    border-left: 4px solid #14b8a6;
    padding-left: 1rem;
    margin-left: 0.5rem;
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

/* Animation for new items */
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .form-section {
        border-left: none;
        border-top: 3px solid #14b8a6;
        padding-left: 0;
        padding-top: 1rem;
        margin-left: 0;
    }
}
</style>
@endsection
