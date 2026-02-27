<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Program Studi Sistem Informasi UNPARI - Mencetak lulusan yang profesional, inovatif, dan berkarakter">
    <title>@yield('title', 'Prodi SI UNPARI')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">
                <img src="{{ asset('assets/img/logo-prodi.png') }}" alt="Logo Prodi SI" style="height: 50px; width: auto;">
            </a>
            
            <div class="navbar-menu" id="navbarMenu">
                <!-- Beranda -->
                <div class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>
                </div>
                
                <!-- Profil (Dropdown) -->
                <div class="nav-item">
                    <div class="nav-link {{ request()->routeIs('profil.*') ? 'active' : '' }}">
                        Profil <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('profil.sambutan') }}">Kata Sambutan</a>
                        <a href="{{ route('profil.visimisi') }}">Visi & Misi</a>
                        <a href="{{ route('profil.struktur') }}">Struktur Organisasi</a>
                        <a href="{{ route('profil.program') }}">Program Kelas</a>
                        <a href="{{ route('profil.dosen') }}">Profil Dosen</a>
                    </div>
                </div>
                
                <!-- Akademik (Dropdown) -->
                <div class="nav-item">
                    <div class="nav-link {{ request()->routeIs('akademik') ? 'active' : '' }}">
                        Akademik <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('akademik') }}">Kurikulum</a>
                        <a href="{{ route('akademik') }}">Jadwal Kuliah</a>
                        <a href="{{ route('akademik') }}">Kalender Akademik</a>
                    </div>
                </div>
                
                <!-- Berita -->
                <div class="nav-item">
                    <a href="{{ route('berita') }}" class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}">
                        Berita
                    </a>
                </div>
                
                <!-- Dokumen (Dropdown) -->
                <div class="nav-item">
                    <div class="nav-link {{ request()->routeIs('dokumen') ? 'active' : '' }}">
                        Dokumen <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('dokumen') }}">Akademik</a>
                        <a href="{{ route('dokumen') }}">Skripsi</a>
                        <a href="{{ route('dokumen') }}">Jadwal</a>
                    </div>
                </div>
                
                <!-- Lainya (Dropdown) -->
                <div class="nav-item">
                    <div class="nav-link">
                        Lainnya <i class="fas fa-chevron-down dropdown-icon"></i>
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('kontak') }}">Kontak</a>
                        <a href="{{ route('faq') }}">FAQ</a>
                    </div>
                </div>

                <!-- PMB -->
                <div class="nav-item">
                    <a href="https://unpari.ac.id/" target="_blank" class="nav-link" style="background: #F59E0B; color: #fff; font-weight: 700;">
                        PMB
                    </a>
                </div>
            </div>
            
            <div class="navbar-toggle" id="navbarToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div>
                    <div class="footer-brand">SI UNPARI</div>
                    <p class="footer-desc">
                        Program Studi Sistem Informasi Universitas PGRI LUBUKLINGGAU. 
                        Mencetak lulusan yang profesional, inovatif, dan berkarakter.
                    </p>
                </div>
                
                <div>
                    <h4 class="footer-title">Navigasi</h4>
                    <div class="footer-links">
                        <a href="{{ route('home') }}">Beranda</a>
                        <a href="{{ route('profil.sambutan') }}">Profil</a>
                        <a href="{{ route('akademik') }}">Akademik</a>
                        <a href="{{ route('berita') }}">Berita</a>
                        <a href="{{ route('dokumen') }}">Dokumen</a>
                    </div>
                </div>
                
                <div>
                    <h4 class="footer-title">Kontak</h4>
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-map-marker-alt"></i> Lubuk Linggau</a>
                        <a href="#"><i class="fas fa-phone"></i> (0733) 123456</a>
                        <a href="#"><i class="fas fa-envelope"></i> si@unpari.ac.id</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Program Studi Sistem Informasi UNPARI. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('navbarToggle').addEventListener('click', function() {
            document.getElementById('navbarMenu').classList.toggle('active');
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
