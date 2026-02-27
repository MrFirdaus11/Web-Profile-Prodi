@extends('layouts.admin')

@section('title', 'Edit Dokumen')
@section('header', 'Edit Dokumen')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Form Edit Dokumen</h3>
        <a href="{{ route('admin.dokumen.index') }}" class="btn btn-sm" style="background: var(--light);">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label" for="nama_dokumen">Nama Dokumen <span style="color: var(--danger);">*</span></label>
                <input type="text" 
                       name="nama_dokumen" 
                       id="nama_dokumen" 
                       class="form-control @error('nama_dokumen') is-invalid @enderror" 
                       value="{{ old('nama_dokumen', $dokumen->nama_dokumen) }}"
                       required>
                @error('nama_dokumen')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label" for="kategori">Kategori <span style="color: var(--danger);">*</span></label>
                    <select name="kategori" id="kategori" class="form-control" required>
                        <option value="Akademik" {{ old('kategori', $dokumen->kategori) == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Skripsi" {{ old('kategori', $dokumen->kategori) == 'Skripsi' ? 'selected' : '' }}>Skripsi</option>
                        <option value="Jadwal" {{ old('kategori', $dokumen->kategori) == 'Jadwal' ? 'selected' : '' }}>Jadwal</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="url">Link Google Drive <span style="color: var(--danger);">*</span></label>
                    <input type="url" 
                           name="url" 
                           id="url" 
                           class="form-control @error('url') is-invalid @enderror" 
                           value="{{ old('url', $dokumen->url) }}"
                           placeholder="https://drive.google.com/file/d/..."
                           required>
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div style="padding-top: 20px; border-top: 1px solid var(--light);">
                <button type="submit" class="btn btn-accent">
                    <i class="fas fa-save"></i> Update Dokumen
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
