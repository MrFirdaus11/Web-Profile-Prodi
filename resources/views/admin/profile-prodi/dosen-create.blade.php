@extends('layouts.admin')

@section('title', 'Tambah Dosen - Admin')
@section('header', 'Tambah Dosen')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Form Tambah Dosen</h2>
        <a href="{{ route('admin.profile-prodi.index') }}" class="btn btn-sm btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.profile-prodi.dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama') }}" placeholder="Dr. Nama Lengkap, M.Kom" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">NIDN</label>
                    <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" 
                           value="{{ old('nidn') }}" placeholder="0123456789">
                    @error('nidn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Jabatan <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                           value="{{ old('jabatan') }}" placeholder="Ketua Program Studi / Dosen Tetap" required>
                    @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" 
                           value="{{ old('pendidikan') }}" placeholder="S3 Ilmu Komputer">
                    @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Bidang Keahlian</label>
                <input type="text" name="bidang_keahlian" class="form-control @error('bidang_keahlian') is-invalid @enderror" 
                       value="{{ old('bidang_keahlian') }}" placeholder="Sistem Informasi, Data Mining, Web Development">
                @error('bidang_keahlian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" placeholder="nama@unpari.ac.id">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Foto</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                <small style="color: var(--gray);">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.profile-prodi.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
