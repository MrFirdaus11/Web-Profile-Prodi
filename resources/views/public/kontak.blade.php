@extends('layouts.public')

@section('title', 'Kontak - Prodi SI UNPARI')

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Hubungi Kami</h1>
        <p>Silakan hubungi kami untuk informasi lebih lanjut</p>
    </div>
</section>

<!-- Content -->
<section class="section">
    <div class="container">
        <div class="grid-2">
            <!-- Contact Info -->
            <div>
                <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 24px; color: var(--dark);">
                    Informasi Kontak
                </h2>
                
                <div class="card" style="padding: 32px; margin-bottom: 24px;">
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 56px; height: 56px; background: rgba(99, 102, 241, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--primary);"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; color: var(--dark);">Alamat</h3>
                            <p style="color: var(--gray); line-height: 1.7;">{{ $alamat }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="padding: 32px; margin-bottom: 24px;">
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 56px; height: 56px; background: rgba(99, 102, 241, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-phone" style="font-size: 1.5rem; color: var(--primary);"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; color: var(--dark);">Telepon</h3>
                            <p style="color: var(--gray); line-height: 1.7;">{{ $telepon }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="padding: 32px;">
                    <div style="display: flex; gap: 20px; align-items: flex-start;">
                        <div style="width: 56px; height: 56px; background: rgba(99, 102, 241, 0.1); border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-envelope" style="font-size: 1.5rem; color: var(--primary);"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 8px; color: var(--dark);">Email</h3>
                            <p style="color: var(--gray); line-height: 1.7;">{{ $email }}</p>
                        </div>
                    </div>
                </div>
                
                @if($links->count() > 0)
                <div class="card" style="padding: 32px; margin-top: 24px;">
                    <h3 style="font-size: 1.2rem; font-weight: 700; margin-bottom: 16px; color: var(--dark);">
                        <i class="fas fa-link" style="color: var(--primary); margin-right: 8px;"></i> Link Penting
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($links as $link)
                        <li style="padding: 10px 0; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; gap: 10px;">
                            <i class="fas fa-external-link-alt" style="color: var(--primary); font-size: 0.85rem;"></i>
                            <a href="{{ $link->url }}" target="_blank" style="color: var(--primary); text-decoration: none;">{{ $link->judul }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            
            <!-- Contact Form -->
            <div>
                <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 24px; color: var(--dark);">
                    Kirim Pesan
                </h2>
                
                <div class="card" style="padding: 40px;">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('kontak.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label" for="nama">Nama Lengkap</label>
                            <input type="text" 
                                   name="nama" 
                                   id="nama" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}"
                                   placeholder="Masukkan alamat email Anda"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="pesan">Pesan</label>
                            <textarea name="pesan" 
                                      id="pesan" 
                                      class="form-control @error('pesan') is-invalid @enderror" 
                                      placeholder="Tulis pesan Anda di sini..."
                                      required>{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-accent" style="width: 100%;">
                            <i class="fas fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
