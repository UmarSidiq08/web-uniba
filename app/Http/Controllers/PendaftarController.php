<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beasiswa;
use App\Models\Pendaftar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PendaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Wajib login
    }

    public function create(Beasiswa $beasiswa)
    {
        if (!$beasiswa->isActive()) {
            return redirect()->route('home')
                           ->with('error', 'Pendaftaran beasiswa sudah ditutup atau tidak aktif.');
        }

        // Cek berdasarkan email user yang login - hanya cek yang statusnya pending atau diterima
        $existingApplication = Pendaftar::where('email', Auth::user()->email)
                                      ->whereIn('status', ['pending', 'diterima'])
                                      ->first();

        if ($existingApplication) {
            $beasiswaTerdaftar = Beasiswa::find($existingApplication->beasiswa_id);
            $statusText = $existingApplication->status == 'pending' ? 'sedang menunggu verifikasi' : 'telah diterima';

            return redirect()->route('home')
                           ->with('error', 'Anda sudah terdaftar di beasiswa "' . $beasiswaTerdaftar->nama_beasiswa . '" dan ' . $statusText . '.');
        }

        return view('pendaftaran.create', compact('beasiswa'));
    }

    public function store(Request $request, Beasiswa $beasiswa)
    {
        if (!$beasiswa->isActive()) {
            return redirect()->route('home')
                           ->with('error', 'Pendaftaran beasiswa sudah ditutup atau tidak aktif.');
        }

        // Updated validation rules untuk handle resubmit scenario
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pendaftars', 'nim')->where(function ($query) {
                    return $query->whereIn('status', ['pending', 'diterima'])
                                 ->where('email', '!=', Auth::user()->email);
                })
            ],
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'alasan_mendaftar' => 'required|string',
            'file_transkrip' => 'required|file|mimes:pdf|max:5048',
            'file_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
            'file_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5048',
        ], [
            // Custom error messages
            'nim.unique' => 'NIM ini sedang digunakan oleh pendaftar lain dalam beasiswa yang masih aktif.',
        ]);

        // Pastikan email sama dengan email user yang login
        if ($validated['email'] !== Auth::user()->email) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Email harus sama dengan email akun Anda.');
        }

        // Double check - hanya cek yang statusnya pending atau diterima (berdasarkan email)
        $existingApplicationByEmail = Pendaftar::where('email', Auth::user()->email)
                                              ->whereIn('status', ['pending', 'diterima'])
                                              ->first();

        if ($existingApplicationByEmail) {
            return redirect()->route('home')
                           ->with('error', 'Anda masih memiliki beasiswa yang aktif.');
        }

        // Upload files
        $transkripName = time() . '_transkrip_' . $request->file('file_transkrip')->getClientOriginalName();
        $ktpName = time() . '_ktp_' . $request->file('file_ktp')->getClientOriginalName();
        $kkName = time() . '_kk_' . $request->file('file_kk')->getClientOriginalName();

        $request->file('file_transkrip')->storeAs('public/documents', $transkripName);
        $request->file('file_ktp')->storeAs('public/documents', $ktpName);
        $request->file('file_kk')->storeAs('public/documents', $kkName);

        $validated['beasiswa_id'] = $beasiswa->id;
        $validated['file_transkrip'] = $transkripName;
        $validated['file_ktp'] = $ktpName;
        $validated['file_kk'] = $kkName;
        $validated['status'] = 'pending'; // Set status default

        Pendaftar::create($validated);

        return redirect()->route('home')
                        ->with('success', 'Pendaftaran beasiswa berhasil!');
    }

    /**
     * Method untuk cek status NIM (updated untuk handle resubmit)
     */
    public function checkNIMStatus($nim)
    {
        $applications = Pendaftar::where('nim', $nim)
                                ->with('beasiswa')
                                ->orderBy('created_at', 'desc')
                                ->get();

        $activeApplication = $applications->whereIn('status', ['pending', 'diterima'])->first();
        $rejectedApplications = $applications->where('status', 'ditolak');
        $resubmittableApplications = $rejectedApplications->where('can_resubmit', true);

        return response()->json([
            'nim' => $nim,
            'has_active_application' => !is_null($activeApplication),
            'active_application' => $activeApplication,
            'total_applications' => $applications->count(),
            'rejected_applications_count' => $rejectedApplications->count(),
            'resubmittable_applications_count' => $resubmittableApplications->count(),
            'can_apply_new' => is_null($activeApplication),
            'has_resubmittable' => $resubmittableApplications->isNotEmpty(), 
        ]);
    }
}
