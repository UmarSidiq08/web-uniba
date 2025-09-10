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

        // Base validation rules - same as before
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:15',
            'alasan_mendaftar' => 'required|string',
        ];

        // Add academic fields if they exist in the pendaftar
        if (isset($pendaftar->fakultas)) {
            $rules = array_merge($rules, [
                'fakultas' => 'required|string|max:255',
                'jurusan' => 'required|string|max:255',
                'semester' => 'required|integer|min:1|max:14',
                'ipk' => 'required|numeric|min:0|max:4',
            ]);
        }

        // Dynamic document validation - differentiate between required and optional
        $documentRules = [];
        if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents)) {
            foreach ($pendaftar->beasiswa->required_documents as $document) {
                $key = $document['key'];
                $acceptedFormats = implode(',', $document['formats']);
                $maxSize = $document['max_size'] * 1024; // Convert MB to KB

                // Check if user already has this document uploaded
                $hasExistingFile = $pendaftar->getDocument($key);

                // For resubmit: if document is required but user already has it, make it optional
                // If document is required and user doesn't have it, still make it required
                if ($document['required'] && !$hasExistingFile) {
                    $documentRules[$key] = "required|file|mimes:{$acceptedFormats}|max:{$maxSize}";
                } else {
                    // Optional if: 1) originally optional, or 2) required but user already has it
                    $documentRules[$key] = "nullable|file|mimes:{$acceptedFormats}|max:{$maxSize}";
                }
            }
        }

        $rules = array_merge($rules, $documentRules);

        // Custom error messages
        $messages = [];
        if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents)) {
            foreach ($pendaftar->beasiswa->required_documents as $document) {
                $key = $document['key'];
                $formatText = strtoupper(implode(', ', $document['formats']));

                $messages["{$key}.required"] = "File {$document['name']} wajib diupload karena belum ada file sebelumnya";
                $messages["{$key}.mimes"] = "File {$document['name']} harus berformat {$formatText}";
                $messages["{$key}.max"] = "File {$document['name']} maksimal {$document['max_size']}MB";
                $messages["{$key}.file"] = "File {$document['name']} harus berupa file yang valid";
            }
        }

        $validated = $request->validate($rules, $messages);

        if ($validated['email'] !== Auth::user()->email) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Email harus sama dengan email akun Anda.');
        }

        // Handle dynamic document uploads - preserve existing files
        $uploadedDocuments = $pendaftar->uploaded_documents ?? [];

        if ($pendaftar->beasiswa->required_documents && is_array($pendaftar->beasiswa->required_documents)) {
            foreach ($pendaftar->beasiswa->required_documents as $document) {
                $key = $document['key'];

                if ($request->hasFile($key)) {
                    // Delete old file if exists
                    $oldFile = $pendaftar->getDocument($key);
                    if ($oldFile && Storage::exists('public/documents/' . $oldFile)) {
                        Storage::delete('public/documents/' . $oldFile);
                    }

                    // Upload new file
                    $file = $request->file($key);
                    $fileName = time() . '_' . $key . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/documents', $fileName);
                    $uploadedDocuments[$key] = $fileName;
                }
                // If no new file uploaded, keep the existing file (don't modify $uploadedDocuments[$key])
            }
        }

        // Prepare update data
        $updateData = [
            'nama_lengkap' => $validated['nama_lengkap'],
            'nim' => $validated['nim'],
            'no_hp' => $validated['no_hp'],
            'alasan_mendaftar' => $validated['alasan_mendaftar'],
            'uploaded_documents' => $uploadedDocuments,
            'status' => 'pending',
            'rejection_reason' => null,
            'can_resubmit' => false,
            'rejected_at' => null,
        ];

        // Add academic fields if they exist
        if (isset($pendaftar->fakultas)) {
            $updateData = array_merge($updateData, [
                'fakultas' => $validated['fakultas'],
                'jurusan' => $validated['jurusan'],
                'semester' => $validated['semester'],
                'ipk' => $validated['ipk'],
            ]);
        }

        // Update pendaftar
        $pendaftar->update($updateData);

        return redirect()->route('status')
            ->with('success', 'Beasiswa berhasil diajukan kembali! Status Anda sekarang pending untuk review.');
    }
}
