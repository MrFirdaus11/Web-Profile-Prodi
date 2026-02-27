<?php

use Illuminate\Support\Facades\Route;

// Reset Admin (hapus setelah digunakan)
require __DIR__.'/reset-admin.php';
use App\Http\Controllers\PublicController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DokumenController as AdminDokumenController;
use App\Http\Controllers\Admin\PesanController;
use App\Http\Controllers\Admin\ProfileProdiController;
use App\Http\Controllers\Admin\AkademikController;
use App\Http\Controllers\Admin\PeraturanController;
use App\Http\Controllers\Admin\KurikulumController;
use App\Http\Controllers\Admin\KontakController as AdminKontakController;

// =====================
// PUBLIC ROUTES
// =====================

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/akademik', [PublicController::class, 'akademik'])->name('akademik');

// Profil Sub-pages (dropdown menu)
Route::get('/profil/sambutan', [PublicController::class, 'sambutan'])->name('profil.sambutan');
Route::get('/profil/visi-misi', [PublicController::class, 'visiMisi'])->name('profil.visimisi');
Route::get('/profil/struktur', [PublicController::class, 'struktur'])->name('profil.struktur');
Route::get('/profil/program-kelas', [PublicController::class, 'programKelas'])->name('profil.program');
Route::get('/profil/dosen', [PublicController::class, 'dosen'])->name('profil.dosen');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');

Route::get('/faq', [PublicController::class, 'faq'])->name('faq');

// =====================
// ADMIN ROUTES
// =====================

