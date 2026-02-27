@extends('layouts.public')

@section('title', 'Akademik - Prodi SI UNPARI')

@section('content')
<style>
    .akademik-content {
        padding: 60px 0;
        background: #fff;
    }
    
    .akademik-content .container {
        max-width: 1200px;
    }
    
    .section-box {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 40px;
    }
    
    .section-box h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-box h3 i {
        color: var(--primary);
    }

    /* Info Akademik Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .info-item {
        background: linear-gradient(145deg, #f8f5ff, #f0ebff);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(124, 58, 237, 0.1);
    }
    
    .info-item .info-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }
    
    .info-item .info-icon i {
        color: #fff;
        font-size: 1.2rem;
    }
    
    .info-item .info-label {
        font-size: 0.8rem;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    
    .info-item .info-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
    }
    
    .kurikulum-desc {
        color: #666;
        line-height: 1.8;
        margin-bottom: 16px;
    }
    
    .fasilitas-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }
    
    .fasilitas-list li {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #555;
        font-size: 0.9rem;
    }
    
    .fasilitas-list li i {
        color: #10b981;
        font-size: 0.8rem;
    }

    /* Info Penting */
    .info-penting-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .info-penting-list li {
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .info-penting-list li:last-child {
        border-bottom: none;
    }
    
    .info-penting-list li i {
        color: var(--primary);
        font-size: 0.9rem;
    }
    
    .info-penting-list a {
        color: var(--primary);
        text-decoration: none;
        font-size: 0.95rem;
    }
    
    .info-penting-list a:hover {
        text-decoration: underline;
    }

    /* Bagan Table */
    .bagan-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .bagan-table th,
    .bagan-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .bagan-table th {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .bagan-table td {
        font-size: 0.95rem;
    }
    
    .bagan-table a {
        color: var(--primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .bagan-table a:hover {
        text-decoration: underline;
    }

    /* RPS Accordion */
    .rps-section h3 {
        margin-bottom: 20px;
    }
    
    .semester-accordion {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 8px;
    }
    
    .semester-header {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        background: #fafafa;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .semester-header:hover {
        background: #f5f5f5;
    }
    
    .semester-header .icon {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }
    
    .semester-header .icon i {
        color: #fff;
        font-size: 0.9rem;
    }
    
    .semester-header h4 {
        flex: 1;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }
    
    .semester-header .toggle-icon {
        color: #999;
        transition: transform 0.3s;
    }
    
    .semester-accordion.active .toggle-icon {
        transform: rotate(180deg);
    }
    
    .semester-content {
        display: none;
        padding: 20px;
        border-top: 1px solid #e0e0e0;
    }
    
    .semester-accordion.active .semester-content {
        display: block;
    }
    
    .matkul-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    
    .matkul-table th,
    .matkul-table td {
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .matkul-table th {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.8rem;
        text-transform: uppercase;
    }
    
    .matkul-table .text-center {
        text-align: center;
    }
    
    .btn-download {
        display: inline-block;
        padding: 4px 12px;
        background: #ffc107;
        color: #000;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .btn-download:hover {
        background: #ffca28;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .fasilitas-list {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Akademik</h1>
        <p>Informasi akademik, kurikulum, bagan mata kuliah, dan RPS Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Content -->
<section class="akademik-content">
    <div class="container">
        
        <!-- Informasi Akademik -->
        <div class="section-box">
            <h3><i class="fas fa-graduation-cap"></i> Informasi Akademik</h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-award"></i></div>
                    <div class="info-label">Gelar Lulusan</div>
                    <div class="info-value">{{ $gelar }}</div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-clock"></i></div>
                    <div class="info-label">Durasi Studi</div>
                    <div class="info-value">{{ $durasi }}</div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-book-open"></i></div>
                    <div class="info-label">Total SKS</div>
                    <div class="info-value">{{ $sks }}</div>
                </div>
            </div>
            
            <p class="kurikulum-desc">{{ $kurikulum }}</p>
            
            @php $fasilitasItems = array_filter(explode("\n", $fasilitas)); @endphp
            @if(count($fasilitasItems) > 0)
            <h4 style="font-size: 0.95rem; font-weight: 600; margin-bottom: 10px; color: var(--dark);">Fasilitas</h4>
            <ul class="fasilitas-list">
                @foreach($fasilitasItems as $item)
                <li><i class="fas fa-check-circle"></i> {{ trim($item) }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        
        <!-- Bagan Kurikulum -->
        @if($bagans->count() > 0)
        <div class="section-box">
            <h3><i class="fas fa-sitemap"></i> Bagan & Daftar Mata Kuliah per Angkatan</h3>
            <table class="bagan-table">
                <thead>
                    <tr>
                        <th>Angkatan</th>
                        <th>Bagan Kurikulum</th>
                        <th>Daftar Mata Kuliah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bagans as $bagan)
                    <tr>
                        <td><strong>{{ $bagan->angkatan }}</strong></td>
                        <td>
                            @if($bagan->link_bagan)
                                <a href="{{ $bagan->link_bagan }}" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat</a>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                        <td>
                            @if($bagan->link_matkul)
                                <a href="{{ $bagan->link_matkul }}" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat</a>
                            @else
                                <span style="color: #999;">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        
        <!-- Daftar Mata Kuliah & RPS per Semester -->
        @if($mataKuliahs->count() > 0)
        <div class="section-box rps-section">
            <h3><i class="fas fa-book"></i> Daftar Mata Kuliah & RPS per Semester</h3>
            
            @for($semester = 1; $semester <= 8; $semester++)
                @php $mks = $mataKuliahs->get($semester, collect()); @endphp
                @if($mks->count() > 0)
                <div class="semester-accordion" id="semester{{ $semester }}">
                    <div class="semester-header" onclick="toggleSemester({{ $semester }})">
                        <div class="icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h4>Semester {{ $semester }}</h4>
                        <i class="fas fa-chevron-down toggle-icon"></i>
                    </div>
                    <div class="semester-content">
                        <table class="matkul-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th class="text-center">SKS</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mks as $index => $mk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mk->kode }}</td>
                                    <td>{{ $mk->nama }}</td>
                                    <td class="text-center">{{ $mk->sks }}</td>
                                    <td>
                                        @if($mk->file_rps)
                                            <a href="{{ asset('assets/files/rps/' . $mk->file_rps) }}" class="btn-download" target="_blank">DOWNLOAD</a>
                                        @else
                                            <span style="color: #999;">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endfor
        </div>
        @endif
        
    </div>
</section>
@endsection

@section('scripts')
<script>
function toggleSemester(num) {
    const accordion = document.getElementById('semester' + num);
    accordion.classList.toggle('active');
}

// Open first semester by default
document.addEventListener('DOMContentLoaded', function() {
    const firstAccordion = document.querySelector('.semester-accordion');
    if (firstAccordion) {
        firstAccordion.classList.add('active');
    }
});
</script>
@endsection
