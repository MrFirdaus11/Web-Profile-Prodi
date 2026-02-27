@extends('layouts.admin')

@section('title', 'Kelola Akademik')
@section('header', 'Kelola Akademik')

@section('content')
<!-- Tab Navigation -->
<div class="admin-tabs">
    <button class="admin-tab active" data-tab="info-akademik">
        <i class="fas fa-info-circle"></i> Informasi Akademik
    </button>

    <button class="admin-tab" data-tab="bagan">
        <i class="fas fa-sitemap"></i> Bagan Kurikulum
    </button>
    <button class="admin-tab" data-tab="rps">
        <i class="fas fa-book"></i> Mata Kuliah & RPS
    </button>
</div>

<!-- Tab Content -->
<div class="admin-tab-content">
    <!-- Tab 1: Informasi Akademik -->
    <div class="admin-tab-pane active" id="info-akademik">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-graduation-cap"></i> Informasi Dasar Akademik
                </h3>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.akademik.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group half">
                            <label class="form-label">Gelar Lulusan</label>
                            <input type="text" name="gelar" class="form-control" 
                                   value="{{ old('gelar', $gelar) }}" placeholder="Sarjana Komputer (S.Kom)">
                        </div>
                        
                        <div class="form-group half">
                            <label class="form-label">Durasi Studi</label>
                            <input type="text" name="durasi_studi" class="form-control" 
                                   value="{{ old('durasi_studi', $durasi) }}" placeholder="4 Tahun (8 Semester)">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Total SKS</label>
                        <input type="text" name="total_sks" class="form-control" 
                               value="{{ old('total_sks', $sks) }}" placeholder="144 SKS">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Deskripsi Kurikulum</label>
                        <textarea name="kurikulum" class="form-control" rows="4">{{ old('kurikulum', $kurikulum) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Fasilitas (satu per baris)</label>
                        <textarea name="fasilitas" class="form-control" rows="5" 
                                  placeholder="Lab Komputer&#10;Perpustakaan&#10;Wifi Kampus">{{ old('fasilitas', $fasilitas) }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>



    <!-- Tab 3: Bagan Kurikulum -->
    <div class="admin-tab-pane" id="bagan">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-sitemap"></i> Bagan & Daftar Mata Kuliah per Angkatan
                </h3>
                <button class="btn btn-primary btn-sm" onclick="showModal('addBaganModal')">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="admin-card-body" style="padding: 0;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Angkatan</th>
                            <th>Link Bagan</th>
                            <th>Link Daftar Matkul</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bagans as $bagan)
                        <tr>
                            <td><strong>{{ $bagan->angkatan }}</strong></td>
                            <td>
                                @if($bagan->link_bagan)
                                    <a href="{{ $bagan->link_bagan }}" target="_blank" class="link-primary">
                                        <i class="fas fa-external-link-alt"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($bagan->link_matkul)
                                    <a href="{{ $bagan->link_matkul }}" target="_blank" class="link-primary">
                                        <i class="fas fa-external-link-alt"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editBagan({{ $bagan->id }}, '{{ $bagan->angkatan }}', '{{ $bagan->link_bagan }}', '{{ $bagan->link_matkul }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kurikulum.bagan.destroy', $bagan) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab 4: Mata Kuliah & RPS -->
    <div class="admin-tab-pane" id="rps">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-book"></i> Daftar Mata Kuliah & RPS per Semester
                </h3>
                <button class="btn btn-primary btn-sm" onclick="showModal('addMatkulModal')">
                    <i class="fas fa-plus"></i> Tambah Mata Kuliah
                </button>
            </div>
            <div class="admin-card-body">
                @for($semester = 1; $semester <= 8; $semester++)
                <div class="semester-section">
                    <h4 class="semester-title">
                        <i class="fas fa-graduation-cap"></i> Semester {{ $semester }}
                    </h4>
                    <table class="admin-table admin-table-sm">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Kode</th>
                                <th>Nama Mata Kuliah</th>
                                <th width="60">SKS</th>
                                <th width="80">RPS</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $mks = $mataKuliahs->get($semester, collect()); @endphp
                            @forelse($mks as $index => $mk)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><code>{{ $mk->kode }}</code></td>
                                <td>{{ $mk->nama }}</td>
                                <td class="text-center"><strong>{{ $mk->sks }}</strong></td>
                                <td class="text-center">
                                    @if($mk->file_rps)
                                        <a href="{{ asset('assets/files/rps/' . $mk->file_rps) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editMatkul({{ $mk->id }}, {{ $mk->semester }}, '{{ $mk->kode }}', '{{ addslashes($mk->nama) }}', {{ $mk->sks }})">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.kurikulum.matkul.destroy', $mk) }}" method="POST" style="display: inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center text-muted">Belum ada mata kuliah</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Modals -->


<!-- Modal: Add Bagan -->
<div class="modal-overlay" id="addBaganModal">
    <div class="modal-box">
        <form action="{{ route('admin.kurikulum.bagan.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Tambah Bagan Kurikulum</h3>
                <button type="button" class="modal-close" onclick="hideModal('addBaganModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Angkatan</label>
                    <input type="text" name="angkatan" class="form-control" required placeholder="Contoh: 2023 s.d 2024">
                </div>
                <div class="form-group">
                    <label class="form-label">Link Bagan Kurikulum</label>
                    <input type="url" name="link_bagan" class="form-control" placeholder="https://...">
                </div>
                <div class="form-group">
                    <label class="form-label">Link Daftar Mata Kuliah</label>
                    <input type="url" name="link_matkul" class="form-control" placeholder="https://...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('addBaganModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Bagan -->
<div class="modal-overlay" id="editBaganModal">
    <div class="modal-box">
        <form id="editBaganForm" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Bagan Kurikulum</h3>
                <button type="button" class="modal-close" onclick="hideModal('editBaganModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Angkatan</label>
                    <input type="text" name="angkatan" id="editBaganAngkatan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Link Bagan Kurikulum</label>
                    <input type="url" name="link_bagan" id="editBaganLinkBagan" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Link Daftar Mata Kuliah</label>
                    <input type="url" name="link_matkul" id="editBaganLinkMatkul" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('editBaganModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Add Matkul -->
<div class="modal-overlay" id="addMatkulModal">
    <div class="modal-box">
        <form action="{{ route('admin.kurikulum.matkul.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Tambah Mata Kuliah</h3>
                <button type="button" class="modal-close" onclick="hideModal('addMatkulModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Semester</label>
                    <select name="semester" class="form-control" required>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control" required placeholder="SI001">
                    </div>
                    <div class="form-group half">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control" min="1" max="6" required value="2">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama" class="form-control" required placeholder="Pendidikan Pancasila">
                </div>
                <div class="form-group">
                    <label class="form-label">File RPS (PDF/DOC)</label>
                    <input type="file" name="file_rps" class="form-control" accept=".pdf,.doc,.docx">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('addMatkulModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Matkul -->
<div class="modal-overlay" id="editMatkulModal">
    <div class="modal-box">
        <form id="editMatkulForm" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Mata Kuliah</h3>
                <button type="button" class="modal-close" onclick="hideModal('editMatkulModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Semester</label>
                    <select name="semester" id="editMatkulSemester" class="form-control" required>
                        @for($i = 1; $i <= 8; $i++)
                            <option value="{{ $i }}">Semester {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" id="editMatkulKode" class="form-control" required>
                    </div>
                    <div class="form-group half">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" id="editMatkulSks" class="form-control" min="1" max="6" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama" id="editMatkulNama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">File RPS Baru (kosongkan jika tidak ganti)</label>
                    <input type="file" name="file_rps" class="form-control" accept=".pdf,.doc,.docx">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('editMatkulModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Tab functionality
document.querySelectorAll('.admin-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        // Remove active from all tabs
        document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.admin-tab-pane').forEach(p => p.classList.remove('active'));
        
        // Add active to clicked tab
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});

// Modal functions
function showModal(id) {
    document.getElementById(id).classList.add('active');
}

function hideModal(id) {
    document.getElementById(id).classList.remove('active');
}

// Close modal on outside click
document.querySelectorAll('.modal-overlay').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
});

// Edit functions


function editBagan(id, angkatan, linkBagan, linkMatkul) {
    document.getElementById('editBaganForm').action = '{{ url("admin/kurikulum/bagan") }}/' + id;
    document.getElementById('editBaganAngkatan').value = angkatan;
    document.getElementById('editBaganLinkBagan').value = linkBagan || '';
    document.getElementById('editBaganLinkMatkul').value = linkMatkul || '';
    showModal('editBaganModal');
}

function editMatkul(id, semester, kode, nama, sks) {
    document.getElementById('editMatkulForm').action = '{{ url("admin/kurikulum/matkul") }}/' + id;
    document.getElementById('editMatkulSemester').value = semester;
    document.getElementById('editMatkulKode').value = kode;
    document.getElementById('editMatkulNama').value = nama;
    document.getElementById('editMatkulSks').value = sks;
    showModal('editMatkulModal');
}
</script>
@endsection
