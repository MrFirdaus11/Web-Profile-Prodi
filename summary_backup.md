Berikut adalah **Functional Design Requirements (FDR)** dokumen yang berfokus secara spesifik pada **logika sistem, alur data, dan perilaku teknis** dari website Prodi Sistem Informasi UNPARI.

Dokumen ini menjadi panduan bagi *programmer* (Anda) untuk menulis kode logic (PHP & SQL).

---

# Functional Design Requirements (FDR)

**Nama Sistem:** Sistem Informasi & Profil Prodi SI UNPARI
**Platform:** Web-based (PHP Native, MySQL)
**Versi Dokumen:** 1.0

---

## 1. Arsitektur Sistem

Sistem dibangun dengan pola **prosedural modular** (pemisahan logika admin dan public) dengan struktur direktori yang telah disepakati:

* **Back-End (Admin):** Menangani logika CRUD (*Create, Read, Update, Delete*) dan manajemen sesi.
* **Front-End (Public):** Menangani logika *Fetch Data* (pengambilan data) untuk ditampilkan ke pengunjung.
* **Database:** Pusat penyimpanan data relasional.

---

## 2. Desain Database & Data Type (Schema)

Berikut adalah spesifikasi teknis tabel yang harus dibuat di MySQL.

### 2.1 Tabel `admin` (Autentikasi)

| Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id_admin` | INT(11) | Primary Key, Auto Increment |
| `username` | VARCHAR(50) | Unique, Index |
| `password` | VARCHAR(255) | Hash (`password_hash` PHP) |
| `nama_lengkap` | VARCHAR(100) | - |
| `last_login` | DATETIME | Timestamp login terakhir |

### 2.2 Tabel `berita` (Konten Dinamis)

| Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | INT(11) | Primary Key, Auto Increment |
| `judul` | VARCHAR(200) | - |
| `slug` | VARCHAR(255) | Untuk URL SEO Friendly (misal: `judul-berita-1`) |
| `isi_berita` | LONGTEXT | Mendukung format HTML (WYSIWYG) |
| `gambar` | VARCHAR(100) | Nama file gambar di folder `assets/img/berita/` |
| `tanggal` | DATE | - |
| `status` | ENUM | 'Published', 'Draft' |

### 2.3 Tabel `dokumen` (Repository)

| Kolom | Tipe Data | Keterangan |
| --- | --- | --- |
| `id` | INT(11) | Primary Key |
| `nama_dokumen` | VARCHAR(100) | Nama yang tampil di web |
| `nama_file` | VARCHAR(200) | Nama fisik file di `assets/files/` (Generated Unique ID) |
| `kategori` | ENUM | 'Akademik', 'Skripsi', 'Jadwal' |
| `tipe_file` | VARCHAR(10) | 'pdf', 'docx', 'xlsx' |
| `tgl_upload` | DATE | - |

### 2.4 Tabel `profil` & `akademik` (Data Statis)

*Menggunakan struktur kolom teks standar (TEXT/VARCHAR) sesuai kebutuhan konten.*

---

## 3. Spesifikasi Fungsional (Detail Logika)

### 3.1 Modul Autentikasi (Admin)

**Fungsi: Login**

1. **Input:** Username, Password.
2. **Proses:**
* Sanitasi input (cegah SQL Injection).
* Query SELECT berdasarkan username.
* Verifikasi password menggunakan `password_verify($input, $hash_db)`.
* Jika sukses: Buat `$_SESSION['admin_status'] = true` dan `$_SESSION['uid']`.
* Jika gagal: Redirect kembali dengan pesan error.


3. **Security Constraint:** Jika user mengakses halaman `/admin/*` tanpa session aktif, sistem wajib me-redirect paksa ke `login.php`.

**Fungsi: Logout**

1. **Proses:** `session_destroy()` dan `session_unset()`.
2. **Output:** Redirect ke halaman Login.

### 3.2 Modul Dashboard

**Fungsi: Statistik Real-time**

1. **Logika:** Melakukan query `COUNT(*)` pada tabel Berita, Dokumen, dan Pesan Masuk.
2. **Output:** Angka integer ditampilkan pada *widget* dashboard.

### 3.3 Modul Manajemen Berita (CRUD)

**Fungsi: Tambah Berita (Create)**

1. **Validasi File Gambar:**
* Cek ekstensi: hanya jpg, jpeg, png.
* Cek ukuran: maks 2MB.


2. **File Handling:**
* *Rename* file gambar menjadi unik (misal: `time() . random . .jpg`) untuk mencegah nama file duplikat.
* Pindahkan file (`move_uploaded_file`) ke `/assets/img/berita/`.


3. **Database:** Insert data judul, isi, nama file baru, dan tanggal hari ini.

**Fungsi: Edit Berita (Update)**

1. **Logika:**
* Jika user mengunggah gambar baru: Hapus gambar lama (gunakan fungsi `unlink`), upload gambar baru, update nama file di DB.
* Jika tidak ada gambar baru: Update judul/isi saja, pertahankan nama file lama.



**Fungsi: Hapus Berita (Delete)**

1. **Logika:**
* Ambil nama file gambar berdasarkan ID.
* Hapus fisik file gambar dari server (`unlink`).
* Hapus baris data dari database.



### 3.4 Modul Manajemen Dokumen

**Fungsi: Upload Dokumen**

1. **Validasi Ekstensi:** Wajib membatasi hanya ekstensi dokumen kerja (.pdf, .doc, .docx, .xls, .xlsx, .ppt). **Haramkan** ekstensi .php, .exe, .sh untuk keamanan server.
2. **Naming Convention:** Nama file fisik di server harus di-sanitize (hilangkan spasi/karakter aneh) atau di-hash agar link download tidak *broken*.

### 3.5 Modul Public (Pengunjung)

**Fungsi: Menampilkan Beranda**

1. **Query:** `SELECT * FROM berita ORDER BY tanggal DESC LIMIT 3`.
2. **View:** Loop data (foreach) ke dalam card HTML. Jika data kosong, tampilkan pesan "Belum ada berita".

**Fungsi: Download Counter (Opsional/Future)**

1. Saat tombol download diklik, sistem melakukan `UPDATE dokumen SET download_count = download_count + 1` sebelum menyajikan file.

**Fungsi: Form Kontak**

1. **Input:** Nama, Email, Pesan.
2. **Validasi:** Format email harus valid (`filter_var($email, FILTER_VALIDATE_EMAIL)`).
3. **Proses:** Insert ke tabel `pesan`. Tidak perlu mengirim email SMTP (cukup simpan di DB admin) untuk menyederhanakan prototype.

---

## 4. Requirement Antarmuka (UI Logic)

### 4.1 Admin Panel

* **Sidebar:** Persisten (tetap ada) di kiri. Menu aktif harus di-highlight (misal: jika sedang di halaman Berita, menu Berita berwarna biru).
* **Tabel Data:** Harus memiliki nomor urut otomatis.
* **Feedback User:**
* Setelah Simpan/Update/Hapus sukses  Tampilkan `alert` JavaScript atau Flash Message "Data Berhasil Disimpan".
* Konfirmasi Hapus  Saat tombol hapus diklik, wajib muncul *confirmation dialog* "Apakah Anda yakin ingin menghapus data ini?".



### 4.2 Public Website

* **Responsiveness:** Grid layout berita berubah dari 3 kolom (Desktop) menjadi 1 kolom (Mobile).
* **Navigation:** Menu "Login Admin" disembunyikan atau diletakkan di footer agar tidak membingungkan calon mahasiswa.

---

## 5. Security & Error Handling

1. **Penanganan Error Upload:**
* Jika folder tujuan tidak ada permission *write*, sistem harus memberikan pesan error spesifik, bukan error kode PHP.


2. **SQL Injection Prevention:**
* Semua input `$_POST` dan `$_GET` wajib dibungkus fungsi sanitasi sebelum masuk query.
* Contoh: `$judul = mysqli_real_escape_string($koneksi, $_POST['judul']);`


3. **XSS Protection:**
* Saat menampilkan data teks dari database ke halaman public, gunakan `htmlspecialchars()` agar script jahat tidak dieksekusi browser.
* Contoh: `echo htmlspecialchars($data['isi_pesan']);`



---

## 6. Skenario Pengujian Sistem (Testing Logic)

| ID | Fitur | Skenario | Hasil yang Diharapkan |
| --- | --- | --- | --- |
| **TC-01** | Login | Admin login password salah | Muncul pesan "Username/Password Salah", tetap di hal. login. |
| **TC-02** | Login | Admin akses langsung URL `/admin/index.php` tanpa login | Redirect otomatis ke halaman login. |
| **TC-03** | Berita | Upload gambar > 2MB | Upload ditolak, muncul pesan error ukuran. |
| **TC-04** | Berita | Hapus Berita | Data hilang dari tabel DAN file gambar hilang dari folder. |
| **TC-05** | Public | Buka detail berita ID yang tidak ada | Tampilkan halaman 404 atau pesan "Berita tidak ditemukan". |
| **TC-06** | Kontak | Kirim pesan tanpa email valid | Form menolak submit, field email merah. |