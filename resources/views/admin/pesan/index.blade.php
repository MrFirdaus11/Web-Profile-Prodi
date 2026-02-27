@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('header', 'Pesan Masuk')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Daftar Pesan</h3>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Pengirim</th>
                    <th>Pesan</th>
                    <th style="width: 150px;">Tanggal</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesans as $index => $pesan)
                <tr>
                    <td>{{ $pesans->firstItem() + $index }}</td>
                    <td>
                        <strong>{{ $pesan->nama }}</strong>
                        <br><small style="color: var(--gray);">{{ $pesan->email }}</small>
                    </td>
                    <td>{{ Str::limit($pesan->pesan, 60) }}</td>
                    <td>{{ $pesan->created_at->format('d M Y H:i') }}</td>
                    <td>
                        @if(!$pesan->dibaca)
                            <span class="badge badge-danger">Belum Dibaca</span>
                        @else
                            <span class="badge badge-success">Dibaca</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="btn btn-sm btn-accent">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(this)">
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
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--gray);">
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div class="pagination">
    {{ $pesans->links() }}
</div>
@endsection
