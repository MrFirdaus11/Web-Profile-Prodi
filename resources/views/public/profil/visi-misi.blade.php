@extends('layouts.public')

@section('title', 'Visi & Misi - Prodi SI UNPARI')

@section('styles')
<style>
    /* Hero Section Enhancement */
    .visimisi-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        padding: 120px 0 100px;
        position: relative;
        overflow: hidden;
    }
    
    .visimisi-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(2deg); }
    }
    
    .visimisi-hero .container {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    
    .visimisi-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        text-shadow: 0 4px 30px rgba(0,0,0,0.2);
        animation: fadeInUp 0.8s ease;
    }
    
    .visimisi-hero p {
        font-size: 1.25rem;
        color: rgba(255,255,255,0.9);
        max-width: 500px;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease 0.2s backwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Main Content Section */
    .visimisi-content {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8fafc 0%, #eef2ff 100%);
        position: relative;
    }
    
    .visimisi-content::before {
        content: '';
        position: absolute;
        top: -80px;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(180deg, transparent, #f8fafc);
    }
    
    /* Card Grid */
    .visimisi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        margin-bottom: 80px;
    }
    
    /* Modern Glass Cards */
    .visimisi-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 20px 40px -15px rgba(124, 58, 237, 0.15);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        animation: fadeInUp 0.8s ease backwards;
    }
    
    .visimisi-card:nth-child(1) { animation-delay: 0.2s; }
    .visimisi-card:nth-child(2) { animation-delay: 0.4s; }
    
    .visimisi-card:hover {
        transform: translateY(-10px);
        box-shadow: 
            0 10px 15px -3px rgba(0, 0, 0, 0.1),
            0 30px 60px -15px rgba(124, 58, 237, 0.25);
    }
    
    .visimisi-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 28px 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 14px;
        position: relative;
        overflow: hidden;
    }
    
    .visimisi-card-header::after {
        content: '';
        position: absolute;
        top: 50%;
        right: 30px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        transform: translateY(-50%);
    }
    
    .visimisi-card-header i {
        font-size: 2rem;
        color: #fff;
        background: rgba(255,255,255,0.2);
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .visimisi-card-header h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #fff;
        margin: 0;
        letter-spacing: 2px;
        text-transform: uppercase;
    }
    
    .visimisi-card-body {
        padding: 36px;
    }
    
    .visimisi-card-body > p {
        color: #475569;
        line-height: 2;
        font-size: 1.1rem;
        text-align: justify;
    }
    
    /* Misi List - Modern Style */
    .misi-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .misi-list li {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 20px;
        margin-bottom: 12px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .misi-list li:hover {
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
        border-left-color: #7c3aed;
        transform: translateX(8px);
    }
    
    .misi-list li .number {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        font-weight: 800;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }
    
    .misi-list li span:last-child {
        color: #334155;
        line-height: 1.8;
        font-size: 1rem;
        padding-top: 6px;
    }
    
    /* Tujuan Section - Modern Cards */
    .tujuan-section {
        padding: 80px 0 100px;
        background: linear-gradient(180deg, #eef2ff 0%, #faf5ff 100%);
        position: relative;
    }
    
    .tujuan-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .tujuan-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #fff;
        padding: 10px 28px;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 20px;
        box-shadow: 0 8px 30px rgba(124, 58, 237, 0.3);
    }
    
    .tujuan-header h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 16px;
    }
    
    .tujuan-header p {
        color: #64748b;
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .tujuan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .tujuan-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px 32px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease backwards;
    }
    
    .tujuan-card:nth-child(1) { animation-delay: 0.3s; }
    .tujuan-card:nth-child(2) { animation-delay: 0.5s; }
    .tujuan-card:nth-child(3) { animation-delay: 0.7s; }
    
    .tujuan-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }
    
    .tujuan-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 50px rgba(124, 58, 237, 0.15);
    }
    
    .tujuan-card:hover::before {
        transform: scaleX(1);
    }
    
    .tujuan-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }
    
    .tujuan-card:hover .tujuan-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
        transform: scale(1.1) rotate(5deg);
    }
    
    .tujuan-icon i {
        font-size: 2rem;
        color: #7c3aed;
        transition: color 0.4s ease;
    }
    
    .tujuan-card:hover .tujuan-icon i {
        color: #fff;
    }
    
    .tujuan-card h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }
    
    .tujuan-card p {
        color: #64748b;
        line-height: 1.8;
        font-size: 0.95rem;
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .visimisi-hero h1 {
            font-size: 2.5rem;
        }
        
        .visimisi-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .tujuan-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .visimisi-hero {
            padding: 100px 0 80px;
        }
        
        .visimisi-hero h1 {
            font-size: 2rem;
        }
        
        .visimisi-content {
            padding: 60px 0;
        }
        
        .tujuan-grid {
            grid-template-columns: 1fr;
        }
        
        .tujuan-header h2 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="visimisi-hero">
    <div class="container">
        <h1>Visi & Misi</h1>
        <p>Arah dan tujuan Program Studi Sistem Informasi UNPARI</p>
    </div>
</section>

<!-- Visi Misi Content -->
<section class="visimisi-content">
    <div class="container">
        <div class="visimisi-grid">
            <!-- Visi Card -->
            <div class="visimisi-card">
                <div class="visimisi-card-header">
                    <i class="fas fa-eye"></i>
                    <h2>Visi</h2>
                </div>
                <div class="visimisi-card-body">
                    <p>{{ $visi }}</p>
                </div>
            </div>
            
            <!-- Misi Card -->
            <div class="visimisi-card">
                <div class="visimisi-card-header">
                    <i class="fas fa-bullseye"></i>
                    <h2>Misi</h2>
                </div>
                <div class="visimisi-card-body">
                    @php
                        $misiItems = array_filter(explode("\n", $misi));
                        $counter = 1;
                    @endphp
                    <ul class="misi-list">
                        @foreach($misiItems as $item)
                            @if(trim($item))
                            <li>
                                <span class="number">{{ $counter++ }}</span>
                                <span>{{ preg_replace('/^\d+\.\s*/', '', trim($item)) }}</span>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tujuan Section -->
<section class="tujuan-section">
    <div class="container">
        <div class="tujuan-header">
            <span class="tujuan-badge">
                <i class="fas fa-rocket"></i> Goals
            </span>
            <h2>Tujuan Program Studi</h2>
            <p>Fokus utama dalam pengembangan dan pencapaian keunggulan akademik</p>
        </div>
        
        <div class="tujuan-grid">
            <div class="tujuan-card">
                <div class="tujuan-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h4>Lulusan Berkualitas</h4>
                <p>Menghasilkan lulusan yang kompeten di bidang Sistem Informasi dan siap bersaing di era digital global.</p>
            </div>
            
            <div class="tujuan-card">
                <div class="tujuan-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h4>Riset & Inovasi</h4>
                <p>Melaksanakan penelitian inovatif yang berkontribusi terhadap pengembangan ilmu pengetahuan dan teknologi.</p>
            </div>
            
            <div class="tujuan-card">
                <div class="tujuan-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>Kemitraan Strategis</h4>
                <p>Menjalin kerjasama dengan berbagai instansi untuk meningkatkan kualitas pendidikan dan peluang karir.</p>
            </div>
        </div>
    </div>
</section>
@endsection
