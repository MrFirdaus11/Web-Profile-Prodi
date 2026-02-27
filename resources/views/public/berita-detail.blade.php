@extends('layouts.public')

@section('title', $berita->judul . ' - Prodi SI UNPARI')

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>{{ $berita->judul }}</h1>
        <p><i class="fas fa-calendar"></i> {{ $berita->tanggal->format('d F Y') }}</p>
    </div>
</section>

<!-- Content -->
<section class="section">
    <div class="container">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">
            <!-- Main Content -->
            <div>
                <div class="card" style="overflow: hidden;">
                    @if($berita->gambar)
                        <img src="{{ asset('assets/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" style="width: 100%; height: 400px; object-fit: cover;">
                    @endif
                    
                    <div style="padding: 40px;">
                        <div style="font-size: 1.1rem; line-height: 1.9; color: var(--gray);">
                            {!! nl2br(e($berita->isi_berita)) !!}
                        </div>
                        
                        <div style="margin-top: 40px; padding-top: 24px; border-top: 1px solid var(--light);">
                            <a href="{{ route('berita') }}" class="btn btn-accent">
                                <i class="fas fa-arrow-left"></i> Kembali ke Berita
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div>
                <div class="card" style="padding: 24px; position: sticky; top: 100px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 20px; color: var(--dark);">
                        Berita Lainnya
                    </h3>
                    
                    @if($beritaLainnya->count() > 0)
                        @foreach($beritaLainnya as $item)
                        <a href="{{ route('berita.show', $item->slug) }}" style="display: block; padding: 16px 0; border-bottom: 1px solid var(--light);">
                            <h4 style="font-size: 1rem; font-weight: 600; color: var(--dark); margin-bottom: 6px; line-height: 1.4;">
                                {{ Str::limit($item->judul, 50) }}
                            </h4>
                            <span style="font-size: 0.85rem; color: var(--gray);">
                                <i class="fas fa-calendar"></i> {{ $item->tanggal->format('d M Y') }}
                            </span>
                        </a>
                        @endforeach
                    @else
                        <p style="color: var(--gray);">Tidak ada berita lainnya.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    @media (max-width: 768px) {
        .section > .container > div {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
