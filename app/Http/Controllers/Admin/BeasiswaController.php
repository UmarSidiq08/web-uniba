<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beasiswa;

class BeasiswaController extends Controller
{
    public function index()
    {
        $beasiswas = Beasiswa::latest()->paginate(10);
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
            'persyaratan' => 'required|string'
        ]);

        Beasiswa::create($validated);

        return redirect()->route('admin.beasiswa.index')
                        ->with('success', 'Beasiswa berhasil ditambahkan!');
    }

    public function show(Beasiswa $beasiswa)
    {
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
            'persyaratan' => 'required|string'
        ]);

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