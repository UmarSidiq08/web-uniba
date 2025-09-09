<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;
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

        $userApplication = null;
        $registeredBeasiswa = null;

        // Cek jika user login
        if (Auth::check()) {
            // Hanya ambil aplikasi yang statusnya pending atau diterima
            $userApplication = Pendaftar::where('email', Auth::user()->email)
                                      ->whereIn('status', ['pending', 'diterima'])
                                      ->first();

            if ($userApplication) {
                $registeredBeasiswa = Beasiswa::find($userApplication->beasiswa_id);
            }
        }

        return view('home', compact('beasiswas', 'userApplication', 'registeredBeasiswa'));
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

        // Ambil aplikasi terbaru dari user (termasuk yang ditolak)
        $userApplication = Pendaftar::where('email', Auth::user()->email)
                                  ->with('beasiswa')
                                  ->orderBy('created_at', 'desc')
                                  ->first();

        if (!$userApplication) {
            return redirect()->route('home')
                           ->with('error', 'Anda belum mendaftar beasiswa apapun.');
        }

        // Jika ingin menampilkan semua aplikasi user (opsional)
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
}
