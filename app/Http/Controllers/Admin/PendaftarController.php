<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Beasiswa;
use App\Models\RejectionHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = Pendaftar::with('beasiswa')->latest()->paginate(10);
        return view('admin.pendaftaran.index', compact('pendaftars'));
    }

    public function show(Pendaftar $pendaftar)
    {
        // Load rejection history untuk ditampilkan ke admin
        $rejectionHistories = RejectionHistory::where('pendaftar_id', $pendaftar->id)
                                            ->orderBy('rejected_at', 'desc')
                                            ->get();

        return view('admin.pendaftaran.show', compact('pendaftar', 'rejectionHistories'));
    }

    public function updateStatus(Request $request, Pendaftar $pendaftar)
    {
        $rules = [
            'status' => 'required|in:pending,diterima,ditolak'
        ];

        // Jika status ditolak, tambah validasi untuk rejection fields
        if ($request->status === 'ditolak') {
            $rules['rejection_reason'] = 'required|string|min:10|max:1000';
            $rules['can_resubmit'] = 'required|boolean';
        }

        $validated = $request->validate($rules, [
            'rejection_reason.required' => 'Alasan penolakan wajib diisi',
            'rejection_reason.min' => 'Alasan penolakan minimal 10 karakter',
            'rejection_reason.max' => 'Alasan penolakan maksimal 1000 karakter',
            'can_resubmit.required' => 'Pilihan dapat submit ulang wajib dipilih',
        ]);

        // Jika status berubah dari apapun ke ditolak
        if ($validated['status'] === 'ditolak') {
            // Simpan ke history sebelum update
            RejectionHistory::create([
                'pendaftar_id' => $pendaftar->id,
                'rejection_reason' => $validated['rejection_reason'],
                'can_resubmit' => $validated['can_resubmit'],
                'rejected_by' => Auth::user()->email ?? 'admin',
                'rejected_at' => now(),
            ]);

            // Update pendaftar dengan data rejection
            $pendaftar->update([
                'status' => 'ditolak',
                'rejection_reason' => $validated['rejection_reason'],
                'can_resubmit' => $validated['can_resubmit'],
                'rejected_at' => now(),
            ]);

            $message = 'Status pendaftar berhasil diupdate menjadi ditolak!';

        } else {
            // Jika status bukan ditolak, clear rejection fields
            $updateData = [
                'status' => $validated['status'],
                'rejection_reason' => null,
                'can_resubmit' => false,
                'rejected_at' => null,
            ];

            $pendaftar->update($updateData);

            $statusText = $validated['status'] === 'pending' ? 'pending' : 'diterima';
            $message = "Status pendaftar berhasil diupdate menjadi {$statusText}!";
        }

        return redirect()->back()->with('success', $message);
    }

    public function destroy(Pendaftar $pendaftar)
    {
        // Hapus semua file dokumen yang diupload
        if ($pendaftar->uploaded_documents && is_array($pendaftar->uploaded_documents)) {
            foreach ($pendaftar->uploaded_documents as $key => $filename) {
                if ($filename) {
                    Storage::delete('public/documents/' . $filename);
                }
            }
        }

        // Hapus juga file legacy jika ada (untuk backward compatibility)
        $legacyFiles = ['file_transkrip', 'file_ktp', 'file_kk'];
        foreach ($legacyFiles as $field) {
            if (isset($pendaftar->{$field}) && $pendaftar->{$field}) {
                Storage::delete('public/documents/' . $pendaftar->{$field});
            }
        }

        $pendaftar->delete();
        return redirect()->route('admin.pendaftar.index')
                        ->with('success', 'Data pendaftar berhasil dihapus!');
    }

    /**
     * Get rejection history untuk pendaftar tertentu (AJAX)
     */
    public function getRejectionHistory(Pendaftar $pendaftar)
    {
        $histories = RejectionHistory::where('pendaftar_id', $pendaftar->id)
                                   ->orderBy('rejected_at', 'desc')
                                   ->get();

        return response()->json([
            'success' => true,
            'data' => $histories->map(function($history) {
                return [
                    'id' => $history->id,
                    'rejection_reason' => $history->rejection_reason,
                    'can_resubmit' => $history->can_resubmit,
                    'rejected_by' => $history->rejected_by,
                    'rejected_at' => $history->rejected_at->format('d M Y H:i'),
                ];
            })
        ]);
    }

    /**
     * Get document summary for a specific pendaftar (AJAX)
     */
    public function getDocumentSummary(Pendaftar $pendaftar)
    {
        $beasiswa = $pendaftar->beasiswa;
        $requiredDocuments = $beasiswa->required_documents ?? [];

        $summary = [
            'total_documents' => count($requiredDocuments),
            'required_documents' => 0,
            'uploaded_documents' => 0,
            'uploaded_required' => 0,
            'documents' => []
        ];

        foreach ($requiredDocuments as $document) {
            $isUploaded = !empty($pendaftar->getDocument($document['key']));

            if ($document['required']) {
                $summary['required_documents']++;
                if ($isUploaded) {
                    $summary['uploaded_required']++;
                }
            }

            if ($isUploaded) {
                $summary['uploaded_documents']++;
            }

            $summary['documents'][] = [
                'key' => $document['key'],
                'name' => $document['name'],
                'required' => $document['required'],
                'uploaded' => $isUploaded,
                'filename' => $pendaftar->getDocument($document['key'])
            ];
        }

        $summary['completion_percentage'] = $summary['required_documents'] > 0
            ? round(($summary['uploaded_required'] / $summary['required_documents']) * 100)
            : 100;

        return response()->json([
            'success' => true,
            'summary' => $summary
        ]);
    }
}
