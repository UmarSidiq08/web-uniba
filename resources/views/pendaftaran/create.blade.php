@extends('layouts.app')

@section('title', 'Daftar Beasiswa - ' . $beasiswa->nama_beasiswa)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-orange-600 mb-2">
                    <i class="fas fa-graduation-cap mr-2"></i>Pendaftaran Beasiswa
                </h2>
                <p class="text-amber-700 text-lg">Lengkapi formulir di bawah untuk mendaftar beasiswa</p>
            </div>

            <!-- Main Registration Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border-0">
                <div class="bg-gradient-to-r from-orange-500 to-amber-600 py-6 px-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="mb-4 md:mb-0">
                            <h4 class="text-xl font-semibold text-white mb-1">
                                <i class="fas fa-trophy text-yellow-300 mr-2"></i>{{ $beasiswa->nama_beasiswa }}
                            </h4>
                            <small class="text-white opacity-90">
                                <i class="fas fa-calendar-alt mr-1"></i>Batas pendaftaran:
                                {{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}
                            </small>
                        </div>
                        <div class="scholarship-amount">
                            <span
                                class="bg-gradient-to-r from-yellow-500 to-orange-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                <i class="fas fa-money-bill-wave mr-1"></i>Rp
                                {{ number_format($beasiswa->jumlah_dana, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-10">
                    <!-- Scholarship Info Section -->
                    <div class="bg-gradient-to-r from-amber-50 to-orange-100 rounded-xl p-6 mb-8 border-l-4 border-orange-500">
                        <h5 class="text-lg font-semibold text-amber-800 mb-4 border-b-2 border-orange-500 pb-2 inline-block">
                            <i class="fas fa-info-circle text-orange-400 mr-2"></i>Informasi Beasiswa
                        </h5>
                        <div class="bg-white rounded-lg p-6 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-amber-700 mb-1">Dana Beasiswa</label>
                                    <p class="text-yellow-600 font-bold text-lg">
                                        Rp {{ number_format($beasiswa->jumlah_dana, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-amber-700 mb-1">Batas Waktu
                                        Pendaftaran</label>
                                    <p class="text-orange-600 font-bold text-lg">
                                        {{ \Carbon\Carbon::parse($beasiswa->tanggal_tutup)->format('d M Y') }}
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-amber-700 mb-2">Persyaratan</label>
                                <div
                                    class="bg-amber-50 border border-orange-200 rounded-lg p-4 text-amber-800 text-sm md:text-base whitespace-pre-line">
                                    {{ $beasiswa->persyaratan }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Form -->
                    <div class="form-section">
                        <h5 class="text-lg font-semibold text-amber-800 mb-6 border-b-2 border-orange-500 pb-2 inline-block">
                            <i class="fas fa-edit text-orange-500 mr-2"></i>Formulir Pendaftaran
                        </h5>

                        <form method="POST" action="{{ route('pendaftar.store', $beasiswa) }}"
                            enctype="multipart/form-data" id="registrationForm">
                            @csrf

                            <!-- Personal Information -->
                            <div class="bg-amber-50 rounded-xl p-6 mb-6 border-l-4 border-orange-500">
                                <h6 class="text-md font-semibold text-amber-800 mb-4">
                                    <i class="fas fa-user-circle text-orange-400 mr-2"></i>Data Personal
                                </h6>
                                <div class="bg-white rounded-lg p-6 shadow-sm">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="nama_lengkap" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-user mr-1 text-orange-500"></i>Nama Lengkap *
                                            </label>
                                            <input type="text"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('nama_lengkap') border-red-500 @enderror"
                                                id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                                placeholder="Masukkan nama lengkap" required>
                                            @error('nama_lengkap')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="nim" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-id-badge mr-1 text-orange-500"></i>NIM *
                                            </label>
                                            <input type="number"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('nim') border-red-500 @enderror"
                                                id="nim" name="nim" value="{{ old('nim') }}"
                                                placeholder="Masukkan NIM" required>
                                            @error('nim')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-envelope mr-1 text-orange-500"></i>Email *
                                            </label>
                                            <input type="email"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                                id="email" name="email"
                                                value="{{ old('email', Auth::user()->email ?? '') }}"
                                                placeholder="contoh@email.com" required>
                                            @error('email')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="no_hp" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-phone mr-1 text-orange-500"></i>No. HP *
                                            </label>
                                            <input type="text"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('no_hp') border-red-500 @enderror"
                                                id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                                placeholder="08xxxxxxxxxx" required>
                                            @error('no_hp')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Academic Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="fakultas" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-university mr-1 text-orange-500"></i>Fakultas *
                                            </label>
                                            <input type="text"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('fakultas') border-red-500 @enderror"
                                                id="fakultas" name="fakultas" value="{{ old('fakultas') }}"
                                                placeholder="Contoh: Teknik" required>
                                            @error('fakultas')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="jurusan" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-graduation-cap mr-1 text-orange-500"></i>Jurusan *
                                            </label>
                                            <input type="text"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('jurusan') border-red-500 @enderror"
                                                id="jurusan" name="jurusan" value="{{ old('jurusan') }}"
                                                placeholder="Contoh: Teknik Informatika" required>
                                            @error('jurusan')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="semester" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-calendar-check mr-1 text-orange-500"></i>Semester *
                                            </label>
                                            <select
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('semester') border-red-500 @enderror"
                                                id="semester" name="semester" required>
                                                <option value="">-- Pilih Semester --</option>
                                                @for ($i = 1; $i <= 14; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ old('semester') == $i ? 'selected' : '' }}>Semester
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                            @error('semester')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="ipk" class="block text-sm font-medium text-amber-800 mb-1">
                                                <i class="fas fa-chart-line mr-1 text-orange-500"></i>IPK *
                                            </label>
                                            <input type="number"
                                                class="w-full px-4 py-3 border-2 border-orange-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('ipk') border-red-500 @enderror"
                                                id="ipk" name="ipk" value="{{ old('ipk') }}"
                                                min="0" max="4" step="0.01" placeholder="3.50"
                                                required>
                                            @error('ipk')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reason Section -->
                            <div class="bg-yellow-50 rounded-xl p-6 mb-6 border-l-4 border-yellow-500">
                                <h6 class="text-md font-semibold text-yellow-800 mb-4">
                                    <i class="fas fa-comment-alt text-yellow-600 mr-2"></i>Motivasi
                                </h6>
                                <div class="bg-white rounded-lg p-6 shadow-sm">
                                    <div>
                                        <label for="alasan_mendaftar"
                                            class="block text-sm font-medium text-yellow-800 mb-2">
                                            <i class="fas fa-quote-left mr-1 text-yellow-600"></i>Alasan Mendaftar *
                                        </label>
                                        <textarea
                                            class="w-full px-4 py-3 border-2 border-yellow-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('alasan_mendaftar') border-red-500 @enderror"
                                            id="alasan_mendaftar" name="alasan_mendaftar" rows="5"
                                            placeholder="Jelaskan alasan dan motivasi Anda mendaftar beasiswa ini..." required>{{ old('alasan_mendaftar') }}</textarea>
                                        <div class="text-sm text-yellow-700 mt-2">
                                            <i class="fas fa-lightbulb text-yellow-600 mr-1"></i>
                                            Jelaskan secara detail mengapa Anda layak mendapatkan beasiswa ini
                                        </div>
                                        @error('alasan_mendaftar')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Dynamic Document Upload Section -->
                            @if ($beasiswa->required_documents && count($beasiswa->required_documents) > 0)
    <div class="bg-orange-50 rounded-xl p-6 mb-6 border-l-4 border-orange-600">
        <h6 class="text-md font-semibold text-orange-800 mb-4">
            <i class="fas fa-folder-upload text-orange-600 mr-2"></i>Dokumen Pendukung
        </h6>
        <div class="bg-white rounded-lg p-6 shadow-sm">
            <div
                class="grid grid-cols-1 md:grid-cols-{{ count($beasiswa->required_documents) >= 3 ? '3' : (count($beasiswa->required_documents) == 2 ? '2' : '1') }} gap-4">
                @foreach ($beasiswa->required_documents as $document)
                    <div class="file-upload-card border-2 border-dashed border-orange-300 rounded-xl p-6 text-center transition-all duration-300 cursor-pointer hover:border-orange-500 hover:bg-orange-50"
                        id="card-{{ $document['key'] }}">
                        <label for="{{ $document['key'] }}"
                            class="file-label cursor-pointer">
                            <div
                                class="file-icon text-{{ $document['color'] }}-500 text-4xl mb-4">
                                <i class="{{ $document['icon'] }}"
                                    id="icon-{{ $document['key'] }}"></i>
                            </div>
                            <div class="file-info">
                                <h6 class="file-title font-semibold text-amber-800 mb-1">
                                    {{ $document['name'] }}
                                    {{ $document['required'] ? '*' : '' }}
                                </h6>
                                <small class="file-desc text-orange-600 text-sm"
                                    id="desc-{{ $document['key'] }}">
                                    Format:
                                    {{ strtoupper(implode(', ', $document['formats'])) }}, Max:
                                    {{ $document['max_size'] }}MB
                                </small>
                                @if (!empty($document['description']))
                                    <div class="text-xs text-orange-500 mt-1">
                                        {{ $document['description'] }}</div>
                                @endif

                                <!-- Status Upload -->
                                <div class="upload-status mt-3 hidden"
                                    id="status-{{ $document['key'] }}">
                                    <div class="flex items-center justify-center mb-2">
                                        <i class="fas fa-check-circle text-orange-600 mr-2"></i>
                                        <span class="text-orange-700 font-medium text-sm"
                                            id="filename-{{ $document['key'] }}">File berhasil
                                            dipilih</span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex justify-center space-x-2 mt-3">
                                        <button type="button"
                                            onclick="previewFile('{{ $document['key'] }}')"
                                            class="px-3 py-1 text-xs bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                                            <i class="fas fa-eye mr-1"></i>Lihat File
                                        </button>
                                        <button type="button"
                                            onclick="removeFile('{{ $document['key'] }}')"
                                            class="px-3 py-1 text-xs bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </label>
                        <input type="file" class="hidden file-input"
                            id="{{ $document['key'] }}" name="{{ $document['key'] }}"
                            accept="{{ collect($document['formats'])->map(fn($ext) => '.' . $ext)->implode(',') }}"
                            {{ $document['required'] ? 'required' : '' }}
                            onchange="handleFileUpload('{{ $document['key'] }}')">
                        @error($document['key'])
                            <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

                            <!-- Terms and Submit -->
                            <div class="bg-amber-50 rounded-xl p-6">
                                <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-4 mb-6">
                                    <div class="flex items-start">
                                        <input class="mt-1 mr-3" type="checkbox" id="terms" required>
                                        <label class="text-amber-800 text-sm" for="terms">
                                            Saya menyatakan bahwa data yang saya berikan adalah <strong>benar dan
                                                valid</strong>.
                                            Saya bersedia menerima konsekuensi jika terbukti memberikan data palsu.
                                        </label>
                                    </div>
                                </div>

                                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                    <div class="form-info">
                                        <small class="text-orange-600 text-sm">
                                            <i class="fas fa-shield-alt mr-1"></i>
                                            Data Anda akan dijaga kerahasiaannya
                                        </small>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                                        <a href="{{ route('home') }}"
                                            class="bg-white border-2 border-orange-400 text-orange-700 px-6 py-3 rounded-full font-semibold hover:bg-orange-50 transition-all duration-300 text-center">
                                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                                        </a>
                                        <button type="submit"
                                            class="bg-gradient-to-r from-orange-500 to-amber-600 text-white px-6 py-3 rounded-full font-semibold hover:from-orange-600 hover:to-amber-700 transition-all duration-300 shadow-md hover:shadow-lg text-center">
                                            <i class="fas fa-paper-plane mr-2"></i>Daftar Sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div
                    class="bg-white border-2 border-orange-500 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <h6 class="text-lg font-semibold text-orange-600 mb-4">
                        <i class="fas fa-lightbulb mr-2"></i>Tips Sukses
                    </h6>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                            <span class="text-amber-700 text-sm">Pastikan dokumen berkualitas baik dan jelas</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                            <span class="text-amber-700 text-sm">Tulis alasan mendaftar dengan jujur dan meyakinkan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-yellow-500 mt-1 mr-2"></i>
                            <span class="text-amber-700 text-sm">Periksa kembali semua data sebelum mengirim</span>
                        </li>
                    </ul>
                </div>

                <div
                    class="bg-white border-2 border-yellow-400 rounded-xl p-6 shadow-md transition-all duration-300 hover:shadow-lg">
                    <h6 class="text-lg font-semibold text-yellow-600 mb-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Persyaratan Dokumen
                    </h6>
                    <ul class="space-y-2">
                        @if ($beasiswa->required_documents && count($beasiswa->required_documents) > 0)
                            @foreach ($beasiswa->required_documents as $document)
                                <li class="flex items-start">
                                    <i class="{{ $document['icon'] }} text-{{ $document['color'] }}-500 mt-1 mr-2"></i>
                                    <span class="text-amber-700 text-sm">
                                        <strong>{{ $document['name'] }}:</strong>
                                        {{ strtoupper(implode(', ', $document['formats'])) }}
                                        (Max {{ $document['max_size'] }}MB)
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <li class="flex items-start">
                                <i class="fas fa-info text-orange-500 mt-1 mr-2"></i>
                                <span class="text-amber-700 text-sm">Tidak ada dokumen khusus yang diperlukan</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

<script>
function handleFileUpload(documentKey) {
    const fileInput = document.getElementById(documentKey);
    const card = document.getElementById('card-' + documentKey);
    const icon = document.getElementById('icon-' + documentKey);
    const desc = document.getElementById('desc-' + documentKey);
    const status = document.getElementById('status-' + documentKey);
    const filename = document.getElementById('filename-' + documentKey);

    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];

        // Validasi ukuran file
        const maxSizeText = desc.textContent;
        const maxSizeMatch = maxSizeText.match(/Max: (\d+)MB/);
        const maxSize = (maxSizeMatch ? parseInt(maxSizeMatch[1]) : 5) * 1024 * 1024;

        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar. Maksimal ' + Math.round(maxSize / 1024 / 1024) + 'MB.');
            fileInput.value = '';
            return;
        }

        // Ubah tampilan card menjadi hijau (success state)
        card.classList.remove('border-orange-300', 'hover:border-orange-500', 'hover:bg-orange-50');
        card.classList.add('border-orange-600', 'bg-orange-100');

        // Ubah icon menjadi check
        icon.className = 'fas fa-check-circle';
        icon.parentElement.className = 'file-icon text-orange-600 text-4xl mb-4';

        // Sembunyikan deskripsi format dan tampilkan status
        desc.classList.add('hidden');
        status.classList.remove('hidden');

        // Tampilkan nama file
        filename.textContent = file.name;

        // Generate preview berdasarkan tipe file
        generateFilePreview(documentKey, file);

        // Animasi sukses
        card.style.animation = 'pulse 0.5s ease-in-out';

        setTimeout(() => {
            card.style.animation = '';
        }, 500);

        console.log('File uploaded:', file.name);
    }
}

function generateFilePreview(documentKey, file) {
    const fileType = file.type;
    const fileName = file.name;
    const fileSize = formatFileSize(file.size);

    // Reset semua preview
    const imgPreview = document.getElementById('img-preview-' + documentKey);
    const docPreview = document.getElementById('doc-preview-' + documentKey);

    if (imgPreview) imgPreview.classList.add('hidden');
    if (docPreview) docPreview.classList.add('hidden');

    if (fileType.startsWith('image/')) {
        // Preview untuk gambar
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('img-' + documentKey);
            if (img) {
                img.src = e.target.result;
                imgPreview.classList.remove('hidden');
            }
        };
        reader.readAsDataURL(file);
    } else {
        // Preview untuk dokumen (PDF, Word, dll)
        const docName = document.getElementById('doc-name-' + documentKey);
        const docSize = document.getElementById('doc-size-' + documentKey);
        const docIcon = docPreview ? docPreview.querySelector('i') : null;

        if (docName) docName.textContent = fileName;
        if (docSize) docSize.textContent = fileSize;

        // Set icon berdasarkan tipe file
        if (docIcon) {
            if (fileType === 'application/pdf') {
                docIcon.className = 'fas fa-file-pdf text-red-500 text-3xl mr-3';
            } else if (fileType.includes('word') || fileName.endsWith('.doc') || fileName.endsWith('.docx')) {
                docIcon.className = 'fas fa-file-word text-blue-500 text-3xl mr-3';
            } else if (fileType.includes('excel') || fileName.endsWith('.xls') || fileName.endsWith('.xlsx')) {
                docIcon.className = 'fas fa-file-excel text-green-500 text-3xl mr-3';
            } else if (fileType.includes('powerpoint') || fileName.endsWith('.ppt') || fileName.endsWith('.pptx')) {
                docIcon.className = 'fas fa-file-powerpoint text-orange-500 text-3xl mr-3';
            } else {
                docIcon.className = 'fas fa-file text-gray-500 text-3xl mr-3';
            }
        }

        if (docPreview) docPreview.classList.remove('hidden');
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function previewFile(documentKey) {
    const fileInput = document.getElementById(documentKey);
    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            // Buka gambar dalam modal/tab baru
            const reader = new FileReader();
            reader.onload = function(e) {
                const newWindow = window.open();
                newWindow.document.write(
                    '<html>' +
                    '<head><title>' + file.name + '</title></head>' +
                    '<body style="margin:0; display:flex; justify-content:center; align-items:center; background:#f0f0f0;">' +
                    '<img src="' + e.target.result + '" style="max-width:100%; max-height:100%; object-fit:contain;">' +
                    '</body>' +
                    '</html>'
                );
            };
            reader.readAsDataURL(file);
        } else if (fileType === 'application/pdf') {
            // Buka PDF dalam tab baru
            const fileURL = URL.createObjectURL(file);
            window.open(fileURL, '_blank');
        } else {
            alert('Preview tidak tersedia untuk tipe file ini. Silakan download untuk melihat file.');
        }
    }
}

function downloadFile(documentKey) {
    const fileInput = document.getElementById(documentKey);
    if (fileInput.files && fileInput.files[0]) {
        const file = fileInput.files[0];
        const url = URL.createObjectURL(file);
        const a = document.createElement('a');
        a.href = url;
        a.download = file.name;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
    }
}

function removeFile(documentKey) {
    if (confirm('Apakah Anda yakin ingin menghapus file ini?')) {
        const fileInput = document.getElementById(documentKey);
        fileInput.value = '';
        resetFileStatus(documentKey);
    }
}

function resetFileStatus(documentKey) {
    const card = document.getElementById('card-' + documentKey);
    const icon = document.getElementById('icon-' + documentKey);
    const desc = document.getElementById('desc-' + documentKey);
    const status = document.getElementById('status-' + documentKey);

    // Kembalikan ke tampilan awal
    card.classList.remove('border-orange-600', 'bg-orange-100');
    card.classList.add('border-orange-300', 'hover:border-orange-500', 'hover:bg-orange-50');

    // Reset icon - gunakan icon default
    icon.className = 'fas fa-file-upload';
    icon.parentElement.className = 'file-icon text-orange-500 text-4xl mb-4';

    // Tampilkan kembali deskripsi dan sembunyikan status
    desc.classList.remove('hidden');
    status.classList.add('hidden');
}

// Event listener untuk DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    // CSS untuk animasi
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .upload-status {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    `;
    document.head.appendChild(style);

    // Form handling
    const form = document.getElementById('registrationForm');
    const submitBtn = document.querySelector('button[type="submit"]');

    // Form validation
    if (form) {
        form.addEventListener('submit', function(e) {
            const termsCheckbox = document.getElementById('terms');

            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui syarat dan ketentuan terlebih dahulu.');
                termsCheckbox.focus();
                return;
            }

            // Loading state
            if (submitBtn) {
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';

                // Re-enable after 30 seconds as fallback
                setTimeout(() => {
                    submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Daftar Sekarang';
                }, 30000);
            }
        });
    }

    // Phone number formatting
    const phoneInput = document.getElementById('no_hp');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            // Remove non-digits
            let value = this.value.replace(/\D/g, '');

            // Limit length
            if (value.length > 13) {
                value = value.substring(0, 13);
            }

            this.value = value;
        });
    }

    // IPK validation
    const ipkInput = document.getElementById('ipk');
    if (ipkInput) {
        ipkInput.addEventListener('input', function() {
            let value = parseFloat(this.value);
            if (value > 4) {
                this.value = 4;
            } else if (value < 0) {
                this.value = 0;
            }
        });
    }

    // Character counter for textarea
    const textareaElement = document.getElementById('alasan_mendaftar');
    if (textareaElement) {
        const maxLength = 1000;
        const counterElement = document.createElement('div');
        counterElement.className = 'text-right text-sm mt-2';
        textareaElement.parentNode.appendChild(counterElement);

        function updateCounter() {
            const remaining = maxLength - textareaElement.value.length;
            counterElement.textContent = textareaElement.value.length + '/' + maxLength + ' karakter';

            if (remaining < 100) {
                counterElement.className = 'text-right text-sm mt-2 text-yellow-600';
            } else if (remaining < 0) {
                counterElement.className = 'text-right text-sm mt-2 text-red-600';
                textareaElement.value = textareaElement.value.substring(0, maxLength);
            } else {
                counterElement.className = 'text-right text-sm mt-2 text-orange-600';
            }
        }

        textareaElement.addEventListener('input', updateCounter);
        updateCounter();
    }

    // Smooth scroll to error fields
    const errorFields = document.querySelectorAll('.border-red-500');
    if (errorFields.length > 0) {
        errorFields[0].scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

    // Email readonly if user is logged in
    const emailInput = document.getElementById('email');
    if (emailInput && emailInput.value && emailInput.value.includes('@')) {
        emailInput.readOnly = true;
        emailInput.classList.add('bg-amber-100');
        emailInput.title = 'Email tidak dapat diubah karena sudah sesuai dengan akun Anda';
    }
});
</script>
@endsection