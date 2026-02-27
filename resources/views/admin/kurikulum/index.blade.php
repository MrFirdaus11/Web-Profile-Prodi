@extends('layouts.admin')

@section('title', 'Kurikulum & RPS')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Kurikulum & RPS</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="kurikulumTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button">
                <i class="fas fa-link me-2"></i>Informasi Penting
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="bagan-tab" data-bs-toggle="tab" data-bs-target="#bagan" type="button">
                <i class="fas fa-sitemap me-2"></i>Bagan Kurikulum
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="rps-tab" data-bs-toggle="tab" data-bs-target="#rps" type="button">
                <i class="fas fa-book me-2"></i>Mata Kuliah / RPS
            </button>
        </li>
    </ul>

    <div class="tab-content" id="kurikulumTabsContent">
        <!-- Tab 1: Informasi Penting -->
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Link Informasi Penting</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addInfoModal">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>URL</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($infos as $index => $info)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $info->judul }}</td>
                                <td><a href="{{ $info->url }}" target="_blank">{{ Str::limit($info->url, 50) }}</a></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editInfo({{ $info->id }}, '{{ $info->judul }}', '{{ $info->url }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.kurikulum.info.destroy', $info) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
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

        <!-- Tab 2: Bagan Kurikulum -->
        <div class="tab-pane fade" id="bagan" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Bagan dan Daftar Mata Kuliah per Angkatan</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBaganModal">
                            <i class="fas fa-plus me-1"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Angkatan</th>
                                <th>Link Bagan</th>
                                <th>Link Daftar Matkul</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bagans as $bagan)
                            <tr>
                                <td>{{ $bagan->angkatan }}</td>
                                <td>
                                    @if($bagan->link_bagan)
                                        <a href="{{ $bagan->link_bagan }}" target="_blank" class="text-primary">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($bagan->link_matkul)
                                        <a href="{{ $bagan->link_matkul }}" target="_blank" class="text-primary">Lihat</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editBagan({{ $bagan->id }}, '{{ $bagan->angkatan }}', '{{ $bagan->link_bagan }}', '{{ $bagan->link_matkul }}')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.kurikulum.bagan.destroy', $bagan) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">
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

        <!-- Tab 3: Mata Kuliah / RPS -->
        <div class="tab-pane fade" id="rps" role="tabpanel">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Mata Kuliah & RPS per Semester</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMatkulModal">
                            <i class="fas fa-plus me-1"></i> Tambah Mata Kuliah
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    @for($semester = 1; $semester <= 8; $semester++)
                    <div class="mb-4">
                        <h6 class="fw-bold text-primary mb-3">
                            <i class="fas fa-graduation-cap me-2"></i>Semester {{ $semester }}
                        </h6>
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th width="60">No</th>
                                    <th width="100">Kode</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th width="60">SKS</th>
                                    <th width="100">File RPS</th>
                                    <th width="120">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $mks = $mataKuliahs->get($semester, collect()); @endphp
                                @forelse($mks as $index => $mk)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $mk->kode }}</td>
                                    <td>{{ $mk->nama }}</td>
                                    <td class="text-center">{{ $mk->sks }}</td>
                                    <td>
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
                                        <form action="{{ route('admin.kurikulum.matkul.destroy', $mk) }}" method="POST" class="d-inline">
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
</div>

<!-- Modal: Add Info -->
<div class="modal fade" id="addInfoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kurikulum.info.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Informasi Penting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" required placeholder="Contoh: K2025 Capaian Pembelajaran...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" name="url" class="form-control" required placeholder="https://...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Info -->
<div class="modal fade" id="editInfoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editInfoForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Informasi Penting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="judul" id="editInfoJudul" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="url" name="url" id="editInfoUrl" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Bagan -->
<div class="modal fade" id="addBaganModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kurikulum.bagan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bagan Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" class="form-control" required placeholder="Contoh: 2023 s.d 2024">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Bagan Kurikulum</label>
                        <input type="url" name="link_bagan" class="form-control" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Daftar Mata Kuliah</label>
                        <input type="url" name="link_matkul" class="form-control" placeholder="https://...">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Bagan -->
<div class="modal fade" id="editBaganModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBaganForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bagan Kurikulum</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Angkatan</label>
                        <input type="text" name="angkatan" id="editBaganAngkatan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Bagan Kurikulum</label>
                        <input type="url" name="link_bagan" id="editBaganLinkBagan" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link Daftar Mata Kuliah</label>
                        <input type="url" name="link_matkul" id="editBaganLinkMatkul" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Matkul -->
<div class="modal fade" id="addMatkulModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kurikulum.matkul.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" class="form-control" required placeholder="Contoh: SI001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="nama" class="form-control" required placeholder="Contoh: Pendidikan Pancasila">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control" min="1" max="6" required value="2">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File RPS (PDF/DOC)</label>
                        <input type="file" name="file_rps" class="form-control" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Matkul -->
<div class="modal fade" id="editMatkulModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editMatkulForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select name="semester" id="editMatkulSemester" class="form-select" required>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}">Semester {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" name="kode" id="editMatkulKode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Mata Kuliah</label>
                        <input type="text" name="nama" id="editMatkulNama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" id="editMatkulSks" class="form-control" min="1" max="6" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File RPS Baru (kosongkan jika tidak ganti)</label>
                        <input type="file" name="file_rps" class="form-control" accept=".pdf,.doc,.docx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function editInfo(id, judul, url) {
    document.getElementById('editInfoForm').action = '/Profile_prodi/public/admin/kurikulum/info/' + id;
    document.getElementById('editInfoJudul').value = judul;
    document.getElementById('editInfoUrl').value = url;
    new bootstrap.Modal(document.getElementById('editInfoModal')).show();
}

function editBagan(id, angkatan, linkBagan, linkMatkul) {
    document.getElementById('editBaganForm').action = '/Profile_prodi/public/admin/kurikulum/bagan/' + id;
    document.getElementById('editBaganAngkatan').value = angkatan;
    document.getElementById('editBaganLinkBagan').value = linkBagan || '';
    document.getElementById('editBaganLinkMatkul').value = linkMatkul || '';
    new bootstrap.Modal(document.getElementById('editBaganModal')).show();
}

function editMatkul(id, semester, kode, nama, sks) {
    document.getElementById('editMatkulForm').action = '/Profile_prodi/public/admin/kurikulum/matkul/' + id;
    document.getElementById('editMatkulSemester').value = semester;
    document.getElementById('editMatkulKode').value = kode;
    document.getElementById('editMatkulNama').value = nama;
    document.getElementById('editMatkulSks').value = sks;
    new bootstrap.Modal(document.getElementById('editMatkulModal')).show();
}
</script>
@endsection
