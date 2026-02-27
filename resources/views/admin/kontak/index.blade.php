@extends('layouts.admin')

@section('title', 'Kontak - Admin')
@section('header', 'Kelola Kontak')

@section('content')
<!-- Tab Navigation -->
<div class="admin-tabs">
    <button class="admin-tab active" data-tab="edit-kontak">
        <i class="fas fa-address-card"></i> Edit Kontak
    </button>
    <button class="admin-tab" data-tab="link-penting">
        <i class="fas fa-link"></i> Link Penting
    </button>
    <button class="admin-tab" data-tab="faq">
        <i class="fas fa-question-circle"></i> FAQ
    </button>
    <button class="admin-tab" data-tab="pesan-masuk">
        <i class="fas fa-inbox"></i> Pesan Masuk
    </button>
</div>

<!-- Tab Content -->
<div class="admin-tab-content">
    <!-- Tab 1: Edit Kontak -->
    <div class="admin-tab-pane active" id="edit-kontak">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-edit"></i> Edit Informasi Kontak
                </h3>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.kontak.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">Alamat <span style="color: var(--danger);">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                  rows="3" required placeholder="Masukkan alamat lengkap">{{ old('alamat', $alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half">
                            <label class="form-label">Telepon <span style="color: var(--danger);">*</span></label>
                            <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror" 
                                   value="{{ old('telepon', $telepon) }}" required placeholder="(0733) 123456">
                            @error('telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group half">
                            <label class="form-label">Email <span style="color: var(--danger);">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $email) }}" required placeholder="si@unpari.ac.id">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tab 2: Link Penting -->
    <div class="admin-tab-pane" id="link-penting">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-link"></i> Daftar Link Penting
                </h3>
                <button class="btn btn-primary btn-sm" onclick="showModal('addLinkModal')">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="admin-card-body" style="padding: 0;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Judul</th>
                            <th>URL</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($links as $index => $link)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $link->judul }}</td>
                            <td><a href="{{ $link->url }}" target="_blank" class="link-primary">{{ Str::limit($link->url, 40) }}</a></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editLink({{ $link->id }}, '{{ addslashes($link->judul) }}', '{{ $link->url }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kontak.link.destroy', $link) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus link ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada link</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab 3: FAQ -->
    <div class="admin-tab-pane" id="faq">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-question-circle"></i> Daftar FAQ
                </h3>
                <button class="btn btn-primary btn-sm" onclick="showModal('addFaqModal')">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="admin-card-body" style="padding: 0;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $index => $faq)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $faq->pertanyaan }}</td>
                            <td>{{ Str::limit($faq->jawaban, 60) }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editFaq({{ $faq->id }}, '{{ addslashes($faq->pertanyaan) }}', '{{ addslashes($faq->jawaban) }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kontak.faq.destroy', $faq) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus FAQ ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada FAQ</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tab 4: Pesan Masuk -->
    <div class="admin-tab-pane" id="pesan-masuk">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fas fa-inbox"></i> Pesan Masuk
                </h3>
            </div>
            <div class="admin-card-body" style="padding: 0;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pesan</th>
                            <th width="140">Tanggal</th>
                            <th width="100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesans as $index => $pesan)
                        <tr style="{{ !$pesan->dibaca ? 'font-weight: 600; background: #faf5ff;' : '' }}">
                            <td>{{ $pesans->firstItem() + $index }}</td>
                            <td>
                                {{ $pesan->nama }}
                                @if(!$pesan->dibaca)
                                    <span style="display: inline-block; width: 8px; height: 8px; background: var(--primary); border-radius: 50%; margin-left: 4px;"></span>
                                @endif
                            </td>
                            <td>{{ $pesan->email }}</td>
                            <td>{{ Str::limit($pesan->pesan, 50) }}</td>
                            <td>{{ $pesan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.kontak.pesan.show', $pesan->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.kontak.pesan.destroy', $pesan->id) }}" method="POST" style="display: inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">Belum ada pesan masuk</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @if($pesans->hasPages())
                <div style="padding: 16px; display: flex; justify-content: center;">
                    {{ $pesans->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal: Add Link -->
<div class="modal-overlay" id="addLinkModal">
    <div class="modal-box">
        <form action="{{ route('admin.kontak.link.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Tambah Link Penting</h3>
                <button type="button" class="modal-close" onclick="hideModal('addLinkModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: K2025 Capaian Pembelajaran...">
                </div>
                <div class="form-group">
                    <label class="form-label">URL</label>
                    <input type="url" name="url" class="form-control" required placeholder="https://...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('addLinkModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit Link -->
<div class="modal-overlay" id="editLinkModal">
    <div class="modal-box">
        <form id="editLinkForm" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit Link Penting</h3>
                <button type="button" class="modal-close" onclick="hideModal('editLinkModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" id="editLinkJudul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">URL</label>
                    <input type="url" name="url" id="editLinkUrl" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('editLinkModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Add FAQ -->
<div class="modal-overlay" id="addFaqModal">
    <div class="modal-box">
        <form action="{{ route('admin.kontak.faq.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Tambah FAQ</h3>
                <button type="button" class="modal-close" onclick="hideModal('addFaqModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" class="form-control" required placeholder="Masukkan pertanyaan...">
                </div>
                <div class="form-group">
                    <label class="form-label">Jawaban</label>
                    <textarea name="jawaban" class="form-control" rows="4" required placeholder="Masukkan jawaban..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('addFaqModal')">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal: Edit FAQ -->
<div class="modal-overlay" id="editFaqModal">
    <div class="modal-box">
        <form id="editFaqForm" method="POST">
            @csrf @method('PUT')
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Edit FAQ</h3>
                <button type="button" class="modal-close" onclick="hideModal('editFaqModal')">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" name="pertanyaan" id="editFaqPertanyaan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Jawaban</label>
                    <textarea name="jawaban" id="editFaqJawaban" class="form-control" rows="4" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="hideModal('editFaqModal')">Batal</button>
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
        document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.admin-tab-pane').forEach(p => p.classList.remove('active'));
        
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

// Edit Link
function editLink(id, judul, url) {
    document.getElementById('editLinkForm').action = '{{ url("admin/kontak/link") }}/' + id;
    document.getElementById('editLinkJudul').value = judul;
    document.getElementById('editLinkUrl').value = url;
    showModal('editLinkModal');
}

// Edit FAQ
function editFaq(id, pertanyaan, jawaban) {
    document.getElementById('editFaqForm').action = '{{ url("admin/kontak/faq") }}/' + id;
    document.getElementById('editFaqPertanyaan').value = pertanyaan;
    document.getElementById('editFaqJawaban').value = jawaban;
    showModal('editFaqModal');
}
</script>
@endsection
