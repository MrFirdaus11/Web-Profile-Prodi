@extends('layouts.admin')

@section('title', 'Kelola Dokumen')
@section('header', 'Kelola Dokumen')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Daftar Dokumen</h3>
        <a href="{{ route('admin.dokumen.create') }}" class="btn btn-accent">
            <i class="fas fa-plus"></i> Tambah Dokumen
        </a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Dokumen</th>
                    <th style="width: 100px;">Kategori</th>
                    <th>Link</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dokumens as $index => $dokumen)
                <tr>
                    <td>{{ $dokumens->firstItem() + $index }}</td>
                    <td>
                        <strong>{{ $dokumen->nama_dokumen }}</strong>
                        <br><small style="color: var(--gray);">{{ $dokumen->tgl_upload->format('d M Y') }}</small>
                    </td>
                    <td>
                        @if($dokumen->kategori == 'Akademik')
                            <span class="badge badge-success">Akademik</span>
                        @elseif($dokumen->kategori == 'Skripsi')
                            <span class="badge badge-warning">Skripsi</span>
                        @else
                            <span class="badge" style="background: rgba(59, 130, 246, 0.1); color: var(--info);">Jadwal</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $dokumen->url }}" target="_blank" style="color: var(--primary);">
                            <i class="fas fa-external-link-alt"></i> {{ Str::limit($dokumen->url, 35) }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(this)">
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
                    <td colspan="5" style="text-align: center; padding: 40px; color: var(--gray);">
                        Belum ada dokumen. <a href="{{ route('admin.dokumen.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="pagination">
    {{ $dokumens->links() }}
</div>
@endsection
