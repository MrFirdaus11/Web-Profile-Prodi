@extends('layouts.admin')

@section('title', 'Edit Dosen - Admin')
@section('header', 'Edit Dosen')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Form Edit Dosen</h2>
        <a href="{{ route('admin.profile-prodi.index') }}" class="btn btn-sm btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.profile-prodi.dosen.update', $dosen->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @if($dosen->foto)
            <div class="form-group" style="margin-bottom: 20px;">
                <label class="form-label">Foto Saat Ini</label>
                <div>
                    <img src="{{ asset('assets/img/dosen/' . $dosen->foto) }}" alt="{{ $dosen->nama }}" 
                         style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid var(--light);">
                </div>
            </div>
            @endif
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                           value="{{ old('nama', $dosen->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">NIDN</label>
                    <input type="text" name="nidn" class="form-control @error('nidn') is-invalid @enderror" 
                           value="{{ old('nidn', $dosen->nidn) }}">
                    @error('nidn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Jabatan <span style="color: var(--danger);">*</span></label>
                    <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" 
                           value="{{ old('jabatan', $dosen->jabatan) }}" required>
                    @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label">Pendidikan Terakhir</label>
                    <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" 
                           value="{{ old('pendidikan', $dosen->pendidikan) }}">
                    @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Bidang Keahlian</label>
                <input type="text" name="bidang_keahlian" class="form-control @error('bidang_keahlian') is-invalid @enderror" 
                       value="{{ old('bidang_keahlian', $dosen->bidang_keahlian) }}">
                @error('bidang_keahlian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email', $dosen->email) }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Ganti Foto</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                <small style="color: var(--gray);">Kosongkan jika tidak ingin mengganti foto</small>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('admin.profile-prodi.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
