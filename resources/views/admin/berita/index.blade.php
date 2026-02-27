@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('header', 'Kelola Berita')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Daftar Berita</h3>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-accent">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Judul</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th style="width: 100px;">Status</th>
                    <th style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($beritas as $index => $berita)
                <tr>
                    <td>{{ $beritas->firstItem() + $index }}</td>
                    <td>
                        <strong>{{ $berita->judul }}</strong>
                        @if($berita->gambar)
                            <br><small style="color: var(--gray);"><i class="fas fa-image"></i> Ada gambar</small>
                        @endif
                    </td>
                    <td>{{ $berita->tanggal->format('d M Y') }}</td>
                    <td>
                        @if($berita->status == 'Published')
                            <span class="badge badge-success">Published</span>
                        @else
                            <span class="badge badge-warning">Draft</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="btn btn-sm btn-accent">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(this)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: var(--gray);">
                        Belum ada berita. <a href="{{ route('admin.berita.create') }}">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="pagination">
    {{ $beritas->links() }}
</div>
@endsection
