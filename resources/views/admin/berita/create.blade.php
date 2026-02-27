@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('header', 'Tambah Berita Baru')

@section('content')
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Form Tambah Berita</h3>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-sm" style="background: var(--light);">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="admin-card-body">
        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="judul">Judul Berita</label>
                <input type="text" 
                       name="judul" 
                       id="judul" 
                       class="form-control @error('judul') is-invalid @enderror" 
                       value="{{ old('judul') }}"
                       placeholder="Masukkan judul berita"
                       required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label" for="isi_berita">Isi Berita</label>
                <textarea name="isi_berita" 
                          id="isi_berita" 
                          class="form-control @error('isi_berita') is-invalid @enderror" 
                          rows="10"
                          placeholder="Tulis isi berita di sini..."
                          required>{{ old('isi_berita') }}</textarea>
                @error('isi_berita')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label" for="gambar">Gambar (Opsional)</label>
                    <input type="file" 
                           name="gambar" 
                           id="gambar" 
                           class="form-control @error('gambar') is-invalid @enderror"
                           accept="image/jpeg,image/jpg,image/png">
                    <small style="color: var(--gray);">Format: JPG, JPEG, PNG. Maks: 2MB</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>
            
            <div style="padding-top: 20px; border-top: 1px solid var(--light);">
                <button type="submit" class="btn btn-accent">
                    <i class="fas fa-save"></i> Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
