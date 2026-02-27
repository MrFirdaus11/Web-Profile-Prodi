@extends('layouts.admin')

@section('title', 'Tambah Program Kelas - Admin')
@section('header', 'Tambah Program Kelas')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Form Tambah Program Kelas</h2>
        <a href="{{ route('admin.profile-prodi.index') }}" class="btn btn-sm btn-outline">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.profile-prodi.program.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Nama Program <span style="color: var(--danger);">*</span></label>
                <select name="nama" class="form-control @error('nama') is-invalid @enderror" required>
                    <option value="">-- Pilih Program --</option>
                    <option value="Kelas Reguler Pagi" {{ old('nama') == 'Kelas Reguler Pagi' ? 'selected' : '' }}>Kelas Reguler Pagi</option>
                    <option value="Kelas Reguler Siang" {{ old('nama') == 'Kelas Reguler Siang' ? 'selected' : '' }}>Kelas Reguler Siang</option>
                    <option value="Kelas Reguler Malam" {{ old('nama') == 'Kelas Reguler Malam' ? 'selected' : '' }}>Kelas Reguler Malam</option>
                    <option value="Kelas Karyawan" {{ old('nama') == 'Kelas Karyawan' ? 'selected' : '' }}>Kelas Karyawan</option>
                </select>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Icon (Font Awesome) <span style="color: var(--danger);">*</span></label>
                <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" 
                       value="{{ old('icon', 'fa-graduation-cap') }}" placeholder="Contoh: fa-sun, fa-cloud-sun, fa-moon, fa-briefcase" required>
                <small style="color: var(--gray);">Gunakan class Font Awesome tanpa prefix "fas". Contoh: fa-sun (pagi), fa-cloud-sun (siang), fa-moon (malam), fa-briefcase (karyawan)</small>
                @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi <span style="color: var(--danger);">*</span></label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                          rows="3" required>{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Jadwal <span style="color: var(--danger);">*</span></label>
                <input type="text" name="jadwal" class="form-control @error('jadwal') is-invalid @enderror" 
                       value="{{ old('jadwal') }}" placeholder="Contoh: Senin - Jumat (07.00 - 12.00)" required>
                <small style="color: var(--gray);">Pagi: 07.00 - 12.00 | Siang: 12.00 - 18.00</small>
                @error('jadwal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Fitur (satu per baris)</label>
                <textarea name="fitur" class="form-control" rows="4" 
                          placeholder="Tatap muka langsung&#10;Akses lab komputer&#10;Kegiatan kemahasiswaan">{{ old('fitur') }}</textarea>
                <small style="color: var(--gray);">Tulis satu fitur per baris</small>
            </div>
            
            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', true) ? 'checked' : '' }}>
                    <span>Aktif</span>
                </label>
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
