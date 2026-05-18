# e-Gang: Sistem Informasi Pengajuan Surat Magang

Sistem Informasi Manajemen Pengajuan Surat Magang berbasis web yang dikembangkan menggunakan framework **Laravel**. Proyek ini dirancang untuk mendigitalisasi proses administrasi magang mulai dari pendaftaran, persetujuan, hingga monitoring mahasiswa secara *end-to-end* agar lebih efisien dan terorganisir.

## 💻 Tech Stack
* **Core Framework:** Laravel
* **UI Template:** AdminLTE (Tailwind CSS untuk halaman publik)
* **Database:** MySQL
* **PDF Generator:** domPDF (`barryvdh/laravel-dompdf`)
* **QR Code:** `simplesoftwareio/simple-qrcode`

## 🌟 Fitur-Fitur Sistem
* **Multi-Role Access:** Membedakan hak akses antara Admin (mengelola semua data persuratan) dan Mahasiswa (hanya mengakses riwayat pengajuannya sendiri).
* **Auto-Generate Nomor Surat:** Membuat nomor urut surat resmi secara pintar dan otomatis per tahun (Format: `0001/PL.43/PP.02.01/202X`).
* **Auto-Generate QR Code (Paperless Validation):** Menghasilkan QR Code validasi untuk memangkas birokrasi tanda tangan basah secara manual.
* **Cetak PDF Dinamis:** Surat pengantar berformat A4 dapat diunduh langsung. Isi surat (Kop, identitas, QR) di-render secara dinamis dari database.
* **Email Notifikasi:** Mengirim email konfirmasi secara otomatis ketika pengajuan surat mahasiswa telah disetujui.
* **Manajemen Status Pengajuan:** Surat memiliki tiga tahapan transparan: `Pending`, `Disetujui`, atau `Ditolak` (disertai alasan penolakan).
* **Portal Validasi Publik:** Menyediakan rute web publik untuk pengecekan keaslian surat ketika pihak instansi/perusahaan memindai QR Code.

## 🗄️ Architecture & Database
Berdasarkan Entity Relationship Diagram (ERD), sistem ini mengandalkan relasi tabel sebagai berikut:
1. **Tabel `users` (Mahasiswa/Admin):** Menyimpan otentikasi. Memiliki relasi *One-to-Many* ke `pengajuan_surats`.
2. **Tabel `pengajuan_magangs`:** Menyimpan data inti pendaftaran magang (Perusahaan, waktu pelaksanaan, dll). Relasi *One-to-Many* ke `pengajuan_surats`.
3. **Tabel `pengajuan_surats` (Transaksi Utama):** Tabel muara yang memiliki *Foreign Key* ke `users` dan `pengajuan_magangs`. Menyimpan detail spesifik dokumen seperti nomor surat, QR Code, dan status persetujuan.
4. **Tabel `campusprofiles`:** Menyimpan informasi independen mengenai identitas institusi (Logo, Nama, Alamat, Website, NIP Penandatangan) untuk dirender pada Kop Surat PDF.

## 🔄 Workflow Generate Surat
1. **Pengajuan Awal:** Mahasiswa yang data tempat magangnya valid akan secara otomatis masuk ke dalam antrean pembuatan surat.
2. **Verifikasi & Input:** Admin memilih data magang tersebut dan menetapkan keperluan suratnya.
3. **Proses Otomatisasi (Backend):**
   * Laravel memeriksa tahun berjalan dan merilis nomor urut surat terbaru (increment).
   * Sistem men-generate gambar QR Code `.svg` (berisi tautan validasi) dan menyimpannya di direktori `storage/app/public/qrcodes`.
   * Data rekam jejak disimpan dengan status `Disetujui` dan sistem mengirimkan *Email Notification* ke mahasiswa.
4. **Pencetakan File:** Ketika "Download PDF" ditekan, sistem merangkai data relasi (Mahasiswa + Magang + Kampus), mengonversi file gambar QR Code menjadi `base64` (agar tertanam utuh di PDF), dan merender sintaks HTML layout surat menjadi dokumen `.pdf` murni.

## ⚙️ Panduan Menjalankan Sistem (Local Development)
1. Clone repositori ke dalam folder server (misal: `htdocs` atau `www` di Laragon)
2. Jalankan instalasi composer:
   ```bash
   composer install
   ```
