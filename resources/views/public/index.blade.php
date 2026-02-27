@extends('layouts.public')

@section('title', 'Beranda - Prodi SI UNPARI')

@section('content')
<!-- Slide Informasi Section -->
<section class="slide-section">
    <h2 class="section-title">Informasi Penting</h2>
    
    <div class="slider-container">
        <button class="slider-nav prev" onclick="prevSlide()">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <div class="slider" id="slider">
            <!-- Slide 1: Pendaftaran Mahasiswa Baru -->
            <div class="slide">
                <img src="https://picsum.photos/seed/pmb2026/1200/500" alt="Pendaftaran Mahasiswa Baru">
                <div class="slide-overlay">
                    <h3>Pendaftaran Mahasiswa Baru</h3>
                    <p>Buka Pendaftaran Tahun Akademik 2026/2027</p>
                </div>
            </div>
            
            <!-- Slide 2: Akreditasi -->
            <div class="slide">
                <img src="https://picsum.photos/seed/akreditasi/1200/500" alt="Akreditasi Unggul">
                <div class="slide-overlay">
                    <h3>Akreditasi Unggul</h3>
                    <p>Program Studi Terakreditasi B</p>
                </div>
            </div>
            
            <!-- Slide 3: Seminar & Workshop -->
            <div class="slide">
                <img src="https://picsum.photos/seed/seminar/1200/500" alt="Seminar & Workshop">
                <div class="slide-overlay">
                    <h3>Seminar & Workshop</h3>
                    <p>Ikuti berbagai kegiatan pengembangan skill</p>
                </div>
            </div>
            
            <!-- Slide 4: Fasilitas Modern -->
            <div class="slide">
                <img src="https://picsum.photos/seed/fasilitas/1200/500" alt="Fasilitas Modern">
                <div class="slide-overlay">
                    <h3>Fasilitas Modern</h3>
                    <p>Lab komputer lengkap dan ruang kelas nyaman</p>
                </div>
            </div>
        </div>
        
        <button class="slider-nav next" onclick="nextSlide()">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <div class="slider-dots">
            <div class="slider-dot active" onclick="goToSlide(0)"></div>
            <div class="slider-dot" onclick="goToSlide(1)"></div>
            <div class="slider-dot" onclick="goToSlide(2)"></div>
            <div class="slider-dot" onclick="goToSlide(3)"></div>
        </div>
    </div>
</section>

<!-- Capaian Karir Alumni Section -->
<section class="alumni-section">
    <div class="container">
        <div class="section-box">
            <h2 class="box-title">Capaian Karir Alumni</h2>
            
            <div class="alumni-grid">
                <div class="alumni-card">
                    <div class="alumni-card-top"></div>
                    <div class="alumni-card-bottom">
                        <div class="alumni-card-circle">85%</div>
                        <div class="alumni-card-label">Bekerja Sesuai Bidang</div>
                    </div>
                </div>
                
                <div class="alumni-card">
                    <div class="alumni-card-top"></div>
                    <div class="alumni-card-bottom">
                        <div class="alumni-card-circle">90%</div>
                        <div class="alumni-card-label">Bekerja < 6 Bulan</div>
                    </div>
                </div>
                
                <div class="alumni-card">
                    <div class="alumni-card-top"></div>
                    <div class="alumni-card-bottom">
                        <div class="alumni-card-circle">75%</div>
                        <div class="alumni-card-label">Wirausaha</div>
                    </div>
                </div>
                
                <div class="alumni-card">
                    <div class="alumni-card-top"></div>
                    <div class="alumni-card-bottom">
                        <div class="alumni-card-circle">95%</div>
                        <div class="alumni-card-label">Kepuasan Pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Berita & Informasi Section -->
<section class="berita-section">
    <div class="container">
        <div class="section-badge">
            <span>Berita & Informasi</span>
        </div>
        
        @if($beritas->count() > 0)
            <div class="berita-grid">
                @foreach($beritas as $berita)
                <div class="berita-card">
                    <div class="berita-card-img">
                        @if($berita->gambar)
                            <img src="{{ asset('assets/img/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                        @else
                            Gambar
                        @endif
                    </div>
                    <div class="berita-card-body">
                        <h3 class="berita-card-title">{{ $berita->judul }}</h3>
                        <p class="berita-card-text">{{ Str::limit(strip_tags($berita->isi_berita), 80) }}</p>
                    </div>
                    <div class="berita-card-footer">
                        <a href="{{ route('berita.show', $berita->slug) }}" class="btn-selengkapnya">
                            Selengkapnya
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="berita-grid">
                <div class="berita-card">
                    <div class="berita-card-img">Gambar</div>
                    <div class="berita-card-body">
                        <h3 class="berita-card-title">Judul Berita Pertama</h3>
                        <p class="berita-card-text">Deskripsi singkat dari berita yang akan ditampilkan di sini.</p>
                    </div>
                    <div class="berita-card-footer">
                        <button class="btn-selengkapnya">Selengkapnya</button>
                    </div>
                </div>
                
                <div class="berita-card">
                    <div class="berita-card-img">Gambar</div>
                    <div class="berita-card-body">
                        <h3 class="berita-card-title">Judul Berita Kedua</h3>
                        <p class="berita-card-text">Deskripsi singkat dari berita yang akan ditampilkan di sini.</p>
                    </div>
                    <div class="berita-card-footer">
                        <button class="btn-selengkapnya">Selengkapnya</button>
                    </div>
                </div>
                
                <div class="berita-card">
                    <div class="berita-card-img">Gambar</div>
                    <div class="berita-card-body">
                        <h3 class="berita-card-title">Judul Berita Ketiga</h3>
                        <p class="berita-card-text">Deskripsi singkat dari berita yang akan ditampilkan di sini.</p>
                    </div>
                    <div class="berita-card-footer">
                        <button class="btn-selengkapnya">Selengkapnya</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
<script>
    let currentSlide = 0;
    const totalSlides = 4;
    
    function updateSlider() {
        const slider = document.getElementById('slider');
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        document.querySelectorAll('.slider-dot').forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    }
    
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    }
    
    function goToSlide(index) {
        currentSlide = index;
        updateSlider();
    }
    
    // Auto slide every 5 seconds
    setInterval(nextSlide, 5000);
</script>
@endsection
