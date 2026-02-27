@extends('layouts.public')

@section('title', 'Berita - Prodi SI UNPARI')

@section('content')
<style>
    .berita-page {
        padding: 60px 0 80px;
        background: #f8f9fa;
    }
    
    .berita-page .container {
        max-width: 1200px;
    }
    
    /* Featured / First Article */
    .berita-featured {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 0;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        margin-bottom: 40px;
        border: 1px solid #e8e8e8;
        transition: box-shadow 0.3s;
    }
    
    .berita-featured:hover {
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }
    
    .berita-featured-img {
        height: 100%;
        min-height: 320px;
        background: linear-gradient(145deg, #f0f0f0, #e0e0e0);
        overflow: hidden;
    }
    
    .berita-featured-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .berita-featured:hover .berita-featured-img img {
        transform: scale(1.03);
    }
    
    .berita-featured-body {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .berita-featured-body .badge-featured {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        width: fit-content;
    }
    
    .berita-featured-body .date {
        font-size: 0.85rem;
        color: #999;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .berita-featured-body h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 16px;
        line-height: 1.4;
    }
    
    .berita-featured-body p {
        color: #666;
        line-height: 1.7;
        margin-bottom: 24px;
        font-size: 0.95rem;
    }
    
    .berita-featured-body .read-more {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        font-size: 0.95rem;
        transition: gap 0.3s;
    }
    
    .berita-featured-body .read-more:hover {
        gap: 12px;
    }
    
    /* Grid Cards */
    .berita-grid-page {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .berita-card-page {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        border: 1px solid #eee;
        transition: all 0.3s;
    }
    
    .berita-card-page:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.08);
    }
    
    .berita-card-page .card-thumb {
        height: 200px;
        background: linear-gradient(145deg, #f0f0f0, #e0e0e0);
        overflow: hidden;
        position: relative;
    }
    
    .berita-card-page .card-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    
    .berita-card-page:hover .card-thumb img {
        transform: scale(1.05);
    }
    
    .berita-card-page .card-thumb .card-category {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 4px 12px;
        background: rgba(0,0,0,0.6);
        color: #fff;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(4px);
    }
    
    .berita-card-page .card-content {
        padding: 20px 24px 24px;
    }
    
    .berita-card-page .card-date {
        font-size: 0.8rem;
        color: #aaa;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .berita-card-page .card-title {
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
    
    .berita-card-page .card-excerpt {
        font-size: 0.88rem;
        color: #888;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
    }
    
    .berita-card-page .card-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: var(--primary);
        font-weight: 600;
        text-decoration: none;
        font-size: 0.88rem;
        transition: gap 0.3s;
    }
    
    .berita-card-page .card-link:hover {
        gap: 10px;
    }
    
    /* Empty State */
    .berita-empty {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #eee;
    }
    
    .berita-empty i {
        font-size: 3.5rem;
        color: #ddd;
        margin-bottom: 20px;
        display: block;
    }
    
    .berita-empty h3 {
        font-size: 1.3rem;
        color: #333;
        margin-bottom: 8px;
    }
    
    .berita-empty p {
        color: #999;
    }
    
    /* Pagination */
    .berita-pagination {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    
    @media (max-width: 1024px) {
        .berita-grid-page {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .berita-featured {
            grid-template-columns: 1fr;
        }
        
        .berita-featured-img {
            min-height: 220px;
        }
        
        .berita-featured-body {
            padding: 24px;
        }
        
        .berita-featured-body h2 {
            font-size: 1.2rem;
        }
        
        .berita-grid-page {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Berita & Informasi</h1>
        <p>Update terbaru dari Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Content -->
<section class="berita-page">
    <div class="container">
        @if($beritas->count() > 0)
            
            {{-- Featured: First Article --}}
            @php $featured = $beritas->first(); @endphp
            @if($beritas->currentPage() == 1)
            <a href="{{ route('berita.show', $featured->slug) }}" style="text-decoration: none; color: inherit;">
                <div class="berita-featured">
                    <div class="berita-featured-img">
                        @if($featured->gambar)
                            <img src="{{ asset('assets/img/berita/' . $featured->gambar) }}" alt="{{ $featured->judul }}">
                        @else
                            <img src="https://via.placeholder.com/600x400/6366f1/ffffff?text=SI+UNPARI" alt="{{ $featured->judul }}">
                        @endif
                    </div>
                    <div class="berita-featured-body">
                        <span class="badge-featured"><i class="fas fa-star"></i> Terbaru</span>
                        <div class="date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $featured->tanggal->format('d F Y') }}
                        </div>
                        <h2>{{ $featured->judul }}</h2>
                        <p>{{ Str::limit(strip_tags($featured->isi_berita), 200) }}</p>
                        <span class="read-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </div>
            </a>
            @endif
            
            {{-- Grid: Rest of Articles --}}
            @php 
                $gridItems = $beritas->currentPage() == 1 ? $beritas->skip(1) : $beritas; 
            @endphp
            
            @if($gridItems->count() > 0)
            <div class="berita-grid-page">
                @foreach($gridItems as $berita)
                <div class="berita-card-page">
                    <div class="card-thumb">
                        @if($berita->gambar)
                            <img src="{{ asset('assets/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                        @else
                            <img src="https://via.placeholder.com/400x250/6366f1/ffffff?text=SI+UNPARI" alt="{{ $berita->judul }}">
                        @endif
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
            @endif
            
            <!-- Pagination -->
            <div class="berita-pagination">
                {{ $beritas->links() }}
            </div>
            
        @else
            <div class="berita-empty">
                <i class="fas fa-newspaper"></i>
                <h3>Belum Ada Berita</h3>
                <p>Tidak ada berita yang ditampilkan saat ini. Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>
</section>
@endsection
