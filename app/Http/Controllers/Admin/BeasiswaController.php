<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beasiswa;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::withCount('pendaftars')->latest()->paginate(10);
        return view('admin.beasiswa.index', compact('beasiswas'));
    }

    public function create()
    {
        return view('admin.beasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah_dana' => 'required|numeric|min:0',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'status' => 'required|in:aktif,nonaktif',
            'persyaratan' => 'required|string',
            'documents' => 'required|array|min:1',
            'documents.*.name' => 'required|string|max:255',
            'documents.*.key' => 'required|string|max:100|regex:/^[a-z0-9_]+$/',
            'documents.*.icon' => 'required|string|max:100',
            'documents.*.color' => 'required|string|in:red,blue,green,yellow,purple,orange,teal,gray',
            'documents.*.formats' => 'required|array|min:1',
            'documents.*.formats.*' => 'string|in:pdf,jpg,jpeg,png,doc,docx',
            'documents.*.max_size' => 'required|integer|min:1|max:10',
            'documents.*.description' => 'nullable|string|max:255',
            'documents.*.required' => 'boolean',
        ], [
            'documents.required' => 'Minimal harus ada 1 dokumen yang diperlukan.',
            'documents.*.name.required' => 'Nama dokumen wajib diisi.',
            'documents.*.key.required' => 'Key dokumen wajib diisi.',
            'documents.*.key.regex' => 'Key hanya boleh berisi huruf kecil, angka, dan underscore.',
            'documents.*.icon.required' => 'Icon dokumen wajib dipilih.',
            'documents.*.color.required' => 'Warna dokumen wajib dipilih.',
            'documents.*.formats.required' => 'Format file wajib dipilih.',
            'documents.*.max_size.required' => 'Ukuran maksimal wajib diisi.',
        ]);

        // Validate unique document keys
        $documentKeys = array_column($validated['documents'], 'key');
        if (count($documentKeys) !== count(array_unique($documentKeys))) {
            return redirect()->back()
                           ->withInput()
                           ->withErrors(['documents' => 'Setiap dokumen harus memiliki key yang unik.']);
        }

        // Process documents data
        $requiredDocuments = [];
        foreach ($validated['documents'] as $index => $document) {
            $requiredDocuments[] = [
                'name' => $document['name'],
                'key' => $document['key'],
                'icon' => $document['icon'],
                'color' => $document['color'],
                'formats' => $document['formats'],
                'max_size' => (int) $document['max_size'],
                'description' => $document['description'] ?? '',
                'required' => isset($document['required']) && $document['required'] == '1',
            ];
        }

        $validated['required_documents'] = $requiredDocuments;
        unset($validated['documents']);

        Beasiswa::create($validated);

        return redirect()->route('admin.beasiswa.index')
                        ->with('success', 'Beasiswa berhasil ditambahkan!');
    }

    public function show(Beasiswa $beasiswa)
    {
        $beasiswa->load('pendaftars');
        return view('admin.beasiswa.show', compact('beasiswa'));
    }

    public function edit(Beasiswa $beasiswa)
    {
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }

    public function update(Request $request, Beasiswa $beasiswa)
    {
        $validated = $request->validate([
            'nama_beasiswa' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah_dana' => 'required|numeric|min:0',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'status' => 'required|in:aktif,nonaktif',
            'persyaratan' => 'required|string',
            'documents' => 'required|array|min:1',
            'documents.*.name' => 'required|string|max:255',
            'documents.*.key' => 'required|string|max:100|regex:/^[a-z0-9_]+$/',
            'documents.*.icon' => 'required|string|max:100',
            'documents.*.color' => 'required|string|in:red,blue,green,yellow,purple,orange,teal,gray',
            'documents.*.formats' => 'required|array|min:1',
            'documents.*.formats.*' => 'string|in:pdf,jpg,jpeg,png,doc,docx',
            'documents.*.max_size' => 'required|integer|min:1|max:10',
            'documents.*.description' => 'nullable|string|max:255',
            'documents.*.required' => 'boolean',
        ]);

        // Validate unique document keys
        $documentKeys = array_column($validated['documents'], 'key');
        if (count($documentKeys) !== count(array_unique($documentKeys))) {
            return redirect()->back()
                           ->withInput()
                           ->withErrors(['documents' => 'Setiap dokumen harus memiliki key yang unik.']);
        }

        // Process documents data
        $requiredDocuments = [];
        foreach ($validated['documents'] as $index => $document) {
            $requiredDocuments[] = [
                'name' => $document['name'],
                'key' => $document['key'],
                'icon' => $document['icon'],
                'color' => $document['color'],
                'formats' => $document['formats'],
                'max_size' => (int) $document['max_size'],
                'description' => $document['description'] ?? '',
                'required' => isset($document['required']) && $document['required'] == '1',
            ];
        }

        $validated['required_documents'] = $requiredDocuments;
        unset($validated['documents']);

        $beasiswa->update($validated);

        return redirect()->route('admin.beasiswa.index')
                        ->with('success', 'Beasiswa berhasil diupdate!');
    }

    public function destroy(Beasiswa $beasiswa)
    {
        $beasiswa->delete();
        return redirect()->route('admin.beasiswa.index')
                        ->with('success', 'Beasiswa berhasil dihapus!');
    }
}
