@extends('layouts.public')

@section('title', 'Kegiatan - Prodi SI UNPARI')

@section('content')
<style>
    .kegiatan-page {
        padding: 60px 0 80px;
        background: #f8f9fa;
    }
    
    .kegiatan-page .container {
        max-width: 1200px;
    }
    
    .kegiatan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .kegiatan-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        border: 1px solid #eee;
        transition: all 0.3s;
    }
    
    .kegiatan-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
    }
    
    .kegiatan-card .card-thumb {
        height: 200px;
        background: linear-gradient(145deg, #f0f0f0, #e0e0e0);
        overflow: hidden;
        position: relative;
    }
    
    .kegiatan-card .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .kegiatan-card:hover .card-thumb img {
        transform: scale(1.05);
    }
    
    .kegiatan-card .card-thumb .card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 12px;
        background: linear-gradient(135deg, #f59e0b, #ef4444);
        color: #fff;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .kegiatan-card .card-content {
        padding: 20px 24px 24px;
    }
    
    .kegiatan-card .card-date {
        font-size: 0.8rem;
        color: #aaa;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .kegiatan-card .card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 10px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .kegiatan-card .card-excerpt {
        font-size: 0.88rem;
        color: #888;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
    }
    
    .kegiatan-card .card-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        font-size: 0.88rem;
        transition: gap 0.3s;
    }
    
    .kegiatan-card .card-link:hover {
        gap: 10px;
    }
    
    .kegiatan-empty {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #eee;
    }
    
    .kegiatan-empty i {
        font-size: 3.5rem;
        color: #ddd;
        margin-bottom: 20px;
        display: block;
    }
    
    .kegiatan-empty h3 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 8px;
    }
    
    .kegiatan-empty p {
        color: #999;
    }
    
    .kegiatan-pagination {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    
    @media (max-width: 1024px) {
        .kegiatan-grid { grid-template-columns: repeat(2, 1fr); }
    }
    
    @media (max-width: 768px) {
        .kegiatan-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Kegiatan</h1>
        <p>Kegiatan & aktivitas terbaru Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Content -->
<section class="kegiatan-page">
    <div class="container">
        @if($beritas->count() > 0)
            <div class="kegiatan-grid">
                @foreach($beritas as $berita)
                <div class="kegiatan-card">
                    <div class="card-thumb">
                        @if($berita->gambar)
                            <img src="{{ asset('assets/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                        @else
                            <img src="https://via.placeholder.com/400x250/f59e0b/ffffff?text=Kegiatan" alt="{{ $berita->judul }}">
                        @endif
                        <span class="card-badge"><i class="fas fa-calendar-check"></i> Kegiatan</span>
                    </div>
                    <div class="card-content">
                        <div class="card-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $berita->tanggal->format('d M Y') }}
                        </div>
                        <h3 class="card-title">{{ $berita->judul }}</h3>
                        <p class="card-excerpt">{{ Str::limit(strip_tags($berita->isi_berita), 100) }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="card-link">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="kegiatan-pagination">
                {{ $beritas->links() }}
            </div>
        @else
            <div class="kegiatan-empty">
                <i class="fas fa-calendar-alt"></i>
                <h3>Belum Ada Kegiatan</h3>
                <p>Tidak ada kegiatan yang ditampilkan saat ini. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>
</section>
@endsection
