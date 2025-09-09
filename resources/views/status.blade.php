@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-clipboard-check text-teal-500 mr-2"></i>Status Pendaftaran Beasiswa
            </h1>
            <p class="text-gray-600">Pantau perkembangan beasiswa Anda</p>
        </div>

        <!-- Main Application Status Card -->
        @if($userApplication)
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden mb-8">

            <!-- Card Header -->
            <div class="bg-gradient-to-r from-teal-500 to-blue-600 px-6 py-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between text-white">
                    <div>
                        <h2 class="text-xl font-bold mb-1">{{ $userApplication->beasiswa->nama_beasiswa }}</h2>
                        <p class="opacity-90">
                            <i class="fas fa-calendar mr-2"></i>Diajukan pada {{ $userApplication->created_at->format('d M Y H:i') }}
                        </p>
                    </div>
                    <div class="mt-3 md:mt-0">
                        @if($userApplication->status == 'pending')
                            <span class="bg-yellow-500 bg-opacity-90 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center">
                                <i class="fas fa-clock mr-2"></i>Pending Review
                            </span>
                        @elseif($userApplication->status == 'diterima')
                            <span class="bg-green-500 bg-opacity-90 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Diterima
                            </span>
                        @else
                            <span class="bg-red-500 bg-opacity-90 px-4 py-2 rounded-full text-sm font-bold inline-flex items-center">
                                <i class="fas fa-times-circle mr-2"></i>Ditolak
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6">

                {{-- Rejection Information - Show if rejected --}}
                @if($userApplication->isRejected() && $userApplication->rejection_reason)
                <div class="mb-6 p-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-red-800 mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>Informasi Penolakan
                        </h3>
                        <div class="bg-white p-4 rounded-lg border border-red-200">
                            <p class="text-red-800 leading-relaxed">{{ $userApplication->rejection_reason }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-red-700 mb-2">Status Submit Ulang</label>
                            @if($userApplication->can_resubmit)
                                <div class="bg-blue-100 border border-blue-300 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-redo text-blue-600 mr-2"></i>
                                        <span class="text-blue-800 font-medium">Dapat Submit Ulang</span>
                                    </div>
                                    <p class="text-sm text-blue-700 mt-1">Anda dapat mengedit dan mengajukan kembali Beasiswa ini</p>
                                </div>
                            @else
                                <div class="bg-gray-100 border border-gray-300 rounded-lg p-3">
                                    <div class="flex items-center">
                                        <i class="fas fa-ban text-gray-600 mr-2"></i>
                                        <span class="text-gray-800 font-medium">Ditolak Permanen</span>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-1">Beasiswa tidak dapat diajukan kembali</p>
                                </div>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-red-700 mb-2">Tanggal Penolakan</label>
                            <div class="bg-white border border-red-200 rounded-lg p-3">
                                <span class="text-red-800">{{ $userApplication->rejection_date ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Button for Resubmit --}}
                    @if($userApplication->can_resubmit)
                        @if($userApplication->beasiswa->isActive())
                            <div class="text-center">
                                <a href="{{ route('pendaftar.resubmit', $userApplication) }}"
                                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    <i class="fas fa-edit mr-2"></i>Edit dan Submit Ulang
                                </a>
                            </div>
                        @else
                            <div class="text-center">
                                <button disabled class="inline-flex items-center px-6 py-3 bg-gray-300 text-gray-600 font-semibold rounded-lg cursor-not-allowed">
                                    <i class="fas fa-clock mr-2"></i>Beasiswa Sudah Ditutup
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                @endif

                <!-- Basic Information Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- Personal Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">
                            <i class="fas fa-user text-blue-500 mr-2"></i>Data Personal
                        </h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Lengkap</label>
                                <p class="text-gray-900 font-medium">{{ $userApplication->nama_lengkap }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">NIM</label>
                                <p class="text-gray-900 font-medium">{{ $userApplication->nim }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Email</label>
                                <p class="text-gray-900 font-medium">{{ $userApplication->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">No. HP</label>
                                <p class="text-gray-900 font-medium">{{ $userApplication->no_hp }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Scholarship Info -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2">
                            <i class="fas fa-graduation-cap text-green-500 mr-2"></i>Info Beasiswa
                        </h3>
                        <div class="bg-gradient-to-br from-blue-50 to-green-50 p-4 rounded-lg border border-blue-200">
                            <h4 class="font-semibold text-blue-800 mb-2">{{ $userApplication->beasiswa->nama_beasiswa }}</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dana Beasiswa:</span>
                                    <span class="font-semibold text-green-600">Rp {{ number_format($userApplication->beasiswa->jumlah_dana, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status Beasiswa:</span>
                                    @if($userApplication->beasiswa->isActive())
                                        <span class="text-green-600 font-medium">Aktif</span>
                                    @else
                                        <span class="text-red-600 font-medium">Ditutup</span>
                                    @endif
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Batas Tutup:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($userApplication->beasiswa->tanggal_tutup)->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reason Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">
                        <i class="fas fa-comment-alt text-yellow-500 mr-2"></i>Alasan Mendaftar
                    </h3>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-gray-800 italic leading-relaxed">{{ $userApplication->alasan_mendaftar }}</p>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">
                        <i class="fas fa-folder-open text-purple-500 mr-2"></i>Dokumen yang Diupload
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gradient-to-br from-red-50 to-pink-50 p-4 rounded-lg border border-red-200 text-center">
                            <div class="text-red-500 text-3xl mb-3">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">Transkrip Nilai</h5>
                            <a href="{{ asset('storage/documents/' . $userApplication->file_transkrip) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 bg-red-500 text-white text-sm rounded-md hover:bg-red-600 transition-colors duration-200">
                                <i class="fas fa-eye mr-1"></i>Lihat File
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-200 text-center">
                            <div class="text-blue-500 text-3xl mb-3">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">KTP</h5>
                            <a href="{{ asset('storage/documents/' . $userApplication->file_ktp) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 bg-blue-500 text-white text-sm rounded-md hover:bg-blue-600 transition-colors duration-200">
                                <i class="fas fa-eye mr-1"></i>Lihat File
                            </a>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-4 rounded-lg border border-green-200 text-center">
                            <div class="text-green-500 text-3xl mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            <h5 class="font-semibold text-gray-800 mb-2">Kartu Keluarga</h5>
                            <a href="{{ asset('storage/documents/' . $userApplication->file_kk) }}"
                               target="_blank"
                               class="inline-flex items-center px-3 py-2 bg-green-500 text-white text-sm rounded-md hover:bg-green-600 transition-colors duration-200">
                                <i class="fas fa-eye mr-1"></i>Lihat File
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 border-b border-gray-200 pb-2 mb-4">
                        <i class="fas fa-timeline text-indigo-500 mr-2"></i>Timeline Status
                    </h3>
                    <div class="space-y-4">
                        <!-- Submitted -->
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-paper-plane text-white text-sm"></i>
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="text-sm font-medium text-gray-900">Beasiswa Diajukan</div>
                                <div class="text-sm text-gray-600">{{ $userApplication->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>

                        <!-- Current Status -->
                        @if($userApplication->status == 'pending')
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center animate-pulse">
                                    <i class="fas fa-clock text-white text-sm"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900">Sedang Dalam Review</div>
                                    <div class="text-sm text-gray-600">Menunggu keputusan admin</div>
                                </div>
                            </div>
                        @elseif($userApplication->status == 'diterima')
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900"> Beasiswa Diterima</div>
                                    <div class="text-sm text-gray-600">Selamat! Beasiswa Anda diterima</div>
                                </div>
                            </div>
                        @else
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                    <i class="fas fa-times text-white text-sm"></i>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="text-sm font-medium text-gray-900">Beasiswa Ditolak</div>
                                    <div class="text-sm text-gray-600">
                                        {{ $userApplication->rejection_date ?? 'Tanggal tidak tersedia' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
            <!-- No Application Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 text-center">
                <div class="text-6xl text-gray-300 mb-4">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Beasiswa</h3>
                <p class="text-gray-600 mb-6">Anda belum mendaftar untuk beasiswa apapun</p>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-teal-500 to-blue-600 text-white font-semibold rounded-lg hover:from-teal-600 hover:to-blue-700 transition-all duration-300">
                    <i class="fas fa-search mr-2"></i>Lihat Beasiswa Tersedia
                </a>
            </div>
        @endif

        <!-- All Applications History (if more than one) -->
        @if($allApplications && $allApplications->count() > 1)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-history text-gray-500 mr-2"></i>Riwayat Semua Pendaftaran
                </h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Beasiswa</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Tanggal</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allApplications as $application)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-gray-900">{{ $application->beasiswa->nama_beasiswa }}</div>
                                    <div class="text-sm text-gray-600">Rp {{ number_format($application->beasiswa->jumlah_dana, 0, ',', '.') }}</div>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-600">
                                    {{ $application->created_at->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    @if($application->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @elseif($application->status == 'diterima')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i>Diterima
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            <i class="fas fa-times-circle mr-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($application->canResubmit() && $application->beasiswa->isActive())
                                        <a href="{{ route('pendaftar.resubmit', $application) }}"
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <i class="fas fa-edit mr-1"></i>Edit
                                        </a>
                                    @elseif($application->isRejected() && $application->rejection_reason)
                                        <button onclick="showRejectionReason('{{ addslashes($application->rejection_reason) }}')"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            <i class="fas fa-info-circle mr-1"></i>Detail
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Action Buttons -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}"
               class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-lg hover:bg-gray-300 transition-all duration-300 mr-4">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>

            @if($userApplication && $userApplication->status == 'diterima')
                <button onclick="window.print()"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300">
                    <i class="fas fa-print mr-2"></i>Cetak Bukti Penerimaan
                </button>
            @endif
        </div>
    </div>
</div>

<!-- Rejection Reason Modal -->
<div id="rejectionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>Alasan Penolakan
            </h3>
            <button onclick="closeRejectionModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p id="rejectionReasonText" class="text-red-800"></p>
        </div>
        <div class="mt-4 text-right">
            <button onclick="closeRejectionModal()"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors duration-200">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function showRejectionReason(reason) {
    document.getElementById('rejectionReasonText').textContent = reason;
    document.getElementById('rejectionModal').classList.remove('hidden');
}

function closeRejectionModal() {
    document.getElementById('rejectionModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectionModal();
    }
});

// Print styles
const printStyles = `
    @media print {
        .no-print { display: none !important; }
        .bg-gradient-to-r, .shadow-xl, .shadow-lg {
            box-shadow: none !important;
            background: white !important;
            border: 1px solid #ddd !important;
        }
        .text-white { color: black !important; }
    }
`;

const styleSheet = document.createElement("style");
styleSheet.innerText = printStyles;
document.head.appendChild(styleSheet);
</script>

<style>
@media print {
    .no-print {
        display: none !important;
    }

    .bg-gradient-to-r {
        background: white !important;
        color: black !important;
        border: 2px solid #ddd !important;
    }

    .shadow-xl,
    .shadow-lg {
        box-shadow: none !important;
    }

    .text-white {
        color: black !important;
    }
}

/* Animation for status indicators */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: .5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
@endsection
