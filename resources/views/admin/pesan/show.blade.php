@extends('layouts.admin')

@section('title', 'Detail Pesan')
@section('header', 'Detail Pesan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Pesan dari {{ $pesan->nama }}</h3>
        <a href="{{ route('admin.kontak.index') }}" class="btn btn-sm" style="background: var(--light);">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 30px;">
            <div>
                <label style="font-weight: 600; color: var(--gray); font-size: 0.85rem; text-transform: uppercase; display: block; margin-bottom: 8px;">Nama Pengirim</label>
                <p style="font-size: 1.1rem; color: var(--dark);">{{ $pesan->nama }}</p>
            </div>
            <div>
                <label style="font-weight: 600; color: var(--gray); font-size: 0.85rem; text-transform: uppercase; display: block; margin-bottom: 8px;">Email</label>
                <p style="font-size: 1.1rem; color: var(--dark);">
                    <a href="mailto:{{ $pesan->email }}" style="color: var(--primary);">{{ $pesan->email }}</a>
                </p>
            </div>
            <div>
                <label style="font-weight: 600; color: var(--gray); font-size: 0.85rem; text-transform: uppercase; display: block; margin-bottom: 8px;">Tanggal</label>
                <p style="font-size: 1.1rem; color: var(--dark);">{{ $pesan->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <label style="font-weight: 600; color: var(--gray); font-size: 0.85rem; text-transform: uppercase; display: block; margin-bottom: 8px;">Status</label>
                <p>
                    @if($pesan->dibaca)
                        <span class="badge badge-success">Sudah Dibaca</span>
                    @else
                        <span class="badge badge-danger">Belum Dibaca</span>
                    @endif
                </p>
            </div>
        </div>
        
        <div style="padding-top: 24px; border-top: 1px solid var(--light);">
            <label style="font-weight: 600; color: var(--gray); font-size: 0.85rem; text-transform: uppercase; display: block; margin-bottom: 12px;">Isi Pesan</label>
            <div style="background: var(--light); padding: 24px; border-radius: 12px; line-height: 1.8; color: var(--dark);">
                {{ $pesan->pesan }}
            </div>
        </div>
        
        <div style="margin-top: 30px; display: flex; gap: 12px;">
            <a href="mailto:{{ $pesan->email }}" class="btn btn-accent">
                <i class="fas fa-reply"></i> Balas via Email
            </a>
            <form action="{{ route('admin.kontak.pesan.destroy', $pesan->id) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete(this)">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
