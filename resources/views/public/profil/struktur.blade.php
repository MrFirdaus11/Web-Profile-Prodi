@extends('layouts.public')

@section('title', 'Struktur Organisasi - Prodi SI UNPARI')

@section('styles')
<style>
    /* Hero Section */
    .struktur-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        padding: 80px 0 120px;
        position: relative;
        overflow: hidden;
    }
    
    .struktur-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    
    .struktur-hero .container {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    
    .struktur-hero h1 {
        font-size: 3rem;
        font-weight: 800;
        color: white;
        margin-bottom: 16px;
        text-shadow: 0 4px 20px rgba(0,0,0,0.2);
    }
    
    .struktur-hero p {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Main Content */
    .struktur-content {
        margin-top: -60px;
        padding-bottom: 80px;
        position: relative;
        z-index: 2;
    }
    
    /* Image Section */
    .struktur-image-section {
        background: white;
        border-radius: 24px;
        padding: 48px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .struktur-image-section img {
        max-width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    }
    
    .empty-state {
        padding: 80px 40px;
        background: linear-gradient(145deg, #f8fafc, #e2e8f0);
        border-radius: 16px;
        border: 2px dashed #cbd5e1;
    }
    
    .empty-state i {
        font-size: 5rem;
        color: #94a3b8;
        margin-bottom: 24px;
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 12px;
    }
    
    .empty-state p {
        color: #94a3b8;
        font-size: 1rem;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .struktur-hero h1 {
            font-size: 2rem;
        }
        
        .struktur-hero p {
            font-size: 1rem;
        }
        
        .struktur-image-section {
            padding: 24px;
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="struktur-hero">
        <div class="container">
            <h1>Struktur Organisasi</h1>
            <p>Bagan struktur organisasi Program Studi Sistem Informasi UNPARI</p>
        </div>
    </section>
    
    <!-- Main Content -->
    <section class="struktur-content">
        <div class="container">
            <div class="struktur-image-section">
                @if($struktur_image)
                    <img src="{{ asset('assets/img/struktur/' . $struktur_image) }}" alt="Struktur Organisasi Program Studi">
                @else
                    <div class="empty-state">
                        <i class="fas fa-sitemap"></i>
                        <h3>Struktur Organisasi</h3>
                        <p>Gambar struktur organisasi belum tersedia</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
