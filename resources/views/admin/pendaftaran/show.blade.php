@extends('layouts.admin')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="flex justify-between items-center flex-wrap py-4 border-b border-gray-200">
    <div>
        <h1 class="text-2xl font-bold text-gray-900"><i class="fas fa-user-graduate mr-2 text-blue-600"></i> Detail Pendaftar</h1>
        <p class="text-gray-500 mt-1">
            <i class="fas fa-info-circle mr-2"></i>Informasi lengkap tentang pendaftar beasiswa
        </p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    <div class="lg:col-span-2">
        <!-- Main Detail Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-white px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h5 class="text-lg font-semibold text-gray-900 mb-1">
                            <i class="fas fa-user text-blue-500 mr-2"></i>{{ $pendaftar->nama_lengkap }}
                        </h5>
                        <small class="text-gray-500">
                            <i class="fas fa-calendar mr-1"></i>Mendaftar pada {{ $pendaftar->created_at->format('d M Y H:i') }}
                        </small>
                    </div>
                    <div class="mt-3 md:mt-0">
                        @if($pendaftar->status == 'pending')
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-clock mr-1"></i>Pending
                            </span>
                        @elseif($pendaftar->status == 'diterima')
                            <span class="bg-green-100 text-green-800 px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>Diterima
                            </span>
                        @else
                            <span class="bg-red-100 text-red-800 px-3 py-1.5 rounded-full text-sm font-medium">
                                <i class="fas fa-times-circle mr-1"></i>Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="p-6">

                {{-- Rejection Info Section - Show if rejected --}}
                @if($pendaftar->isRejected() && $pendaftar->rejection_reason)
                <div class="mb-6 pl-4 border-l-4 border-red-500">
                    <h6 class="text-base font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-200">
                        <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>Informasi Penolakan
                    </h6>
                    <div class="bg-gradient-to-r from-red-50 to-white border border-red-200 rounded-lg p-6 shadow-sm">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Alasan Penolakan</label>
                            <p class="text-red-800 bg-red-100 p-3 rounded-md italic">{{ $pendaftar->rejection_reason }}</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status Submit Ulang</label>
                                @if($pendaftar->can_resubmit)
                                    <span class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-redo mr-1"></i>Dapat Submit Ulang
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-ban mr-1"></i>Ditolak Permanen
                                    </span>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Ditolak Pada</label>
                                <p class="text-gray-900">{{ $pendaftar->rejection_date ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Personal Info Section -->
                <div class="mb-6 pl-4 border-l-4 border-teal-500">
                    <h6 class="text-base font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-200">
                        <i class="fas fa-user-circle text-blue-400 mr-2"></i>Data Personal
                    </h6>
                    <div class="bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-lg p-6 shadow-sm">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                                <p class="text-gray-900">{{ $pendaftar->nama_lengkap }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">NIM</label>
                                <p class="text-gray-900">{{ $pendaftar->nim }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                                <p class="text-gray-900">{{ $pendaftar->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">No. HP</label>
                                <p class="text-gray-900">{{ $pendaftar->no_hp }}</p>
                            </div>
                        </div>
                        @if(isset($pendaftar->fakultas))
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Fakultas</label>
                                <p class="text-gray-900">{{ $pendaftar->fakultas ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Jurusan</label>
                                <p class="text-gray-900">{{ $pendaftar->jurusan ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Semester</label>
                                <p class="text-gray-900">{{ isset($pendaftar->semester) ? 'Semester ' . $pendaftar->semester : 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">IPK</label>
                                <p class="text-gray-900">{{ $pendaftar->ipk ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Scholarship Info Section -->
                <div class="mb-6 pl-4 border-l-4 border-teal-500">
                    <h6 class="text-base font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-200">
                        <i class="fas fa-graduation-cap text-green-500 mr-2"></i>Beasiswa yang Dilamar
                    </h6>
                    <div class="bg-gradient-to-r from-blue-50 to-white border border-blue-200 rounded-lg p-6 shadow-sm">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4 gap-3">
                            <h6 class="text-lg font-semibold text-blue-800">{{ $pendaftar->beasiswa->nama_beasiswa }}</h6>
                            <div class="text-green-700 font-bold">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                Rp {{ number_format($pendaftar->beasiswa->jumlah_dana, 0, ',', '.') }}
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $pendaftar->beasiswa->deskripsi }}</p>
                    </div>
                </div>

                <!-- Reason Section -->
                <div class="mb-6 pl-4 border-l-4 border-teal-500">
                    <h6 class="text-base font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-200">
                        <i class="fas fa-comment-alt text-yellow-500 mr-2"></i>Alasan Mendaftar
                    </h6>
                    <div class="bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-lg p-6 shadow-sm">
                        <div class="text-gray-800 italic whitespace-pre-line">
                            {{ $pendaftar->alasan_mendaftar }}
                        </div>
                    </div>
                </div>

                <!-- Dynamic Documents Section -->
                @if($pendaftar->beasiswa->required_documents && count($pendaftar->beasiswa->required_documents) > 0)
                <div class="mb-6 pl-4 border-l-4 border-teal-500">
                    <h6 class="text-base font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-200">
                        <i class="fas fa-folder-open text-blue-400 mr-2"></i>Dokumen Pendukung
                    </h6>
                    <div class="grid grid-cols-1 md:grid-cols-{{ count($pendaftar->beasiswa->required_documents) >= 3 ? '3' : (count($pendaftar->beasiswa->required_documents) == 2 ? '2' : '1') }} gap-4">
                        @foreach($pendaftar->beasiswa->required_documents as $document)
                        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow duration-300">
                            <div class="text-{{ $document['color'] }}-500 text-4xl mb-4">
                                <i class="{{ $document['icon'] }}"></i>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-800 mb-3">{{ $document['name'] }}</h6>
                                @php
                                    $uploadedFile = $pendaftar->getDocument($document['key']);
                                @endphp
                                @if($uploadedFile)
                                    <a href="{{ asset('storage/documents/' . $uploadedFile) }}"
                                       target="_blank"
                                       class="inline-block border border-blue-500 text-blue-500 px-4 py-1.5 rounded-md text-sm hover:bg-blue-500 hover:text-white transition-colors duration-300">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                    <div class="text-xs text-gray-500 mt-2">
                                        {{ $uploadedFile }}
                                    </div>
                                @else
                                    <div class="text-sm text-red-500 font-medium">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>Tidak Diupload
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <!-- Action Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-white px-6 py-4 border-b border-gray-200">
                <h6 class="font-semibold text-gray-900">
                    <i class="fas fa-cogs text-yellow-500 mr-2"></i>Aksi Pendaftar
                </h6>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.pendaftar.update-status', $pendaftar) }}" method="POST" id="statusForm">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block font-medium text-gray-700 mb-2">
                            <i class="fas fa-edit mr-2"></i>Update Status
                        </label>
                        <select name="status" id="statusSelect" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent" required>
                            <option value="pending" {{ $pendaftar->status == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="diterima" {{ $pendaftar->status == 'diterima' ? 'selected' : '' }}>
                                Diterima
                            </option>
                            <option value="ditolak" {{ $pendaftar->status == 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                        </select>
                    </div>

                    {{-- Rejection Fields - Show only when ditolak is selected --}}
                    <div id="rejectionFields" class="mb-4" style="display: {{ $pendaftar->status == 'ditolak' ? 'block' : 'none' }};">
                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-2">
                                <i class="fas fa-comment-alt mr-2 text-red-500"></i>Alasan Penolakan <span class="text-red-500">*</span>
                            </label>
                            <textarea name="rejection_reason"
                                     id="rejectionReason"
                                     rows="4"
                                     class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent resize-none"
                                     placeholder="Masukkan alasan penolakan (minimal 10 karakter)"
                                     minlength="10"
                                     maxlength="1000">{{ old('rejection_reason', $pendaftar->rejection_reason) }}</textarea>
                            <div class="text-xs text-gray-500 mt-1">
                                <span id="charCount">0</span>/1000 karakter (minimal 10)
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-gray-700 mb-3">
                                <i class="fas fa-question-circle mr-2 text-blue-500"></i>Status Submit Ulang <span class="text-red-500">*</span>
                            </label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors duration-200">
                                    <input type="radio"
                                           name="can_resubmit"
                                           value="1"
                                           class="text-blue-600 mr-3"
                                           {{ old('can_resubmit', $pendaftar->can_resubmit) == '1' ? 'checked' : '' }}>
                                    <div>
                                        <div class="font-medium text-gray-900">Dapat Submit Ulang</div>
                                        <div class="text-sm text-gray-600">User dapat mengedit dan mengajukan kembali</div>
                                    </div>
                                </label>
                                <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 transition-colors duration-200">
                                    <input type="radio"
                                           name="can_resubmit"
                                           value="0"
                                           class="text-red-600 mr-3"
                                           {{ old('can_resubmit', $pendaftar->can_resubmit) == '0' ? 'checked' : '' }}>
                                    <div>
                                        <div class="font-medium text-gray-900">Ditolak Permanen</div>
                                        <div class="text-sm text-gray-600">User tidak dapat mengajukan kembali</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:from-teal-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fas fa-save mr-2"></i>Update Status
                        </button>
                    </div>
                </form>

                <hr class="my-5 border-gray-200">

                <div>
                    <form action="{{ route('admin.pendaftar.destroy', $pendaftar) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            <i class="fas fa-trash mr-2"></i>Hapus Data
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Rejection History Card --}}
        @if($rejectionHistories && $rejectionHistories->count() > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-white px-6 py-4 border-b border-gray-200">
                <h6 class="font-semibold text-gray-900">
                    <i class="fas fa-history text-red-500 mr-2"></i>Riwayat Penolakan
                </h6>
            </div>
            <div class="p-6 max-h-80 overflow-y-auto">
                @foreach($rejectionHistories as $history)
                <div class="mb-4 p-4 border border-red-200 rounded-lg bg-red-50">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs text-red-600 font-medium">{{ $history->formatted_rejected_at }}</span>
                        @if($history->can_resubmit)
                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Dapat Resubmit</span>
                        @else
                            <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded">Permanen</span>
                        @endif
                    </div>
                    <p class="text-sm text-red-800 italic">{{ $history->rejection_reason }}</p>
                    @if($history->rejected_by)
                        <p class="text-xs text-gray-600 mt-2">Oleh: {{ $history->rejected_by }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Document Summary Card -->
        @if($pendaftar->beasiswa->required_documents && count($pendaftar->beasiswa->required_documents) > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-white px-6 py-4 border-b border-gray-200">
                <h6 class="font-semibold text-gray-900">
                    <i class="fas fa-file-check text-green-500 mr-2"></i>Ringkasan Dokumen
                </h6>
            </div>
            <div class="p-6">
                @php
                    $totalRequired = collect($pendaftar->beasiswa->required_documents)->where('required', true)->count();
                    $uploadedRequired = 0;
                    foreach($pendaftar->beasiswa->required_documents as $doc) {
                        if($doc['required'] && $pendaftar->getDocument($doc['key'])) {
                            $uploadedRequired++;
                        }
                    }
                    $completionPercentage = $totalRequired > 0 ? round(($uploadedRequired / $totalRequired) * 100) : 100;
                @endphp

                <div class="mb-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                        <span>Kelengkapan Dokumen</span>
                        <span>{{ $uploadedRequired }}/{{ $totalRequired }} dokumen</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-green-500 to-teal-600 h-2 rounded-full transition-all duration-300"
                             style="width: {{ $completionPercentage }}%"></div>
                    </div>
                    <div class="text-center mt-2">
                        <span class="text-lg font-bold text-{{ $completionPercentage >= 100 ? 'green' : ($completionPercentage >= 50 ? 'yellow' : 'red') }}-600">
                            {{ $completionPercentage }}%
                        </span>
                    </div>
                </div>

                <div class="space-y-2">
                    @foreach($pendaftar->beasiswa->required_documents as $document)
                    @php
                        $isUploaded = $pendaftar->getDocument($document['key']);
                    @endphp
                    <div class="flex items-center justify-between p-2 rounded-lg {{ $isUploaded ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                        <div class="flex items-center">
                            <i class="{{ $document['icon'] }} text-{{ $document['color'] }}-500 mr-2"></i>
                            <span class="text-sm font-medium">{{ $document['name'] }}</span>
                            @if($document['required'])
                                <span class="text-red-500 ml-1">*</span>
                            @endif
                        </div>
                        @if($isUploaded)
                            <i class="fas fa-check-circle text-green-500"></i>
                        @else
                            <i class="fas fa-times-circle text-red-500"></i>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Statistics Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="bg-white px-6 py-4 border-b border-gray-200">
                <h6 class="font-semibold text-gray-900">
                    <i class="fas fa-chart-bar text-blue-500 mr-2"></i>Statistik
                </h6>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-4">
                    <div class="text-blue-500 text-3xl min-w-[60px] text-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-gray-900">{{ $pendaftar->beasiswa->pendaftars->count() }}</div>
                        <div class="text-sm text-gray-600 font-medium mt-1">Total pendaftar untuk beasiswa ini</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('admin.pendaftar.index') }}"
                       class="bg-white border border-gray-400 text-gray-700 px-4 py-2.5 rounded-lg font-medium text-center hover:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow-md">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                    <a href="#" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-4 py-2.5 rounded-lg font-medium text-center hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg" onclick="printData()">
                        <i class="fas fa-print mr-2"></i>Cetak Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const rejectionFields = document.getElementById('rejectionFields');
    const rejectionReason = document.getElementById('rejectionReason');
    const charCount = document.getElementById('charCount');
    const statusForm = document.getElementById('statusForm');

    // Toggle rejection fields visibility
    function toggleRejectionFields() {
        if (statusSelect.value === 'ditolak') {
            rejectionFields.style.display = 'block';
            rejectionReason.required = true;
        } else {
            rejectionFields.style.display = 'none';
            rejectionReason.required = false;
            rejectionReason.value = '';
            // Uncheck radio buttons
            document.querySelectorAll('input[name="can_resubmit"]').forEach(radio => {
                radio.checked = false;
            });
        }
    }

    // Character count for rejection reason
    function updateCharCount() {
        const count = rejectionReason.value.length;
        charCount.textContent = count;

        if (count < 10) {
            charCount.parentElement.className = 'text-xs text-red-500 mt-1';
        } else {
            charCount.parentElement.className = 'text-xs text-gray-500 mt-1';
        }
    }

    // Event listeners
    statusSelect.addEventListener('change', toggleRejectionFields);
    if (rejectionReason) {
        rejectionReason.addEventListener('input', updateCharCount);
    }

    // Form validation
    statusForm.addEventListener('submit', function(e) {
        if (statusSelect.value === 'ditolak') {
            const reason = rejectionReason.value.trim();
            const canResubmit = document.querySelector('input[name="can_resubmit"]:checked');

            if (!reason || reason.length < 10) {
                e.preventDefault();
                alert('Alasan penolakan minimal 10 karakter!');
                rejectionReason.focus();
                return false;
            }

            if (!canResubmit) {
                e.preventDefault();
                alert('Pilih status submit ulang!');
                return false;
            }

            // Konfirmasi penolakan
            if (!confirm(`Konfirmasi penolakan?\n\nAlasan: ${reason.substring(0, 100)}${reason.length > 100 ? '...' : ''}\nStatus: ${canResubmit.value == '1' ? 'Dapat submit ulang' : 'Ditolak permanen'}`)) {
                e.preventDefault();
                return false;
            }
        }

        // Loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';

        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        }, 3000);
    });

    // Initialize
    toggleRejectionFields();
    if (rejectionReason) {
        updateCharCount();
    }

    // Print functionality
    window.printData = function() {
        window.print();
    }
});
</script>

<style>
/* Print styles */
@media print {
    .bg-white.rounded-lg,
    .bg-gradient-to-r,
    .shadow-sm,
    .shadow-md,
    .shadow-lg {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }

    button,
    a,
    form,
    hr {
        display: none !important;
    }

    .lg\:col-span-1 {
        display: none;
    }

    .grid-cols-1 {
        grid-template-columns: 1fr !important;
    }
}

/* Scrollable content styling */
.scrollable-content::-webkit-scrollbar {
    width: 6px;
}

.scrollable-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.scrollable-content::-webkit-scrollbar-thumb {
    background: #00c9a7;
    border-radius: 3px;
}

.scrollable-content::-webkit-scrollbar-thumb:hover {
    background: #00a693;
}

/* Rejection fields animation */
#rejectionFields {
    transition: all 0.3s ease-in-out;
}
</style>
@endsection
