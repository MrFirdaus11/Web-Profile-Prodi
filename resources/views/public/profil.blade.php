@extends('layouts.public')

@section('title', 'Profil - Prodi SI UNPARI')

@section('styles')
<style>
    /* Sambutan Section */
    .sambutan-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f5ff 0%, #fff 100%);
    }
    
    .sambutan-box {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 40px;
        align-items: center;
    }
    
    .sambutan-img {
        width: 100%;
        height: 350px;
        background: var(--cream);
        border: 3px solid var(--dark);
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
    }
    
    .sambutan-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: var(--border-radius);
    }
    
    .sambutan-content h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 16px;
    }
    
    .sambutan-content .kaprodi-name {
        font-weight: 600;
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .sambutan-content p {
        color: var(--gray);
        line-height: 1.9;
        text-align: justify;
    }
    
    /* Visi Misi Section */
    .visimisi-section {
        padding: 60px 0;
        background: var(--white);
    }
    
    .visimisi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .visimisi-card {
        border: 2px solid var(--dark);
        border-radius: var(--border-radius);
        overflow: hidden;
    }
    
    .visimisi-card-header {
        background: var(--gradient-primary);
        color: var(--white);
        padding: 16px 24px;
        font-size: 1.25rem;
        font-weight: 700;
        text-align: center;
    }
    
    .visimisi-card-body {
        padding: 24px;
    }
    
    .visimisi-card-body p {
        color: var(--gray);
        line-height: 1.8;
    }
    
    .misi-list {
        list-style: none;
        padding: 0;
    }
    
    .misi-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid var(--light);
        color: var(--gray);
        line-height: 1.7;
    }
    
    .misi-list li:last-child {
        border-bottom: none;
    }
    
    .misi-list li i {
        color: var(--primary);
        margin-top: 4px;
    }
    
    /* Struktur Organisasi Section */
    .struktur-section {
        padding: 60px 0;
        background: var(--light);
    }
    
    .struktur-box {
        border: 2px solid var(--dark);
        border-radius: var(--border-radius);
        padding: 40px;
        background: var(--white);
        position: relative;
    }
    
    .struktur-title {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--white);
        padding: 8px 24px;
        border: 2px solid var(--dark);
        border-radius: var(--border-radius-pill);
        font-size: 1.1rem;
        font-weight: 700;
    }
    
    .org-chart {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-top: 20px;
    }
    
    .org-level {
        display: flex;
        justify-content: center;
        gap: 30px;
    }
    
    .org-item {
        text-align: center;
        padding: 20px 30px;
        border: 2px solid var(--primary);
        border-radius: var(--border-radius);
        background: var(--white);
        min-width: 200px;
    }
    
    .org-item.kaprodi {
        background: var(--gradient-primary);
        color: var(--white);
        border-color: var(--primary);
    }
    
    .org-item .position {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 6px;
    }
    
    .org-item .name {
        font-size: 0.85rem;
        opacity: 0.9;
    }
    
    .org-connector {
        width: 2px;
        height: 30px;
        background: var(--dark);
    }
    
    .org-horizontal-line {
        width: 400px;
        height: 2px;
        background: var(--dark);
    }
    
    /* Program Kelas Section */
    .program-section {
        padding: 60px 0;
        background: var(--white);
    }
    
    .program-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    
    .program-card {
        border: 2px solid var(--dark);
        border-radius: var(--border-radius);
        overflow: hidden;
        transition: var(--transition);
    }
    
    .program-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .program-card-header {
        background: var(--cream);
        padding: 30px 20px;
        text-align: center;
        border-bottom: 2px solid var(--dark);
    }
    
    .program-card-header i {
        font-size: 2.5rem;
        color: var(--primary);
        margin-bottom: 10px;
    }
    
    .program-card-header h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--dark);
    }
    
    .program-card-body {
        padding: 20px;
    }
    
    .program-card-body p {
        color: var(--gray);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 15px;
    }
    
    .program-card-body ul {
        list-style: none;
        padding: 0;
    }
    
    .program-card-body ul li {
        padding: 6px 0;
        font-size: 0.85rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .program-card-body ul li i {
        color: var(--success);
        font-size: 0.75rem;
    }
    
    /* Dosen Section */
    .dosen-section {
        padding: 60px 0;
        background: var(--light);
    }
    
    .dosen-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    
    .dosen-card {
        border: 2px solid var(--dark);
        border-radius: var(--border-radius);
        overflow: hidden;
        background: var(--white);
        transition: var(--transition);
    }
    
    .dosen-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .dosen-card-img {
        height: 200px;
        background: var(--cream);
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 2px solid var(--dark);
    }
    
    .dosen-card-img i {
        font-size: 4rem;
        color: var(--gray-light);
    }
    
    .dosen-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .dosen-card-body {
        padding: 20px;
        text-align: center;
    }
    
    .dosen-card-body h4 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 6px;
    }
    
    .dosen-card-body .jabatan {
        font-size: 0.85rem;
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .dosen-card-body .keahlian {
        font-size: 0.8rem;
        color: var(--gray);
        margin-bottom: 10px;
    }
    
    .dosen-card-body .email {
        font-size: 0.8rem;
        color: var(--gray-light);
    }
    
    .dosen-card-body .email a {
        color: var(--primary);
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .dosen-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .sambutan-box {
            grid-template-columns: 1fr;
            text-align: center;
        }
        
        .sambutan-img {
            height: 250px;
            max-width: 300px;
            margin: 0 auto;
        }
        
        .visimisi-grid {
            grid-template-columns: 1fr;
        }
        
        .program-grid,
        .dosen-grid {
            grid-template-columns: 1fr;
        }
        
        .org-level {
            flex-direction: column;
            align-items: center;
        }
        
        .org-horizontal-line {
            display: none;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>Profil Program Studi</h1>
        <p>Mengenal lebih dekat Program Studi Sistem Informasi UNPARI</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <span>Profil</span>
        </div>
    </div>
</div>

<!-- Kata Sambutan Section -->
<section class="sambutan-section">
    <div class="container">
        <div class="sambutan-box">
            <div class="sambutan-img">
                <i class="fas fa-user-tie" style="font-size: 5rem;"></i>
            </div>
            <div class="sambutan-content">
                <h2>Kata Sambutan Ketua Program Studi</h2>
                <p class="kaprodi-name">Dr. Ahmad Fauzi, M.Kom</p>
                <p>{{ $sambutan }}</p>
                <p style="margin-top: 15px;">
                    Program Studi Sistem Informasi UNPARI terus berkomitmen untuk menghasilkan lulusan yang siap bersaing di era industri 4.0. 
                    Dengan kurikulum yang selalu diperbarui dan tenaga pengajar yang kompeten, kami yakin dapat memberikan pendidikan berkualitas tinggi kepada mahasiswa kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Visi Misi Section -->
<section class="visimisi-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <span>Visi & Misi</span>
            </div>
        </div>
        
        <div class="visimisi-grid">
            <div class="visimisi-card">
                <div class="visimisi-card-header">
                    <i class="fas fa-eye"></i> VISI
                </div>
                <div class="visimisi-card-body">
                    <p>{{ $visi }}</p>
                </div>
            </div>
            
            <div class="visimisi-card">
                <div class="visimisi-card-header">
                    <i class="fas fa-bullseye"></i> MISI
                </div>
                <div class="visimisi-card-body">
                    @php
                        $misiItems = array_filter(explode("\n", $misi));
                    @endphp
                    <ul class="misi-list">
                        @foreach($misiItems as $item)
                            @if(trim($item))
                            <li>
                                <i class="fas fa-check-circle"></i>
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

<!-- Struktur Organisasi Section -->
<section class="struktur-section">
    <div class="container">
        <div class="struktur-box">
            <h2 class="struktur-title">Struktur Organisasi</h2>
            
            <div class="org-chart">
                <!-- Level 1: Ketua Prodi -->
                <div class="org-level">
                    <div class="org-item kaprodi">
                        <div class="position">Ketua Program Studi</div>
                        <div class="name">Dr. Ahmad Fauzi, M.Kom</div>
                    </div>
                </div>
                
                <div class="org-connector"></div>
                
                <!-- Level 2: Sekretaris -->
                <div class="org-level">
                    <div class="org-item">
                        <div class="position">Sekretaris Prodi</div>
                        <div class="name">Siti Rahma, M.Kom</div>
                    </div>
                </div>
                
                <div class="org-connector"></div>
                <div class="org-horizontal-line"></div>
                
                <!-- Level 3: Koordinator -->
                <div class="org-level">
                    <div class="org-item">
                        <div class="position">Koordinator Akademik</div>
                        <div class="name">Budi Santoso, M.T.I</div>
                    </div>
                    <div class="org-item">
                        <div class="position">Koordinator Kemahasiswaan</div>
                        <div class="name">Dewi Lestari, M.Kom</div>
                    </div>
                    <div class="org-item">
                        <div class="position">Koordinator Laboratorium</div>
                        <div class="name">Andi Prasetyo, M.Kom</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Program Kelas Section -->
<section class="program-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <span>Program Kelas</span>
            </div>
        </div>
        
        <div class="program-grid">
            <div class="program-card">
                <div class="program-card-header">
                    <i class="fas fa-sun"></i>
                    <h3>Kelas Reguler Pagi</h3>
                </div>
                <div class="program-card-body">
                    <p>Program kuliah reguler dengan jadwal pembelajaran di pagi hingga siang hari.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Senin - Jumat (08.00 - 15.00)</li>
                        <li><i class="fas fa-check"></i> Tatap muka langsung</li>
                        <li><i class="fas fa-check"></i> Akses lab komputer</li>
                        <li><i class="fas fa-check"></i> Kegiatan kemahasiswaan</li>
                    </ul>
                </div>
            </div>
            
            <div class="program-card">
                <div class="program-card-header">
                    <i class="fas fa-moon"></i>
                    <h3>Kelas Reguler Malam</h3>
                </div>
                <div class="program-card-body">
                    <p>Program kuliah untuk mahasiswa yang bekerja atau memiliki aktivitas di pagi hari.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Senin - Jumat (18.00 - 21.00)</li>
                        <li><i class="fas fa-check"></i> Sabtu (08.00 - 15.00)</li>
                        <li><i class="fas fa-check"></i> Fleksibel untuk pekerja</li>
                        <li><i class="fas fa-check"></i> Kurikulum sama</li>
                    </ul>
                </div>
            </div>
            
            <div class="program-card">
                <div class="program-card-header">
                    <i class="fas fa-briefcase"></i>
                    <h3>Kelas Karyawan</h3>
                </div>
                <div class="program-card-body">
                    <p>Program khusus untuk karyawan dengan jadwal yang disesuaikan.</p>
                    <ul>
                        <li><i class="fas fa-check"></i> Sabtu & Minggu</li>
                        <li><i class="fas fa-check"></i> Blended learning</li>
                        <li><i class="fas fa-check"></i> E-learning support</li>
                        <li><i class="fas fa-check"></i> Mentoring online</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Profil Dosen Section -->
<section class="dosen-section">
    <div class="container">
        <div class="section-header">
            <div class="section-badge">
                <span>Profil Dosen</span>
            </div>
        </div>
        
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
                    <p class="keahlian">{{ $dosen->bidang_keahlian }}</p>
                    @if($dosen->email)
                    <p class="email"><a href="mailto:{{ $dosen->email }}">{{ $dosen->email }}</a></p>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default dosen cards if empty -->
            <div class="dosen-card">
                <div class="dosen-card-img"><i class="fas fa-user"></i></div>
                <div class="dosen-card-body">
                    <h4>Dr. Ahmad Fauzi, M.Kom</h4>
                    <p class="jabatan">Ketua Program Studi</p>
                    <p class="keahlian">Sistem Informasi, Data Mining</p>
                </div>
            </div>
            <div class="dosen-card">
                <div class="dosen-card-img"><i class="fas fa-user"></i></div>
                <div class="dosen-card-body">
                    <h4>Siti Rahma, M.Kom</h4>
                    <p class="jabatan">Sekretaris Prodi</p>
                    <p class="keahlian">Basis Data, Web Development</p>
                </div>
            </div>
            <div class="dosen-card">
                <div class="dosen-card-img"><i class="fas fa-user"></i></div>
                <div class="dosen-card-body">
                    <h4>Budi Santoso, M.T.I</h4>
                    <p class="jabatan">Dosen Tetap</p>
                    <p class="keahlian">Jaringan, Keamanan Sistem</p>
                </div>
            </div>
            <div class="dosen-card">
                <div class="dosen-card-img"><i class="fas fa-user"></i></div>
                <div class="dosen-card-body">
                    <h4>Dewi Lestari, M.Kom</h4>
                    <p class="jabatan">Dosen Tetap</p>
                    <p class="keahlian">Mobile Dev, UI/UX</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
