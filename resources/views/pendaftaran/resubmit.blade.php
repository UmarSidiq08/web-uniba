@extends('layouts.app')

@section('title', 'Edit dan Submit Ulang - ' . $pendaftar->beasiswa->nama_beasiswa)

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-edit text-blue-500 mr-2"></i>Edit dan Submit Ulang
                </h1>
                <p class="text-gray-600">Perbaiki Beasiswa Anda dan ajukan kembali</p>
            </div>

            <!-- Previous Rejection Info -->
            <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 rounded-r-lg">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-red-500 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-lg font-semibold text-red-800 mb-2">Alasan Penolakan Sebelumnya</h3>
                        <div class="bg-white border border-red-200 rounded-lg p-4">
                            <p class="text-red-800">{{ $pendaftar->rejection_reason }}</p>
                        </div>
                        <div class="mt-3">
                            <span class="text-sm text-red-700">
                                <i class="fas fa-calendar mr-1"></i>Ditolak pada:
                                {{ $pendaftar->rejected_at ? $pendaftar->rejected_at->format('d M Y H:i') : '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h2 class="text-xl font-bold text-white">
                        <i class="fas fa-graduation-cap mr-2"></i>{{ $pendaftar->beasiswa->nama_beasiswa }}
                    </h2>
                    <p class="text-blue-100">Dana: Rp {{ number_format($pendaftar->beasiswa->jumlah_dana, 0, ',', '.') }}
                    </p>
                </div>

                <form action="{{ route('pendaftar.resubmit.store', $pendaftar) }}" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')

                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>Data Personal
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block font-medium text-gray-700 mb-2" for="nama_lengkap">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $pendaftar->nama_lengkap) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_lengkap') border-red-500 @enderror"
                                    required>
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-2" for="nim">
                                    NIM <span class="text-red-500">*</span>
                                </label>
                                <input type="number" id="nim" name="nim"
                                    value="{{ old('nim', $pendaftar->nim) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nim') border-red-500 @enderror"
                                    required>
                                @error('nim')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-2" for="email">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $pendaftar->email) }}" readonly
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg bg-gray-100 text-gray-600 cursor-not-allowed">
                                <p class="text-xs text-gray-500 mt-1">Email tidak dapat diubah</p>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-2" for="no_hp">
                                    No. HP <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', $pendaftar->no_hp) }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_hp') border-red-500 @enderror"
                                    required>
                                @error('no_hp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            @if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents))
                                @php
                                    // Check if new format has fakultas, jurusan, semester, ipk fields
                                    $hasAcademicFields = false;
                                    foreach ($pendaftar->beasiswa->required_documents as $doc) {
                                        if (in_array($doc['key'], ['fakultas', 'jurusan', 'semester', 'ipk'])) {
                                            $hasAcademicFields = true;
                                            break;
                                        }
                                    }
                                @endphp

                                @if (!$hasAcademicFields && isset($pendaftar->fakultas))
                                    <div>
                                        <label class="block font-medium text-gray-700 mb-2" for="fakultas">
                                            Fakultas <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="fakultas" name="fakultas"
                                            value="{{ old('fakultas', $pendaftar->fakultas) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('fakultas') border-red-500 @enderror"
                                            required>
                                        @error('fakultas')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block font-medium text-gray-700 mb-2" for="jurusan">
                                            Jurusan <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="jurusan" name="jurusan"
                                            value="{{ old('jurusan', $pendaftar->jurusan) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jurusan') border-red-500 @enderror"
                                            required>
                                        @error('jurusan')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block font-medium text-gray-700 mb-2" for="semester">
                                            Semester <span class="text-red-500">*</span>
                                        </label>
                                        <select id="semester" name="semester"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('semester') border-red-500 @enderror"
                                            required>
                                            <option value="">-- Pilih Semester --</option>
                                            @for ($i = 1; $i <= 14; $i++)
                                                <option value="{{ $i }}"
                                                    {{ old('semester', $pendaftar->semester) == $i ? 'selected' : '' }}>
                                                    Semester {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                        @error('semester')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block font-medium text-gray-700 mb-2" for="ipk">
                                            IPK <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" id="ipk" name="ipk" step="0.01" min="0"
                                            max="4" value="{{ old('ipk', $pendaftar->ipk) }}"
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ipk') border-red-500 @enderror"
                                            required>
                                        @error('ipk')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Alasan Mendaftar -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                            <i class="fas fa-comment-alt text-yellow-500 mr-2"></i>Alasan Mendaftar
                        </h3>
                        <div>
                            <label class="block font-medium text-gray-700 mb-2" for="alasan_mendaftar">
                                Jelaskan alasan Anda mendaftar untuk beasiswa ini <span class="text-red-500">*</span>
                            </label>
                            <textarea id="alasan_mendaftar" name="alasan_mendaftar" rows="5"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none @error('alasan_mendaftar') border-red-500 @enderror"
                                placeholder="Tulis alasan Anda dengan jelas dan detail..." required>{{ old('alasan_mendaftar', $pendaftar->alasan_mendaftar) }}</textarea>
                            @error('alasan_mendaftar')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <!-- Replace the file input section in resubmit.blade.php -->


                    <!-- Dynamic Document Upload -->
                    @if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents))
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">
                                <i class="fas fa-folder-open text-purple-500 mr-2"></i>Upload Dokumen
                            </h3>
                            <p class="text-sm text-gray-600 mb-6">
                                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                Kosongkan jika tidak ingin mengubah file yang sudah ada
                            </p>

                            @php
                                $colorClasses = [
                                    'red' => 'bg-red-50 border-red-300 hover:border-red-400',
                                    'blue' => 'bg-blue-50 border-blue-300 hover:border-blue-400',
                                    'green' => 'bg-green-50 border-green-300 hover:border-green-400',
                                    'yellow' => 'bg-yellow-50 border-yellow-300 hover:border-yellow-400',
                                    'purple' => 'bg-purple-50 border-purple-300 hover:border-purple-400',
                                    'orange' => 'bg-orange-50 border-orange-300 hover:border-orange-400',
                                    'teal' => 'bg-teal-50 border-teal-300 hover:border-teal-400',
                                    'gray' => 'bg-gray-50 border-gray-300 hover:border-gray-400',
                                ];

                                $textColorClasses = [
                                    'red' => 'text-red-500',
                                    'blue' => 'text-blue-500',
                                    'green' => 'text-green-500',
                                    'yellow' => 'text-yellow-500',
                                    'purple' => 'text-purple-500',
                                    'orange' => 'text-orange-500',
                                    'teal' => 'text-teal-500',
                                    'gray' => 'text-gray-500',
                                ];

                                $btnColorClasses = [
                                    'red' => 'bg-red-500 hover:bg-red-600',
                                    'blue' => 'bg-blue-500 hover:bg-blue-600',
                                    'green' => 'bg-green-500 hover:bg-green-600',
                                    'yellow' => 'bg-yellow-500 hover:bg-yellow-600',
                                    'purple' => 'bg-purple-500 hover:bg-purple-600',
                                    'orange' => 'bg-orange-500 hover:bg-orange-600',
                                    'teal' => 'bg-teal-500 hover:bg-teal-600',
                                    'gray' => 'bg-gray-500 hover:bg-gray-600',
                                ];

                                $linkColorClasses = [
                                    'red' => 'text-red-600 hover:text-red-800',
                                    'blue' => 'text-blue-600 hover:text-blue-800',
                                    'green' => 'text-green-600 hover:text-green-800',
                                    'yellow' => 'text-yellow-600 hover:text-yellow-800',
                                    'purple' => 'text-purple-600 hover:text-purple-800',
                                    'orange' => 'text-orange-600 hover:text-orange-800',
                                    'teal' => 'text-teal-600 hover:text-teal-800',
                                    'gray' => 'text-gray-600 hover:text-gray-800',
                                ];

                                $documentsPerRow = count($pendaftar->beasiswa->required_documents);
                                $gridCols =
                                    $documentsPerRow <= 3
                                        ? "grid-cols-1 md:grid-cols-{$documentsPerRow}"
                                        : 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3';
                            @endphp

                            <div class="grid {{ $gridCols }} gap-6">
                                @foreach ($pendaftar->beasiswa->required_documents as $document)
                                    @php
                                        $colorClass = $colorClasses[$document['color']] ?? $colorClasses['gray'];
                                        $textColorClass =
                                            $textColorClasses[$document['color']] ?? $textColorClasses['gray'];
                                        $btnColorClass =
                                            $btnColorClasses[$document['color']] ?? $btnColorClasses['gray'];
                                        $linkColorClass =
                                            $linkColorClasses[$document['color']] ?? $linkColorClasses['gray'];

                                        $acceptedFormats = '.' . implode(',.', $document['formats']);
                                        $formatText = strtoupper(implode(', ', $document['formats']));

                                        $currentFile = $pendaftar->getDocument($document['key']);
                                        $fileDisplayName = str_replace(['file_', '_'], ['', ' '], $document['key']);
                                        $fileDisplayName = ucwords($fileDisplayName);
                                    @endphp

                                    <div
                                        class="border-2 border-dashed rounded-lg p-6 text-center transition-colors duration-200 {{ $colorClass }}">
                                        <div class="text-4xl mb-4 {{ $textColorClass }}">
                                            <i class="{{ $document['icon'] }}"></i>
                                        </div>
                                        <h4 class="font-semibold text-gray-800 mb-2">
                                            {{ $document['name'] }}
                                            {{-- @if ($document['required'])
                                                <span class="text-red-500">*</span>
                                            @endif --}}
                                        </h4>

                                        @if ($document['description'])
                                            <p class="text-xs text-gray-600 mb-3">{{ $document['description'] }}</p>
                                        @endif

                                        <input type="file" id="{{ $document['key'] }}" name="{{ $document['key'] }}"
                                            accept="{{ $acceptedFormats }}" class="hidden">



                                        <label for="{{ $document['key'] }}"
                                            class="cursor-pointer inline-block text-white px-4 py-2 rounded-lg transition-colors duration-200 mb-3 {{ $btnColorClass }}">
                                            <i class="fas fa-upload mr-2"></i>Pilih File
                                        </label>

                                        <div class="text-xs text-gray-600">
                                            @if ($currentFile)
                                                <p>File saat ini:
                                                    <a href="{{ asset('storage/documents/' . $currentFile) }}"
                                                        target="_blank" class="underline {{ $linkColorClass }}">
                                                        Lihat file lama
                                                    </a>
                                                </p>
                                            @endif
                                            <p class="mt-1">{{ $formatText }} (Max: {{ $document['max_size'] }}MB)
                                            </p>


                                        </div>

                                        <p id="{{ $document['key'] }}-file-name" class="text-sm text-gray-700 mt-2"></p>

                                        @error($document['key'])
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Ulang Beasiswa
                        </button>
                        <a href="{{ route('status') }}"
                            class="flex-1 bg-gray-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 text-center">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Status
                        </a>
                    </div>
                </form>
            </div>

            <!-- Guidelines -->
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mt-8">
                <h3 class="text-lg font-semibold text-yellow-800 mb-3">
                    <i class="fas fa-lightbulb text-yellow-600 mr-2"></i>Tips untuk Resubmit
                </h3>
                <ul class="text-sm text-yellow-800 space-y-2">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-0.5"></i>
                        Baca dengan teliti alasan penolakan di atas
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-0.5"></i>
                        Perbaiki bagian yang menjadi alasan penolakan
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-0.5"></i>
                        Pastikan semua dokumen sudah sesuai persyaratan
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-0.5"></i>
                        Upload ulang dokumen hanya jika diperlukan
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk preview file -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents))
                // Dynamic file input handlers based on required documents
                const fileInputs = [
                    @foreach ($pendaftar->beasiswa->required_documents as $document)
                        {
                            input: '{{ $document['key'] }}',
                            display: '{{ $document['key'] }}-file-name',
                            maxSize: {{ $document['max_size'] }}
                        },
                    @endforeach
                ];

                fileInputs.forEach(function(item) {
                    const input = document.getElementById(item.input);
                    const display = document.getElementById(item.display);

                    if (input && display) {
                        input.addEventListener('change', function() {
                            if (this.files && this.files[0]) {
                                const fileName = this.files[0].name;
                                const fileSize = (this.files[0].size / (1024 * 1024)).toFixed(2);

                                // Check file size
                                if (parseFloat(fileSize) > item.maxSize) {
                                    alert(
                                        `File ${fileName} terlalu besar! Maksimal ${item.maxSize}MB`);
                                    this.value = '';
                                    display.innerHTML = '';
                                    return;
                                }

                                display.innerHTML =
                                    `<strong>File baru:</strong> ${fileName} (${fileSize} MB)`;
                                display.classList.add('text-green-600');
                                display.classList.remove('text-red-500');
                            } else {
                                display.innerHTML = '';
                                display.classList.remove('text-green-600', 'text-red-500');
                            }
                        });
                    }
                });
            @else
                // Fallback to default file inputs if no dynamic documents
                const fileInputs = [{
                        input: 'file_transkrip',
                        display: 'transkrip-file-name',
                        maxSize: 5
                    },
                    {
                        input: 'file_ktp',
                        display: 'ktp-file-name',
                        maxSize: 5
                    },
                    {
                        input: 'file_kk',
                        display: 'kk-file-name',
                        maxSize: 5
                    }
                ];

                fileInputs.forEach(function(item) {
                    const input = document.getElementById(item.input);
                    const display = document.getElementById(item.display);

                    if (input && display) {
                        input.addEventListener('change', function() {
                            if (this.files && this.files[0]) {
                                const fileName = this.files[0].name;
                                const fileSize = (this.files[0].size / (1024 * 1024)).toFixed(2);

                                if (parseFloat(fileSize) > item.maxSize) {
                                    alert(
                                        `File ${fileName} terlalu besar! Maksimal ${item.maxSize}MB`);
                                    this.value = '';
                                    display.innerHTML = '';
                                    return;
                                }

                                display.innerHTML =
                                    `<strong>File baru:</strong> ${fileName} (${fileSize} MB)`;
                                display.classList.add('text-green-600');
                            } else {
                                display.innerHTML = '';
                                display.classList.remove('text-green-600');
                            }
                        });
                    }
                });
            @endif

            // Form submission confirmation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const confirmation = confirm(
                    'Apakah Anda yakin ingin mengajukan Beasiswa ini kembali?');
                    if (!confirmation) {
                        e.preventDefault();
                    }
                });
            }
        });
    </script>

@endsection
