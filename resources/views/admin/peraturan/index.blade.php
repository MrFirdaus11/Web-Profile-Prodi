@extends('layouts.admin')

@section('title', 'Peraturan - Admin')
@section('header', 'Kelola Peraturan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Daftar Peraturan</h2>
        <a href="{{ route('admin.peraturan.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Peraturan
        </a>
    </div>
    <div class="admin-card-body">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>File</th>
                    <th>Download</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peraturans as $index => $peraturan)
                <tr>
                    <td>{{ $peraturans->firstItem() + $index }}</td>
                    <td>
                        <strong>{{ $peraturan->judul }}</strong>
                        @if($peraturan->deskripsi)
                            <br><small style="color: var(--gray);">{{ Str::limit($peraturan->deskripsi, 50) }}</small>
                        @endif
                    </td>
                    <td>
                        <span class="badge badge-{{ $peraturan->kategori == 'Akademik' ? 'success' : 'warning' }}">
                            {{ $peraturan->kategori }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ asset('assets/files/peraturan/' . $peraturan->file) }}" target="_blank" 
                           style="color: var(--primary);">
                            <i class="fas fa-file-pdf"></i> {{ Str::limit($peraturan->file, 25) }}
                        </a>
                    </td>
                    <td>{{ $peraturan->download_count }}x</td>
                    <td>{{ $peraturan->created_at->format('d M Y') }}</td>
                    <td>
                        <form action="{{ route('admin.peraturan.destroy', $peraturan->id) }}" method="POST" 
                              style="display:inline;" onsubmit="return confirm('Hapus peraturan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px;">
                        <div class="empty-state">
                            <i class="fas fa-gavel empty-state-icon"></i>
                            <h3>Belum ada peraturan</h3>
                            <p>Klik tombol "Tambah Peraturan" untuk menambahkan</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($peraturans->hasPages())
        <div style="margin-top: 20px;">
            {{ $peraturans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
