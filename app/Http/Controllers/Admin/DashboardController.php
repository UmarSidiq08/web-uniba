<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beasiswa;
use App\Models\Pendaftar;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBeasiswa = Beasiswa::count();
        $beasiswaAktif = Beasiswa::where('status', 'aktif')->count();
        $totalPendaftar = Pendaftar::count();
        $pendaftarPending = Pendaftar::where('status', 'pending')->count();
        $pendaftarDiterima = Pendaftar::where('status', 'diterima')->count();
        $pendaftarDitolak = Pendaftar::where('status', 'ditolak')->count();

        return view('admin.dashboard', compact(
            'totalBeasiswa',
            'beasiswaAktif',
            'totalPendaftar',
            'pendaftarPending',
            'pendaftarDiterima',
            'pendaftarDitolak'
        ));
    }
}