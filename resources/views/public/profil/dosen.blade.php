@extends('layouts.public')

@section('title', 'Profil Dosen - Prodi SI UNPARI')

@section('styles')
<style>
    .dosen-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f5ff 0%, #fff 100%);
    }
    
    .dosen-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    
    .dosen-card {
        border: 3px solid var(--dark);
        border-radius: var(--border-radius);
        overflow: hidden;
        background: var(--white);
        transition: var(--transition);
    }
    
    .dosen-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }
    
    .dosen-card-img {
        height: 220px;
        background: var(--cream);
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 3px solid var(--dark);
        position: relative;
        overflow: hidden;
    }
    
    .dosen-card-img i {
        font-size: 5rem;
        color: var(--gray-light);
    }
    
    .dosen-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .dosen-card-body {
        padding: 24px;
        text-align: center;
    }
    
    .dosen-card-body h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 8px;
    }
    
    .dosen-card-body .jabatan {
        font-size: 0.9rem;
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 6px;
    }
    
    .dosen-card-body .nidn {
        font-size: 0.8rem;
        color: var(--gray-light);
        margin-bottom: 12px;
    }
    
    .dosen-card-body .keahlian {
        font-size: 0.85rem;
        color: var(--gray);
        padding: 10px;
        background: var(--light);
        border-radius: var(--border-radius-sm);
        margin-bottom: 15px;
    }
    
    .dosen-card-body .pendidikan {
        font-size: 0.8rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    
    .dosen-card-body .email {
        margin-top: 12px;
    }
    
    .dosen-card-body .email a {
        font-size: 0.85rem;
        color: var(--primary);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    
    .dosen-card-body .email a:hover {
        color: var(--primary-dark);
    }
    
    .dosen-stats {
        padding: 60px 0;
        background: var(--white);
    }
    
    .stats-box {
        border: none;
        border-radius: 16px;
        padding: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        color: var(--white);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        text-align: center;
    }
    
    .stat-item h3 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 8px;
    }
    
    .stat-item p {
        font-size: 1rem;
        opacity: 0.9;
    }
    
    @media (max-width: 1024px) {
        .dosen-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .dosen-grid {
            grid-template-columns: 1fr;
            max-width: 350px;
            margin: 0 auto;
        }
        
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .stat-item h3 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Profil Dosen</h1>
        <p>Tenaga pengajar profesional Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Dosen Section -->
<section class="dosen-section">
    <div class="container">
        <div class="dosen-grid">
            @forelse($dosens as $dosen)
            <div class="dosen-card">
                <div class="dosen-card-img">
                    @if($dosen->foto)
                        <img src="{{ asset('assets/img/dosen/' . $dosen->foto) }}" alt="{{ $dosen->nama }}">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <div class="dosen-card-body">
                    <h4>{{ $dosen->nama }}</h4>
                    <p class="jabatan">{{ $dosen->jabatan }}</p>
                    @if($dosen->nidn)
                    <p class="nidn">NIDN: {{ $dosen->nidn }}</p>
                    @endif
                    @if($dosen->bidang_keahlian)
                    <p class="keahlian">{{ $dosen->bidang_keahlian }}</p>
                    @endif
                    @if($dosen->pendidikan)
                    <p class="pendidikan">
                        <i class="fas fa-graduation-cap"></i> {{ $dosen->pendidikan }}
                    </p>
                    @endif
                    @if($dosen->email)
                    <div class="email">
                        <a href="mailto:{{ $dosen->email }}">
                            <i class="fas fa-envelope"></i> {{ $dosen->email }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default dosen cards -->
            <div class="dosen-card">
                <div class="dosen-card-img"><i class="fas fa-user"></i></div>
                <div class="dosen-card-body">
                    <h4>Dr. Ahmad Fauzi, M.Kom</h4>
                    <p class="jabatan">Ketua Program Studi</p>
                    <p class="nidn">NIDN: 0123456789</p>
                    <p class="keahlian">Sistem Informasi, Data Mining</p>
                    <p class="pendidikan"><i class="fas fa-graduation-cap"></i> S3 Ilmu Komputer</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="dosen-stats">
    <div class="container">
        <div class="stats-box">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>{{ $dosens->count() ?: 4 }}</h3>
                    <p>Dosen Tetap</p>
                </div>
                <div class="stat-item">
                    <h3>80%</h3>
                    <p>S2 & S3</p>
                </div>
                <div class="stat-item">
                    <h3>25+</h3>
                    <p>Publikasi</p>
                </div>
                <div class="stat-item">
                    <h3>10+</h3>
                    <p>Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
