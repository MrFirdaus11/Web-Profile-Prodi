@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Berita</span>
            <div class="stat-card-icon bg-primary">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $totalBerita }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Dokumen</span>
            <div class="stat-card-icon bg-success">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $totalDokumen }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Total Pesan</span>
            <div class="stat-card-icon bg-warning">
                <i class="fas fa-envelope"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $totalPesan }}</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-card-header">
            <span class="stat-card-title">Pesan Belum Dibaca</span>
            <div class="stat-card-icon bg-info">
                <i class="fas fa-envelope-open"></i>
            </div>
        </div>
        <div class="stat-card-value">{{ $pesanBelumDibaca }}</div>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
    <!-- Recent News -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Berita Terbaru</h3>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-sm btn-accent">Lihat Semua</a>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            <table class="admin-table">
                <tbody>
                    @forelse($beritaTerbaru as $berita)
                    <tr>
                        <td>
                            <strong>{{ Str::limit($berita->judul, 40) }}</strong>
                            <br>
                            <small style="color: var(--gray);">{{ $berita->tanggal->format('d M Y') }}</small>
                        </td>
                        <td style="text-align: right;">
                            @if($berita->status == 'Published')
                                <span class="badge badge-success">Published</span>
                            @else
                                <span class="badge badge-warning">Draft</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align: center; color: var(--gray);">Belum ada berita.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Recent Messages -->
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Pesan Terbaru</h3>
            <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm btn-accent">Lihat Semua</a>
        </div>
        <div class="admin-card-body" style="padding: 0;">
            <table class="admin-table">
                <tbody>
                    @forelse($pesanTerbaru as $pesan)
                    <tr>
                        <td>
                            <strong>{{ $pesan->nama }}</strong>
                            <br>
                            <small style="color: var(--gray);">{{ Str::limit($pesan->pesan, 50) }}</small>
                        </td>
                        <td style="text-align: right;">
                            @if(!$pesan->dibaca)
                                <span class="badge badge-danger">Baru</span>
                            @else
                                <span class="badge badge-success">Dibaca</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align: center; color: var(--gray);">Belum ada pesan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
