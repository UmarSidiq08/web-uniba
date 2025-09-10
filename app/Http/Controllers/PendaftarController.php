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

        // Base validation rules
        $rules = [
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
            'fakultas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'semester' => 'required|integer|min:1|max:14',
            'ipk' => 'required|numeric|min:0|max:4',
            'alasan_mendaftar' => 'required|string',
        ];

        // Add dynamic document validation rules
        $documentRules = $beasiswa->getDocumentValidationRules();
        $rules = array_merge($rules, $documentRules);

        // Custom error messages
        $messages = [
            'nim.unique' => 'NIM ini sedang digunakan oleh pendaftar lain dalam beasiswa yang masih aktif.',
        ];

        // Add dynamic document validation messages
        $documentMessages = $beasiswa->getDocumentValidationMessages();
        $messages = array_merge($messages, $documentMessages);

        $validated = $request->validate($rules, $messages);

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

        // Upload and store documents
        $uploadedDocuments = [];
        foreach ($beasiswa->required_documents as $document) {
            $key = $document['key'];

            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $fileName = time() . '_' . $key . '_' . $file->getClientOriginalName();
                $file->storeAs('public/documents', $fileName);
                $uploadedDocuments[$key] = $fileName;
            }
        }

        // Create pendaftar record
        $pendaftarData = [
            'beasiswa_id' => $beasiswa->id,
            'nama_lengkap' => $validated['nama_lengkap'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'fakultas' => $validated['fakultas'],
            'jurusan' => $validated['jurusan'],
            'semester' => $validated['semester'],
            'ipk' => $validated['ipk'],
            'alasan_mendaftar' => $validated['alasan_mendaftar'],
            'uploaded_documents' => $uploadedDocuments,
            'status' => 'pending',
        ];

        Pendaftar::create($pendaftarData);

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