Route::prefix('admin')->name('admin.')->group(function () {
    // Auth routes (tanpa middleware)
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected routes (dengan middleware)
    Route::middleware('admin')->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // Profile Prodi (Sambutan, Visi-Misi, Struktur, Program Kelas, Dosen)
        Route::get('/profile-prodi', [ProfileProdiController::class, 'index'])->name('profile-prodi.index');
        // Sambutan
        Route::put('/profile-prodi/sambutan', [ProfileProdiController::class, 'updateSambutan'])->name('profile-prodi.sambutan.update');
        // Visi Misi
        Route::put('/profile-prodi/visi-misi', [ProfileProdiController::class, 'updateVisiMisi'])->name('profile-prodi.visimisi.update');
        // Struktur
        Route::put('/profile-prodi/struktur', [ProfileProdiController::class, 'updateStruktur'])->name('profile-prodi.struktur.update');
        // Program Kelas
        Route::get('/profile-prodi/program/create', [ProfileProdiController::class, 'createProgram'])->name('profile-prodi.program.create');
        Route::post('/profile-prodi/program', [ProfileProdiController::class, 'storeProgram'])->name('profile-prodi.program.store');
        Route::get('/profile-prodi/program/{id}/edit', [ProfileProdiController::class, 'editProgram'])->name('profile-prodi.program.edit');
        Route::put('/profile-prodi/program/{id}', [ProfileProdiController::class, 'updateProgram'])->name('profile-prodi.program.update');
        Route::delete('/profile-prodi/program/{id}', [ProfileProdiController::class, 'destroyProgram'])->name('profile-prodi.program.destroy');
        // Dosen
        Route::get('/profile-prodi/dosen/create', [ProfileProdiController::class, 'createDosen'])->name('profile-prodi.dosen.create');
        Route::post('/profile-prodi/dosen', [ProfileProdiController::class, 'storeDosen'])->name('profile-prodi.dosen.store');
        Route::get('/profile-prodi/dosen/{id}/edit', [ProfileProdiController::class, 'editDosen'])->name('profile-prodi.dosen.edit');
        Route::put('/profile-prodi/dosen/{id}', [ProfileProdiController::class, 'updateDosen'])->name('profile-prodi.dosen.update');
        Route::delete('/profile-prodi/dosen/{id}', [ProfileProdiController::class, 'destroyDosen'])->name('profile-prodi.dosen.destroy');
        
        // Akademik
        Route::get('/akademik', [AkademikController::class, 'index'])->name('akademik.index');
        Route::put('/akademik', [AkademikController::class, 'update'])->name('akademik.update');
        
        // Berita CRUD
        Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
        Route::get('/berita/create', [AdminBeritaController::class, 'create'])->name('berita.create');
        Route::post('/berita', [AdminBeritaController::class, 'store'])->name('berita.store');
        Route::get('/berita/{id}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [AdminBeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');
        
        // Dokumen CRUD
        Route::get('/dokumen', [AdminDokumenController::class, 'index'])->name('dokumen.index');
        Route::get('/dokumen/create', [AdminDokumenController::class, 'create'])->name('dokumen.create');
        Route::post('/dokumen', [AdminDokumenController::class, 'store'])->name('dokumen.store');
        Route::get('/dokumen/{id}/edit', [AdminDokumenController::class, 'edit'])->name('dokumen.edit');
        Route::put('/dokumen/{id}', [AdminDokumenController::class, 'update'])->name('dokumen.update');
        Route::delete('/dokumen/{id}', [AdminDokumenController::class, 'destroy'])->name('dokumen.destroy');
        
        // Kontak (Edit Kontak + Link Penting + Pesan Masuk)
        Route::get('/kontak', [AdminKontakController::class, 'index'])->name('kontak.index');
        Route::put('/kontak', [AdminKontakController::class, 'updateKontak'])->name('kontak.update');
        // Link Penting
        Route::post('/kontak/link', [AdminKontakController::class, 'storeLink'])->name('kontak.link.store');
        Route::put('/kontak/link/{link}', [AdminKontakController::class, 'updateLink'])->name('kontak.link.update');
        Route::delete('/kontak/link/{link}', [AdminKontakController::class, 'destroyLink'])->name('kontak.link.destroy');
        // Pesan
        Route::get('/kontak/pesan/{id}', [AdminKontakController::class, 'showPesan'])->name('kontak.pesan.show');
        Route::delete('/kontak/pesan/{id}', [AdminKontakController::class, 'destroyPesan'])->name('kontak.pesan.destroy');
        // FAQ
        Route::post('/kontak/faq', [AdminKontakController::class, 'storeFaq'])->name('kontak.faq.store');
        Route::put('/kontak/faq/{faq}', [AdminKontakController::class, 'updateFaq'])->name('kontak.faq.update');
        Route::delete('/kontak/faq/{faq}', [AdminKontakController::class, 'destroyFaq'])->name('kontak.faq.destroy');
        
        // Peraturan
        Route::get('/peraturan', [PeraturanController::class, 'index'])->name('peraturan.index');
        Route::get('/peraturan/create', [PeraturanController::class, 'create'])->name('peraturan.create');
        Route::post('/peraturan', [PeraturanController::class, 'store'])->name('peraturan.store');
        Route::delete('/peraturan/{id}', [PeraturanController::class, 'destroy'])->name('peraturan.destroy');
        
        // Kurikulum & RPS
        Route::get('/kurikulum', [KurikulumController::class, 'index'])->name('kurikulum.index');
        // Bagan Kurikulum
        Route::post('/kurikulum/bagan', [KurikulumController::class, 'storeBagan'])->name('kurikulum.bagan.store');
        Route::put('/kurikulum/bagan/{bagan}', [KurikulumController::class, 'updateBagan'])->name('kurikulum.bagan.update');
        Route::delete('/kurikulum/bagan/{bagan}', [KurikulumController::class, 'destroyBagan'])->name('kurikulum.bagan.destroy');
        // Mata Kuliah / RPS
        Route::post('/kurikulum/matkul', [KurikulumController::class, 'storeMatkul'])->name('kurikulum.matkul.store');
        Route::put('/kurikulum/matkul/{matkul}', [KurikulumController::class, 'updateMatkul'])->name('kurikulum.matkul.update');
        Route::delete('/kurikulum/matkul/{matkul}', [KurikulumController::class, 'destroyMatkul'])->name('kurikulum.matkul.destroy');
        
        // Settings
        Route::get('/settings', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings/profile', [\App\Http\Controllers\Admin\SettingsController::class, 'updateProfile'])->name('settings.profile');
        Route::put('/settings/password', [\App\Http\Controllers\Admin\SettingsController::class, 'updatePassword'])->name('settings.password');
    });
});
