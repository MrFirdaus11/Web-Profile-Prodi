@extends('layouts.public')

@section('title', 'Kata Sambutan - Prodi SI UNPARI')

@section('styles')
<style>
    .sambutan-section {
        padding: 60px 0;
        background: linear-gradient(135deg, #f8f5ff 0%, #fff 100%);
    }
    
    .sambutan-box {
        display: grid;
        grid-template-columns: 350px 1fr;
        gap: 50px;
        align-items: start;
    }
    
    .sambutan-img-wrapper {
        position: sticky;
        top: 100px;
    }
    
    .sambutan-img {
        width: 100%;
        height: 420px;
        background: var(--cream);
        border: 3px solid var(--dark);
        border-radius: var(--border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        overflow: hidden;
    }
    
    .sambutan-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .sambutan-img i {
        font-size: 6rem;
        color: var(--gray-light);
    }
    
    .sambutan-name-card {
        margin-top: 20px;
        padding: 20px;
        background: var(--gradient-primary);
        color: var(--white);
        border-radius: var(--border-radius);
        text-align: center;
    }
    
    .sambutan-name-card h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 4px;
    }
    
    .sambutan-name-card p {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    .sambutan-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 3px solid var(--primary);
    }
    
    .sambutan-content .greeting {
        font-size: 1.2rem;
        color: var(--primary);
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .sambutan-content p {
        color: var(--gray);
        line-height: 2;
        font-size: 1.05rem;
        text-align: justify;
        margin-bottom: 20px;
    }
    
    .sambutan-signature {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px dashed var(--gray-light);
    }
    
    .sambutan-signature p {
        margin-bottom: 5px;
        text-align: left;
    }
    
    .sambutan-signature .name {
        font-weight: 700;
        color: var(--dark);
        font-size: 1.1rem;
    }
    
    @media (max-width: 768px) {
        .sambutan-box {
            grid-template-columns: 1fr;
        }
        
        .sambutan-img-wrapper {
            position: static;
            max-width: 300px;
            margin: 0 auto 30px;
        }
        
        .sambutan-img {
            height: 320px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Kata Sambutan</h1>
        <p>Sambutan dari {{ $kaprodi_jabatan }} Program Studi Sistem Informasi</p>
    </div>
</section>

<!-- Sambutan Section -->
<section class="sambutan-section">
    <div class="container">
        <div class="sambutan-box">
            <div class="sambutan-img-wrapper">
                <div class="sambutan-img">
                    @if($kaprodi_foto)
                        <img src="{{ asset('assets/img/profil/' . $kaprodi_foto) }}" alt="{{ $kaprodi_nama }}">
                    @else
                        <i class="fas fa-user-tie"></i>
                    @endif
                </div>
                <div class="sambutan-name-card">
                    <h3>{{ $kaprodi_nama }}</h3>
                    <p>{{ $kaprodi_jabatan }}</p>
                </div>
            </div>
            
            <div class="sambutan-content">
                <h2>Kata Sambutan {{ $kaprodi_jabatan }}</h2>
                
                <p class="greeting">Assalamu'alaikum Warahmatullahi Wabarakatuh</p>
                
                <p>{{ $sambutan }}</p>
                
                <p>
                    Program Studi Sistem Informasi UNPARI terus berkomitmen untuk menghasilkan lulusan yang siap bersaing di era industri 4.0. 
                    Dengan kurikulum yang selalu diperbarui dan tenaga pengajar yang kompeten, kami yakin dapat memberikan pendidikan berkualitas tinggi kepada mahasiswa kami.
                </p>
                
                <p>
                    Kami mengundang para calon mahasiswa untuk bergabung bersama kami dalam menempuh pendidikan tinggi yang berkualitas. 
                    Dengan fasilitas yang memadai, dosen-dosen berpengalaman, dan lingkungan belajar yang kondusif, 
                    Program Studi Sistem Informasi UNPARI siap menjadi mitra Anda dalam meraih masa depan yang gemilang di bidang teknologi informasi.
                </p>
                
                <p>
                    Terima kasih atas kunjungan Anda di website resmi Program Studi Sistem Informasi UNPARI. 
                    Semoga informasi yang tersedia dapat bermanfaat bagi Anda semua.
                </p>
                
                <div class="sambutan-signature">
                    <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>
                    <p style="margin-top: 30px;">Hormat kami,</p>
                    <p class="name">{{ $kaprodi_nama }}</p>
                    <p>{{ $kaprodi_jabatan }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
