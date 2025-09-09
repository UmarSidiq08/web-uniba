<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftar;
use App\Models\Beasiswa;

class PendaftarController extends Controller
{
    public function index()
    {
        $pendaftars = Pendaftar::with('beasiswa')->latest()->paginate(10);
        return view('admin.pendaftaran.index', compact('pendaftars'));
    }

    public function show(Pendaftar $pendaftar)
    {
        return view('admin.pendaftaran.show', compact('pendaftar'));
    }

    public function updateStatus(Request $request, Pendaftar $pendaftar)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,diterima,ditolak'
        ]);

        $pendaftar->update($validated);

        return redirect()->back()
                        ->with('success', 'Status pendaftar berhasil diupdate!');
    }

    public function destroy(Pendaftar $pendaftar)
    {
        // Hapus file jika ada
        if ($pendaftar->file_transkrip) {
            \Storage::delete('public/documents/' . $pendaftar->file_transkrip);
        }
        if ($pendaftar->file_ktp) {
            \Storage::delete('public/documents/' . $pendaftar->file_ktp);
        }
        if ($pendaftar->file_kk) {
            \Storage::delete('public/documents/' . $pendaftar->file_kk);
        }

        $pendaftar->delete();
        return redirect()->route('admin.pendaftar.index')
                        ->with('success', 'Data pendaftar berhasil dihapus!');
    }
}
