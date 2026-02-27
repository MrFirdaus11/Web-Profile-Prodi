@extends('layouts.admin')

@section('title', 'Pengaturan - Admin')
@section('header', 'Pengaturan Akun')

@section('content')
<div class="settings-container">
    <!-- Profile Settings Card -->
    <div class="admin-card settings-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-user-circle"></i> Informasi Profil
            </h3>
        </div>
        <div class="admin-card-body">
            <form action="{{ route('admin.settings.profile') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                               value="{{ old('nama_lengkap', $admin->nama_lengkap) }}" required>
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
                               value="{{ old('username', $admin->username) }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $admin->email) }}" placeholder="admin@example.com">
                    <small class="form-hint">Email digunakan untuk pemulihan akun</small>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
    
    <!-- Password Settings Card -->
    <div class="admin-card settings-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">
                <i class="fas fa-lock"></i> Ubah Password
            </h3>
        </div>
        <div class="admin-card-body">
            <div class="security-notice">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>Keamanan Akun</strong>
                    <p>Gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol. Minimal 6 karakter.</p>
                </div>
            </div>
            
            <form action="{{ route('admin.settings.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label class="form-label">Password Saat Ini</label>
                    <div class="password-input-wrapper">
                        <input type="password" name="current_password" id="current_password" 
                               class="form-control @error('current_password') is-invalid @enderror" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label class="form-label">Password Baru</label>
                        <div class="password-input-wrapper">
                            <input type="password" name="new_password" id="new_password" 
                                   class="form-control @error('new_password') is-invalid @enderror" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group half">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <div class="password-input-wrapper">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                   class="form-control" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('new_password_confirmation')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-key"></i> Ubah Password
                </button>
            </form>
        </div>
    </div>
</div>

<style>
.settings-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

.settings-card {
    height: fit-content;
}

.form-hint {
    display: block;
    margin-top: 6px;
    font-size: 0.85rem;
    color: var(--gray-500);
}

.invalid-feedback {
    display: block;
    color: var(--danger);
    font-size: 0.85rem;
    margin-top: 6px;
}

.is-invalid {
    border-color: var(--danger) !important;
}

.security-notice {
    display: flex;
    gap: 16px;
    padding: 20px;
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(234, 179, 8, 0.05));
    border-radius: var(--radius);
    margin-bottom: 24px;
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.security-notice > i {
    font-size: 1.5rem;
    color: var(--warning);
    flex-shrink: 0;
}

.security-notice strong {
    color: var(--dark);
    display: block;
    margin-bottom: 4px;
}

.security-notice p {
    color: var(--gray-600);
    font-size: 0.9rem;
    margin: 0;
}

.password-input-wrapper {
    position: relative;
}

.password-input-wrapper input {
    padding-right: 48px;
}

.password-toggle {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 4px;
    transition: color 0.2s;
}

.password-toggle:hover {
    color: var(--primary);
}

@media (max-width: 992px) {
    .settings-container {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
