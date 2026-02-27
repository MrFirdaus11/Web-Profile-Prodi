@extends('layouts.public')

@section('title', 'Program Kelas - Prodi SI UNPARI')

@section('styles')
<style>
    .program-section {
        padding: 70px 0;
        background: linear-gradient(180deg, #f8f5ff 0%, #ffffff 100%);
    }
    
    .program-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
        max-width: 900px;
        margin: 0 auto;
    }
    
    .program-card {
        border: 1px solid rgba(124, 58, 237, 0.12);
        border-radius: 20px;
        overflow: hidden;
        background: var(--white);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.06);
    }
    
    .program-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(124, 58, 237, 0.15);
        border-color: rgba(124, 58, 237, 0.25);
    }
    
    .program-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 28px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .program-card-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M20 20c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10-10-4.477-10-10zM0 20c0-5.523 4.477-10 10-10s10 4.477 10 10-4.477 10-10 10S0 25.523 0 20z'/%3E%3C/g%3E%3C/svg%3E");
    }
    
    .program-card-header .icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
        position: relative;
        z-index: 1;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }
    
    .program-card-header .icon i {
        font-size: 2rem;
        color: var(--white);
    }
    
    .program-card-header h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--white);
        position: relative;
        z-index: 1;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    
    .program-card-body {
        padding: 28px;
    }
    
    .program-card-body p {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.7;
        margin-bottom: 20px;
    }
    
    .program-features {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .program-features li {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        color: #475569;
    }
    
    .program-features li:last-child {
        border-bottom: none;
    }
    
    .program-features li i {
        color: #10b981;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    
    .schedule-section {
        padding: 0 0 70px;
        background: var(--white);
    }
    
    .schedule-box {
        border: 1px solid rgba(124, 58, 237, 0.12);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(124, 58, 237, 0.06);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .schedule-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: var(--white);
        padding: 22px 30px;
        font-size: 1.15rem;
        font-weight: 700;
        text-align: center;
        letter-spacing: 0.3px;
    }
    
    .schedule-header i {
        margin-right: 8px;
    }
    
    .schedule-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .schedule-table th,
    .schedule-table td {
        padding: 18px 24px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .schedule-table th {
        background: #f8fafc;
        font-weight: 600;
        color: #334155;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .schedule-table td {
        color: #475569;
        font-size: 0.95rem;
    }
    
    .schedule-table tr:last-child td {
        border-bottom: none;
    }
    
    .schedule-table tr:hover td {
        background: rgba(124, 58, 237, 0.03);
    }
    
    @media (max-width: 768px) {
        .program-grid {
            grid-template-columns: 1fr;
        }
        
        .schedule-table {
            font-size: 0.85rem;
        }

        .schedule-table th,
        .schedule-table td {
            padding: 14px 18px;
        }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="struktur-hero">
    <div class="container">
        <h1>Program Kelas</h1>
        <p>Pilihan program kelas yang sesuai dengan kebutuhan Anda</p>
    </div>
</section>

<!-- Program Section -->
<section class="program-section">
    <div class="container">
        <div class="program-grid">
            @forelse($programs as $program)
            <div class="program-card">
                <div class="program-card-header">
                    <div class="icon">
                        <i class="fas {{ $program->icon ?: 'fa-graduation-cap' }}"></i>
                    </div>
                    <h3>{{ $program->nama }}</h3>
                </div>
                <div class="program-card-body">
                    <p>{{ $program->deskripsi }}</p>
                    @if($program->fitur && is_array($program->fitur))
                    <ul class="program-features">
                        <li><i class="fas fa-check-circle"></i> {{ $program->jadwal }}</li>
                        @foreach($program->fitur as $fitur)
                        <li><i class="fas fa-check-circle"></i> {{ $fitur }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @empty
            <!-- Default cards if no data -->
            <div class="program-card">
                <div class="program-card-header">
                    <div class="icon"><i class="fas fa-sun"></i></div>
                    <h3>Kelas Pagi</h3>
                </div>
                <div class="program-card-body">
                    <p>Program kuliah pagi dengan jadwal pembelajaran di pagi hari.</p>
                    <ul class="program-features">
                        <li><i class="fas fa-check-circle"></i> Senin - Jumat (07.00 - 12.00)</li>
                        <li><i class="fas fa-check-circle"></i> Tatap muka langsung</li>
                        <li><i class="fas fa-check-circle"></i> Akses lab komputer penuh</li>
                    </ul>
                </div>
            </div>
            <div class="program-card">
                <div class="program-card-header">
                    <div class="icon"><i class="fas fa-cloud-sun"></i></div>
                    <h3>Kelas Siang</h3>
                </div>
                <div class="program-card-body">
                    <p>Program kuliah siang dengan jadwal pembelajaran di siang hingga sore hari.</p>
                    <ul class="program-features">
                        <li><i class="fas fa-check-circle"></i> Senin - Jumat (12.00 - 18.00)</li>
                        <li><i class="fas fa-check-circle"></i> Tatap muka langsung</li>
                        <li><i class="fas fa-check-circle"></i> Akses lab komputer penuh</li>
                    </ul>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Schedule Section -->
<section class="schedule-section">
    <div class="container">
        <div class="schedule-box">
            <div class="schedule-header">
                <i class="fas fa-clock"></i> Jadwal Perkuliahan
            </div>
            <table class="schedule-table">
                <thead>
                    <tr>
                        <th>Program</th>
                        <th>Jadwal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                    <tr>
                        <td><strong>{{ $program->nama }}</strong></td>
                        <td>{{ $program->jadwal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" style="text-align: center;">Belum ada data program</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
