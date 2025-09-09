<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::where('status', 'aktif')
                            ->where('tanggal_tutup', '>=', now())
                            ->latest()
                            ->get();

        $userApplications = collect();
        $activeUserApplication = null;
        $userApplication = null;
        $registeredBeasiswa = null;

        if (Auth::check()) {
            $userApplications = Pendaftar::where('email', Auth::user()->email)
                                       ->get()
                                       ->keyBy('beasiswa_id');
            $activeUserApplication = Pendaftar::where('email', Auth::user()->email)
                                            ->whereIn('status', ['pending', 'diterima'])
                                            ->orderBy('created_at', 'desc')
                                            ->first();
            $userApplication = $activeUserApplication;

            if ($activeUserApplication) {
                $registeredBeasiswa = Beasiswa::find($activeUserApplication->beasiswa_id);
            }
        }
        return view('home', compact('beasiswas', 'userApplications', 'activeUserApplication', 'userApplication', 'registeredBeasiswa'));
    }

    public function persyaratan()
    {
        return view('persyaratan');
    }

    public function checkStatus()
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                           ->with('error', 'Silakan login untuk melihat status.');
        }

        $userApplication = Pendaftar::where('email', Auth::user()->email)
                                  ->with('beasiswa')
                                  ->orderBy('created_at', 'desc')
                                  ->first();

        if (!$userApplication) {
            return redirect()->route('home')
                           ->with('error', 'Anda belum mendaftar beasiswa apapun.');
        }
        $allApplications = Pendaftar::where('email', Auth::user()->email)
                                  ->with('beasiswa')
                                  ->orderBy('created_at', 'desc')
                                  ->get();

        return view('status', compact('userApplication', 'allApplications'));
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

    public function editForResubmit(Pendaftar $pendaftar)
    {
        if (!Auth::check() || $pendaftar->email !== Auth::user()->email) {
            abort(403, 'Unauthorized action.');
        }

        if (!$pendaftar->canResubmit()) {
            return redirect()->route('status')
                           ->with('error', 'Beasiswa ini tidak dapat diajukan kembali.');
        }

        if (!$pendaftar->beasiswa->isActive()) {
            return redirect()->route('status')
                           ->with('error', 'Beasiswa sudah tidak aktif.');
        }
        return view('pendaftaran.resubmit', compact('pendaftar'));
    }

    public function resubmit(Request $request, Pendaftar $pendaftar)
    {
        if (!Auth::check() || $pendaftar->email !== Auth::user()->email) {
            abort(403, 'Unauthorized action.');
        }
        if (!$pendaftar->canResubmit()) {
            return redirect()->route('status')
                           ->with('error', 'Beasiswa ini tidak dapat diajukan kembali.');
        }
        if (!$pendaftar->beasiswa->isActive()) {
            return redirect()->route('status')
                           ->with('error', 'Beasiswa sudah tidak aktif.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => [
                'required',
                'string',
                'max:20',
            ],
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'alasan_mendaftar' => 'required|string',
            'file_transkrip' => 'nullable|file|mimes:pdf|max:5048',
            'file_ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'file_kk' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5048',
        ]);

        if ($validated['email'] !== Auth::user()->email) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Email harus sama dengan email akun Anda.');
        }
        $fileUpdates = [];

        if ($request->hasFile('file_transkrip')) {
            // Hapus file lama
            if ($pendaftar->file_transkrip) {
                Storage::delete('public/documents/' . $pendaftar->file_transkrip);
            }
            $transkripName = time() . '_transkrip_' . $request->file('file_transkrip')->getClientOriginalName();
            $request->file('file_transkrip')->storeAs('public/documents', $transkripName);
            $fileUpdates['file_transkrip'] = $transkripName;
        }

        if ($request->hasFile('file_ktp')) {
            if ($pendaftar->file_ktp) {
                Storage::delete('public/documents/' . $pendaftar->file_ktp);
            }
            $ktpName = time() . '_ktp_' . $request->file('file_ktp')->getClientOriginalName();
            $request->file('file_ktp')->storeAs('public/documents', $ktpName);
            $fileUpdates['file_ktp'] = $ktpName;
        }

        if ($request->hasFile('file_kk')) {
            if ($pendaftar->file_kk) {
                Storage::delete('public/documents/' . $pendaftar->file_kk);
            }
            $kkName = time() . '_kk_' . $request->file('file_kk')->getClientOriginalName();
            $request->file('file_kk')->storeAs('public/documents', $kkName);
            $fileUpdates['file_kk'] = $kkName;
        }

        // Update pendaftar - reset status dan clear rejection data
        $updateData = array_merge($validated, $fileUpdates, [
            'status' => 'pending',
            'rejection_reason' => null,
            'can_resubmit' => false,
            'rejected_at' => null,
        ]);

        $pendaftar->update($updateData);

        return redirect()->route('status')
                        ->with('success', 'Beasiswa berhasil diajukan kembali! Status Anda sekarang pending untuk review.');
    }
}
