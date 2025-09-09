@extends('layouts.admin')

@section('title', 'Kelola Pendaftar')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-users"></i> Kelola Pendaftar</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($pendaftars->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama & NIM</th>
                            <th>Beasiswa</th>
                            <th>Fakultas/Jurusan</th>
                            <th>IPK</th>
                            <th>Status</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendaftars as $index => $pendaftar)
                        <tr>
                            <td>{{ $pendaftars->firstItem() + $index }}</td>
                            <td>
                                <strong>{{ $pendaftar->nama_lengkap }}</strong><br>
                                <small class="text-muted">{{ $pendaftar->nim }}</small>
                            </td>
                            <td>
                                <small>{{ $pendaftar->beasiswa->nama_beasiswa }}</small>
                            </td>
                            <td>
                                <small>
                                    {{ $pendaftar->fakultas }}<br>
                                    {{ $pendaftar->jurusan }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $pendaftar->ipk }}</span>
                            </td>
                            <td>
                                @if($pendaftar->status == 'pending')
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @elseif($pendaftar->status == 'diterima')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check"></i> Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times"></i> Ditolak
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $pendaftar->created_at->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pendaftar.show', $pendaftar) }}" 
                                       class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.pendaftar.destroy', $pendaftar) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $pendaftars->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada pendaftar</h5>
                <p class="text-muted">Belum ada mahasiswa yang mendaftar beasiswa</p>
            </div>
        @endif
    </div>
</div>
@endsection