3. *Copy* file `.env.example` ke `.env` lalu sesuaikan kredensial Database Anda.
4. Buat kunci aplikasi:
   ```bash
   php artisan key:generate
   ```
5. Eksekusi Migrasi (dan seeder jika ada):
   ```bash
   php artisan migrate
   ```
6. **PENTING:** Tautkan folder storage agar Logo Kop Surat dan QR Code bisa diakses:
   ```bash
   php artisan storage:link
   ```
7. Jalankan server:
   ```bash
   php artisan serve
   ```

## 👨‍💻 Git Cheat Sheet (Catatan Developer)
* `git add .` (Menambahkan semua file ke staging)
* `git commit -m "pesan perubahan"` (Menyimpan perubahan ke lokal)
* `git push origin master` (Mendorong ke repository GitHub)
* `git status` (Mengecek status branch)

## 🛠️ Analisis Teknologi & Library yang Digunakan
Sistem informasi pengajuan surat magang (e-Gang) ini dibangun menggunakan ekosistem Laravel dengan mengintegrasikan beberapa pustaka (*library*) pihak ketiga untuk fitur-fitur spesifiknya:

### 1. Framework Utama
* **Laravel 12**: Menggunakan versi terbaru dari Laravel (terlihat dari struktur konfigurasi `bootstrap/app.php` yang ringkas berbasis *closure*).
* **Database ORM**: Menggunakan *Eloquent ORM* bawaan Laravel.

### 2. Fitur *Generate* & Ekspor PDF (Cetak Surat)
* **Library:** `barryvdh/laravel-dompdf`
* **Perintah Download:** `composer require barryvdh/laravel-dompdf` (Otomatis terunduh jika Anda menjalankan `composer install` pada proyek hasil *clone*).
* **Cara Kerja:** Sistem menggunakan *Facade* `Pdf` untuk memproses data dinamis (identitas mahasiswa, tanggal, QR Code, dan profil kampus) ke dalam file tampilan HTML, lalu dirender menjadi file PDF siap unduh.

### 3. Fitur Pembuatan QR Code (*Paperless Validation*)
* **Library:** `simplesoftwareio/simple-qrcode`
* **Perintah Download:** `composer require simplesoftwareio/simple-qrcode` (Otomatis terunduh jika Anda menjalankan `composer install` pada proyek hasil *clone*).
* **Cara Kerja:** Menghasilkan dua format QR code. Format **SVG** untuk disimpan di *storage* server sebagai tautan validasi, dan format **Base64 PNG** untuk ditanam (*embed*) secara langsung ke dalam cetakan PDF.

### 4. Fitur Pengiriman Email (Notifikasi)
* **Library:** Bawaan Laravel (`Illuminate\Support\Facades\Mail`)
* **Cara Kerja:** Mengirim email notifikasi otomatis saat akun mahasiswa baru ditambahkan, pengajuan magang berhasil masuk, dan saat surat magang telah disetujui admin.

### 5. Fitur Penomoran Surat Otomatis
* **Library:** Logika *backend* PHP murni dibantu dengan `Carbon` (untuk manajemen tanggal).
* **Cara Kerja:** Sistem mengecek tahun berjalan, mencari nomor surat terakhir di tahun tersebut, lalu meng-*increment* angkanya (+1) dan memformatnya dengan awalan nol agar rapi.

### 6. Desain Tampilan (UI/UX)
* **Halaman Admin:** Menggunakan sistem *grid* dan utilitas **Bootstrap 5** beserta **Bootstrap Icons**.
* **Halaman Publik / Mahasiswa:** Menggunakan utilitas kelas dari **Tailwind CSS** beserta ikon **FontAwesome**.

### 7. Pengelolaan File Upload (Berkas & Foto)
* **Library:** Bawaan Laravel (`Illuminate\Support\Facades\Storage`).
* **Cara Kerja:** Memvalidasi file (ukuran dan tipe *mimes*) yang diunggah dan menyimpannya secara aman ke *disk* publik.

### 8. Fitur Otentikasi Multi-Role
* **Library:** Bawaan Laravel Auth (`Illuminate\Support\Facades\Auth`).
* **Cara Kerja:** Mendukung multi-login menggunakan Email atau NIM, lalu melakukan *redirect* otomatis ke *dashboard* yang sesuai dengan hak akses (`admin` atau `mahasiswa`).

---
**Developed by Sulis Rahayu** - Politeknik Negeri Cilacap.
