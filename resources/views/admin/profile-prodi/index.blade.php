@extends('layouts.admin')

@section('title', 'Profile Prodi - Admin')
@section('header', 'Profile Prodi')

@section('styles')
<style>
    /* Modern Tab Navigation */
    .modern-tabs {
        display: flex;
        gap: 6px;
        padding: 8px;
        background: linear-gradient(145deg, #f8fafc, #e2e8f0);
        border-radius: 16px;
        margin-bottom: 28px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    }
    
    .modern-tab-btn {
        flex: 1;
        padding: 14px 20px;
        border: none;
        background: transparent;
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        position: relative;
    }
    
    .modern-tab-btn i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }
    
    .modern-tab-btn:hover {
        color: var(--primary);
        background: rgba(124, 58, 237, 0.08);
    }
    
    .modern-tab-btn:hover i {
        transform: scale(1.1);
    }
    
    .modern-tab-btn.active {
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
    }
    
    .modern-tab-btn.active i {
        transform: scale(1.1);
    }
    
    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Modern Card Sections */
    .modern-section {
        background: white;
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .modern-section:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }
    
    .section-header-modern {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 24px;
        padding-bottom: 18px;
        border-bottom: 2px solid #f1f5f9;
    }
    
    .section-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
    }
    
    .section-title-group h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }
    
    .section-title-group p {
        font-size: 0.85rem;
        color: #94a3b8;
        margin: 0;
    }
    
    /* Modern Form Styles */
    .modern-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .modern-form-grid.three-cols {
        grid-template-columns: repeat(3, 1fr);
    }
    
    @media (max-width: 768px) {
        .modern-tabs {
            flex-wrap: wrap;
        }
        .modern-tab-btn {
            min-width: calc(50% - 6px);
        }
        .modern-form-grid, .modern-form-grid.three-cols {
            grid-template-columns: 1fr;
        }
    }
    
    .modern-form-group {
        margin-bottom: 20px;
    }
    
    .modern-form-group label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .modern-form-group label .required {
        color: #ef4444;
    }
    
    .modern-form-group input,
    .modern-form-group textarea,
    .modern-form-group select {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.95rem;
        color: #1f2937;
        background: #fafafa;
        transition: all 0.2s ease;
    }
    
    .modern-form-group input:focus,
    .modern-form-group textarea:focus,
    .modern-form-group select:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }
    
    .modern-form-group textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .modern-form-group small {
        display: block;
        margin-top: 6px;
        font-size: 0.8rem;
        color: #9ca3af;
    }
    
    /* Photo Upload */
    .photo-upload-zone {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 20px;
        background: linear-gradient(145deg, #f8fafc, #f1f5f9);
        border: 2px dashed #d1d5db;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    
    .photo-upload-zone:hover {
        border-color: var(--primary);
        background: linear-gradient(145deg, #faf5ff, #f3e8ff);
    }
    
    .photo-preview-modern {
        width: 100px;
        height: 100px;
        border-radius: 16px;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 3px solid white;
    }
    
    .photo-preview-modern img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .photo-preview-modern i {
        font-size: 2.5rem;
        color: #d1d5db;
    }
    
    .photo-upload-content {
        flex: 1;
    }
    
    .photo-upload-content h5 {
        font-size: 0.95rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }
    
    .photo-upload-content p {
        font-size: 0.8rem;
        color: #9ca3af;
        margin-bottom: 12px;
    }
    
    /* Modern Buttons */
    .btn-modern {
        padding: 14px 28px;
        border: none;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .btn-modern-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }
    
    .btn-modern-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }
    
    .btn-modern-outline {
        background: transparent;
        border: 2px solid #e5e7eb;
        color: #64748b;
    }
    
    .btn-modern-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: rgba(124, 58, 237, 0.05);
    }
    
    .btn-modern-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }
    
    .btn-modern-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    /* Staff Items */
    .staff-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .staff-card-modern {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        transition: all 0.2s ease;
    }
    
    .staff-card-modern:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }
    
    .staff-card-modern .staff-inputs {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    
    .staff-card-modern input {
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.875rem;
    }
    
    .staff-card-modern input:focus {
        outline: none;
        border-color: var(--primary);
    }
    
    .btn-remove-staff {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        border: none;
        background: #fef2f2;
        color: #dc2626;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .btn-remove-staff:hover {
        background: #dc2626;
        color: white;
    }
    
    .btn-add-staff {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px;
        background: #f8fafc;
        border: 2px dashed #d1d5db;
        border-radius: 14px;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-add-staff:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: #faf5ff;
    }
    
    /* Modern Table */
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .modern-table thead tr {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .modern-table thead th {
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
    }
    
    .modern-table thead th:first-child {
        border-radius: 12px 0 0 0;
    }
    
    .modern-table thead th:last-child {
        border-radius: 0 12px 0 0;
    }
    
    .modern-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .modern-table tbody tr:hover {
        background: #faf5ff;
    }
    
    .modern-table tbody td {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }
    
    .table-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--primary) 0%, #8b5cf6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        box-shadow: 0 3px 10px rgba(124, 58, 237, 0.25);
    }
    
    .table-avatar {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #f1f5f9;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    
    .table-avatar-placeholder {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(145deg, #f8fafc, #e2e8f0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
    }
    
    .badge-modern {
        display: inline-flex;
        align-items: center;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .badge-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #047857;
    }
    
    .badge-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #dc2626;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .btn-action-edit {
        background: #f0f9ff;
        color: #0284c7;
    }
    
    .btn-action-edit:hover {
        background: #0284c7;
        color: white;
    }
    
    .btn-action-delete {
        background: #fef2f2;
        color: #dc2626;
    }
    
    .btn-action-delete:hover {
        background: #dc2626;
        color: white;
    }
    
    /* Page Header */
    .page-header-modern {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    
    .page-header-modern h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #e2e8f0;
        margin-bottom: 20px;
    }
    
    .empty-state h4 {
        font-size: 1.1rem;
        color: #64748b;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        color: #94a3b8;
        font-size: 0.9rem;
    }
    
    /* Form Actions */
    .form-actions-modern {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 24px;
        border-top: 2px solid #f1f5f9;
        margin-top: 8px;
    }
</style>
@endsection

@section('content')
<div class="admin-card">
    <div class="admin-card-body" style="padding: 24px;">
        <!-- Modern Tabs -->
        <div class="modern-tabs">
            <button class="modern-tab-btn active" onclick="showTab('sambutan')">
                <i class="fas fa-comment-dots"></i>
                <span>Sambutan</span>
            </button>
            <button class="modern-tab-btn" onclick="showTab('visimisi')">
                <i class="fas fa-bullseye"></i>
                <span>Visi & Misi</span>
            </button>
            <button class="modern-tab-btn" onclick="showTab('struktur')">
                <i class="fas fa-sitemap"></i>
                <span>Struktur</span>
            </button>
            <button class="modern-tab-btn" onclick="showTab('program')">
                <i class="fas fa-layer-group"></i>
                <span>Program Kelas</span>
            </button>
            <button class="modern-tab-btn" onclick="showTab('dosen')">
                <i class="fas fa-chalkboard-teacher"></i>
                <span>Dosen</span>
            </button>
        </div>
        
        <!-- Tab: Sambutan -->
        <div id="tab-sambutan" class="tab-content active">
            <form action="{{ route('admin.profile-prodi.sambutan.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modern-section">
                    <div class="section-header-modern">
                        <div class="section-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="section-title-group">
                            <h4>Informasi Ketua Prodi</h4>
                            <p>Kelola informasi pejabat yang akan ditampilkan</p>
                        </div>
                    </div>
                    
                    <div class="modern-form-grid">
                        <div class="modern-form-group">
                            <label>Nama Lengkap <span class="required">*</span></label>
                            <input type="text" name="kaprodi_nama" value="{{ old('kaprodi_nama', $kaprodi_nama) }}" required placeholder="Masukkan nama lengkap beserta gelar">
                            @error('kaprodi_nama')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                        </div>
                        <div class="modern-form-group">
                            <label>Jabatan <span class="required">*</span></label>
                            <input type="text" name="kaprodi_jabatan" value="{{ old('kaprodi_jabatan', $kaprodi_jabatan) }}" required placeholder="Contoh: Ketua Program Studi">
                            @error('kaprodi_jabatan')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label>Foto Profil</label>
                        <div class="photo-upload-zone">
                            <div class="photo-preview-modern">
                                @if($kaprodi_foto)
                                    <img src="{{ asset('assets/img/profil/' . $kaprodi_foto) }}" alt="Foto">
                                @else
                                    <i class="fas fa-user-tie"></i>
                                @endif
                            </div>
                            <div class="photo-upload-content">
                                <h5>Upload Foto Baru</h5>
                                <p>Format: JPG, PNG • Max: 2MB</p>
                                <input type="file" name="kaprodi_foto" accept="image/jpeg,image/png" style="font-size: 0.85rem;">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modern-section">
                    <div class="section-header-modern">
                        <div class="section-icon">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="section-title-group">
                            <h4>Isi Kata Sambutan</h4>
                            <p>Teks yang akan ditampilkan di halaman sambutan</p>
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label>Teks Sambutan <span class="required">*</span></label>
                        <textarea name="sambutan" rows="8" required placeholder="Tuliskan kata sambutan dari ketua prodi...">{{ old('sambutan', $sambutan) }}</textarea>
                        @error('sambutan')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                    </div>
                    
                    <div class="form-actions-modern">
                        <button type="submit" class="btn-modern btn-modern-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Tab: Visi Misi -->
        <div id="tab-visimisi" class="tab-content">
            <form action="{{ route('admin.profile-prodi.visimisi.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modern-section">
                    <div class="section-header-modern">
                        <div class="section-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="section-title-group">
                            <h4>Visi Program Studi</h4>
                            <p>Gambaran besar tujuan yang ingin dicapai</p>
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label>Visi <span class="required">*</span></label>
                        <textarea name="visi" rows="4" required placeholder="Contoh: Menjadi program studi unggulan...">{{ old('visi', $visi) }}</textarea>
                        @error('visi')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                    </div>
                </div>
                
                <div class="modern-section">
                    <div class="section-header-modern">
                        <div class="section-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <div class="section-title-group">
                            <h4>Misi Program Studi</h4>
                            <p>Langkah-langkah untuk mencapai visi</p>
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label>Misi <span class="required">*</span></label>
                        <textarea name="misi" rows="8" required placeholder="Tuliskan setiap poin misi di baris baru...">{{ old('misi', $misi) }}</textarea>
                        <small><i class="fas fa-info-circle"></i> Pisahkan setiap poin misi dengan menekan Enter</small>
                        @error('misi')<small style="color: #ef4444;">{{ $message }}</small>@enderror
                    </div>
                    
                    <div class="form-actions-modern">
                        <button type="submit" class="btn-modern btn-modern-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Tab: Struktur -->
        <div id="tab-struktur" class="tab-content">
            <form action="{{ route('admin.profile-prodi.struktur.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="modern-section">
                    <div class="section-header-modern">
                        <div class="section-icon">
                            <i class="fas fa-sitemap"></i>
                        </div>
                        <div class="section-title-group">
                            <h4>Gambar Struktur Organisasi</h4>
                            <p>Upload gambar bagan struktur organisasi program studi</p>
                        </div>
                    </div>
                    
                    <div style="text-align: center; padding: 40px 20px;">
                        <!-- Image Preview -->
                        <div style="margin-bottom: 24px;">
                            @if($struktur_image)
                                <img src="{{ asset('assets/img/struktur/' . $struktur_image) }}" 
                                     alt="Struktur Organisasi" 
                                     style="max-width: 100%; max-height: 500px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.12); border: 4px solid #f1f5f9;">
                            @else
                                <div style="padding: 60px 40px; background: linear-gradient(145deg, #f8fafc, #e2e8f0); border-radius: 16px; border: 2px dashed #cbd5e1;">
                                    <i class="fas fa-image" style="font-size: 4rem; color: #94a3b8; margin-bottom: 16px;"></i>
                                    <p style="color: #64748b; font-size: 1rem; margin: 0;">Belum ada gambar struktur organisasi</p>
                                    <small style="color: #94a3b8;">Upload gambar untuk ditampilkan di halaman publik</small>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Upload Area -->
                        <div style="max-width: 500px; margin: 0 auto;">
                            <div style="padding: 24px; background: linear-gradient(145deg, #faf5ff, #f5f3ff); border-radius: 16px; border: 2px dashed #c4b5fd;">
                                <i class="fas fa-cloud-upload-alt" style="font-size: 2.5rem; color: #7c3aed; margin-bottom: 12px;"></i>
                                <h5 style="font-size: 1rem; font-weight: 600; color: #5b21b6; margin-bottom: 8px;">Upload Gambar Baru</h5>
                                <p style="color: #7c3aed; font-size: 0.85rem; margin-bottom: 16px;">Format: JPG, PNG • Max: 5MB</p>
                                <input type="file" name="struktur_image" accept="image/jpeg,image/png" 
                                       style="padding: 10px; background: white; border-radius: 8px; border: 1px solid #e9d5ff; width: 100%;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions-modern">
                        <button type="submit" class="btn-modern btn-modern-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Tab: Program Kelas -->
        <div id="tab-program" class="tab-content">
            <div class="page-header-modern">
                <h3>Daftar Program Kelas</h3>
                <a href="{{ route('admin.profile-prodi.program.create') }}" class="btn-modern btn-modern-primary">
                    <i class="fas fa-plus"></i> Tambah Program
                </a>
            </div>
            
            <div class="modern-section" style="padding: 0; overflow: hidden;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 70px;">Icon</th>
                            <th>Nama Program</th>
                            <th>Jadwal</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programKelas as $index => $program)
                        <tr>
                            <td style="font-weight: 600; color: #64748b;">{{ $index + 1 }}</td>
                            <td>
                                <div class="table-icon">
                                    <i class="fas {{ $program->icon ?: 'fa-graduation-cap' }}"></i>
                                </div>
                            </td>
                            <td>
                                <strong style="color: #1e293b;">{{ $program->nama }}</strong>
                            </td>
                            <td style="color: #64748b;">{{ $program->jadwal }}</td>
                            <td>
                                @if($program->aktif)
                                    <span class="badge-modern badge-success">
                                        <i class="fas fa-check-circle" style="margin-right: 4px;"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge-modern badge-danger">
                                        <i class="fas fa-times-circle" style="margin-right: 4px;"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.profile-prodi.program.edit', $program->id) }}" class="btn-action btn-action-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.profile-prodi.program.destroy', $program->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus program ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-action-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-layer-group"></i>
                                    <h4>Belum ada program kelas</h4>
                                    <p>Klik tombol "Tambah Program" untuk menambahkan program baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Tab: Profil Dosen -->
        <div id="tab-dosen" class="tab-content">
            <div class="page-header-modern">
                <h3>Daftar Dosen</h3>
                <a href="{{ route('admin.profile-prodi.dosen.create') }}" class="btn-modern btn-modern-primary">
                    <i class="fas fa-plus"></i> Tambah Dosen
                </a>
            </div>
            
            <div class="modern-section" style="padding: 0; overflow: hidden;">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 70px;">Foto</th>
                            <th>Nama</th>
                            <th>NIDN</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dosens as $index => $dosen)
                        <tr>
                            <td style="font-weight: 600; color: #64748b;">{{ $index + 1 }}</td>
                            <td>
                                @if($dosen->foto)
                                    <img src="{{ asset('assets/img/dosen/' . $dosen->foto) }}" alt="{{ $dosen->nama }}" class="table-avatar">
                                @else
                                    <div class="table-avatar-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong style="color: #1e293b;">{{ $dosen->nama }}</strong>
                                @if($dosen->bidang_keahlian)
                                    <br><small style="color: #94a3b8;">{{ $dosen->bidang_keahlian }}</small>
                                @endif
                            </td>
                            <td style="color: #64748b;">{{ $dosen->nidn ?: '-' }}</td>
                            <td style="color: #64748b;">{{ $dosen->jabatan }}</td>
                            <td style="color: #64748b;">{{ $dosen->email ?: '-' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.profile-prodi.dosen.edit', $dosen->id) }}" class="btn-action btn-action-edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.profile-prodi.dosen.destroy', $dosen->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus dosen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-action-delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <h4>Belum ada data dosen</h4>
                                    <p>Klik tombol "Tambah Dosen" untuk menambahkan dosen baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showTab(tab) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.modern-tab-btn').forEach(el => el.classList.remove('active'));
        
        // Show selected tab
        document.getElementById('tab-' + tab).classList.add('active');
        event.target.closest('.modern-tab-btn').classList.add('active');
    }
    
    function addStaff() {
        const container = document.getElementById('staff-container');
        const staffCard = document.createElement('div');
        staffCard.className = 'staff-card-modern';
        staffCard.innerHTML = `
            <div class="staff-inputs">
                <input type="text" name="staff_nama[]" value="" placeholder="Nama Staff">
                <input type="text" name="staff_jabatan[]" value="" placeholder="Jabatan">
            </div>
            <button type="button" class="btn-remove-staff" onclick="removeStaff(this)">
                <i class="fas fa-trash"></i>
            </button>
        `;
        container.appendChild(staffCard);
    }
    
    function removeStaff(btn) {
        btn.closest('.staff-card-modern').remove();
    }
</script>
@endsection
