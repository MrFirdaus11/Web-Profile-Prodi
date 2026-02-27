@extends('layouts.public')

@section('title', 'Dokumen - Prodi SI UNPARI')

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Download Dokumen</h1>
        <p>Unduh dokumen akademik dan informasi penting lainnya</p>
    </div>
</section>

<!-- Content -->
<section class="section">
    <div class="container">
        <!-- Dokumen Akademik -->
        <div class="doc-category">
            <h2 class="doc-category-title">
                <i class="fas fa-book"></i> Dokumen Akademik
            </h2>
            @if($dokumenAkademik->count() > 0)
                <div class="doc-list">
                    @foreach($dokumenAkademik as $doc)
                    <div class="doc-item">
                        <div class="doc-info">
                            <div class="doc-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div class="doc-name">{{ $doc->nama_dokumen }}</div>
                                <div class="doc-meta">
                                    {{ $doc->tgl_upload->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        <a href="{{ $doc->url }}" target="_blank" class="btn btn-sm btn-accent">
                            <i class="fas fa-external-link-alt"></i> Buka
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding: 40px;">
                    <p>Belum ada dokumen di kategori ini.</p>
                </div>
            @endif
        </div>
        
        <!-- Dokumen Skripsi -->
        <div class="doc-category">
            <h2 class="doc-category-title">
                <i class="fas fa-graduation-cap"></i> Dokumen Skripsi
            </h2>
            @if($dokumenSkripsi->count() > 0)
                <div class="doc-list">
                    @foreach($dokumenSkripsi as $doc)
                    <div class="doc-item">
                        <div class="doc-info">
                            <div class="doc-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div class="doc-name">{{ $doc->nama_dokumen }}</div>
                                <div class="doc-meta">
                                    {{ $doc->tgl_upload->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        <a href="{{ $doc->url }}" target="_blank" class="btn btn-sm btn-accent">
                            <i class="fas fa-external-link-alt"></i> Buka
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding: 40px;">
                    <p>Belum ada dokumen di kategori ini.</p>
                </div>
            @endif
        </div>
        
        <!-- Jadwal -->
        <div class="doc-category">
            <h2 class="doc-category-title">
                <i class="fas fa-calendar-alt"></i> Jadwal
            </h2>
            @if($dokumenJadwal->count() > 0)
                <div class="doc-list">
                    @foreach($dokumenJadwal as $doc)
                    <div class="doc-item">
                        <div class="doc-info">
                            <div class="doc-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <div class="doc-name">{{ $doc->nama_dokumen }}</div>
                                <div class="doc-meta">
                                    {{ $doc->tgl_upload->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                        <a href="{{ $doc->url }}" target="_blank" class="btn btn-sm btn-accent">
                            <i class="fas fa-external-link-alt"></i> Buka
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" style="padding: 40px;">
                    <p>Belum ada dokumen di kategori ini.</p>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
