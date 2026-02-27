<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - SI UNPARI')</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    @yield('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SI UNPARI</span>
            </div>
            
            <nav class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                
                <a href="{{ route('admin.profile-prodi.index') }}" class="{{ request()->routeIs('admin.profile-prodi.*') ? 'active' : '' }}">
                    <i class="fas fa-university"></i> Profile Prodi
                </a>
                
                <a href="{{ route('admin.akademik.index') }}" class="{{ request()->routeIs('admin.akademik.*') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i> Akademik
                </a>
                
                <a href="{{ route('admin.berita.index') }}" class="{{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
                
                <a href="{{ route('admin.dokumen.index') }}" class="{{ request()->routeIs('admin.dokumen.*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i> Dokumen
                </a>
                
                <a href="{{ route('admin.kontak.index') }}" class="{{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> Kontak
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Header -->
            <header class="admin-header">
                <h1>@yield('header', 'Dashboard')</h1>
                
                <div class="admin-user">
                    <div class="admin-user-info">
                        <span class="admin-user-name">{{ session('admin_nama', 'Administrator') }}</span>
                        <span class="admin-user-role">Admin</span>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline" style="margin-left: 15px;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main -->
            <main class="admin-main">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    @yield('scripts')
</body>
</html>
