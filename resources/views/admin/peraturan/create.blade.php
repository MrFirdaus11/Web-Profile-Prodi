@extends('layouts.admin')

@section('title', 'Tambah Peraturan - Admin')
@section('header', 'Tambah Peraturan')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Form Tambah Peraturan</h2>
        <a href="{{ route('admin.peraturan.index') }}" class="btn btn-sm btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.peraturan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Judul Peraturan <span style="color: var(--danger);">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul') }}" placeholder="Contoh: Pedoman Akademik 2024" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Kategori <span style="color: var(--danger);">*</span></label>
                <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Akademik" {{ old('kategori') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Kemahasiswaan" {{ old('kategori') == 'Kemahasiswaan' ? 'selected' : '' }}>Kemahasiswaan</option>
                    <option value="Skripsi" {{ old('kategori') == 'Skripsi' ? 'selected' : '' }}>Skripsi</option>
                    <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum</option>
                </select>
                @error('kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">File PDF <span style="color: var(--danger);">*</span></label>
                <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" 
                       accept=".pdf" required>
                <small style="color: var(--gray);">Format: PDF. Maksimal 10MB.</small>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                          rows="3" placeholder="Deskripsi singkat tentang peraturan ini">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.peraturan.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
