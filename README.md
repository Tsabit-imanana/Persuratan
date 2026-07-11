# Sistem Administrasi & Notifikasi WA Gateway Kelurahan Ledok Kulon

Aplikasi administrasi internal tertutup berbasis web untuk Perangkat Desa (Admin) di Kelurahan Ledok Kulon, Kecamatan Bojonegoro. Sistem ini dirancang untuk memudahkan manajemen data Ketua RT dan pengelolaan pengajuan surat pengantar warga dengan fitur notifikasi persetujuan otomatis via **WhatsApp Gateway (Fonnte)**.

---

## 🚀 Fitur Utama

1. **Autentikasi Perangkat Desa (Admin)**: Sistem tertutup yang mengharuskan login untuk mengamankan data administrasi kelurahan.
2. **Manajemen Ketua RT (CRUD)**: Panel kelola data Ketua RT (Nama, NIK, RT, RW, dan nomor WhatsApp berformat Fonnte `628xxx`).
3. **Surat Pengantar RT (WhatsApp Approval)**:
   - Pengajuan awal berstatus `pending` dan memicu pengiriman pesan WhatsApp otomatis ke Ketua RT terkait.
   - Ketua RT dapat menyetujui (`ACC`) atau menolak (`TOLAK`) permohonan secara langsung dengan membalas pesan WhatsApp.
   - Status surat akan berubah otomatis di database beserta catatan (opsional) yang dilampirkan oleh Ketua RT.
4. **Surat Pengantar Kelurahan (Direct)**: Surat pengantar tingkat kelurahan yang dibuat langsung oleh Admin tanpa perlu approval RT (dilengkapi pilihan Bukti Diri enum `KTP`/`KK`).
5. **Fonnte Webhook Simulator**: Panel visual bawaan untuk menguji alur balasan WhatsApp Ketua RT (ACC/TOLAK) secara langsung melalui web tanpa memerlukan HP aktif atau pulsa gateway.

---

## 🛠️ Tech Stack

- **Framework**: Laravel 13
- **CSS Engine**: Tailwind CSS v4 (melalui `@tailwindcss/vite`)
- **Database**: MySQL
- **Asset Bundler**: Vite
- **Background Jobs**: Laravel Queue (Database driver)
- **Layanan WA Gateway**: Fonnte API

---

## 💻 Cara Instalasi & Setup Lokal

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokal:

### 1. Prasyarat (Prerequisites)
Pastikan Anda sudah menginstal:
- PHP >= 8.3 dengan ekstensi `pdo_mysql`
- Composer
- Node.js & NPM
- MySQL Server

### 2. Setup File Environment
Copy file `.env.example` menjadi `.env` dan sesuaikan koneksi database MySQL Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=persuratan
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

### 3. Instalasi Dependensi & Compile Assets
Jalankan perintah berikut di terminal:

```bash
# Menginstal dependensi PHP
composer install

# Menginstal dependensi Node
npm install

# Compile asset frontend (Tailwind) untuk produksi
npm run build
```

### 4. Migrasi & Seeding Database
Jalankan migrasi tabel beserta pengisian data awal (seeding) untuk admin default dan 33 data Ketua RT:

```bash
php artisan migrate:fresh --seed
```

**Kredensial Login Default:**
- **Email**: `admin@desa.com`
- **Password**: `password`

### 5. Menjalankan Server Lokal
Jalankan dev server Laravel:

```bash
php artisan serve
```
Aplikasi dapat diakses di browser melalui link [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## 🤖 Integrasi & Pengujian WhatsApp Gateway

### Pola Balasan WhatsApp Ketua RT
Ketua RT terdaftar dapat mengirim balasan ke nomor gateway Fonnte dengan format berikut:
- **Persetujuan (ACC)**: 
  - `ACC [ID_SURAT] [Catatan...]` (Contoh: `ACC 3 berkas lengkap`)
  - `ACC [Catatan...]` (Memproses permohonan pending terbaru dari RT tersebut)
- **Penolakan (TOLAK)**: 
  - `TOLAK [ID_SURAT] [Catatan...]` (Contoh: `TOLAK 3 NIK tidak sesuai`)
  - `TOLAK [Catatan...]` (Memproses permohonan pending terbaru dari RT tersebut)

### Pengujian Menggunakan Simulator
Jika Anda tidak memiliki server publik (Ngrok) untuk menerima callback dari Fonnte:
1. Login ke aplikasi, lalu buat Surat Pengantar RT baru.
2. Buka menu **Fonnte Webhook Simulator** pada sidebar menu.
3. Pilih Ketua RT pengirim, pilih keputusan (`ACC`/`TOLAK`), pilih target surat pending, dan tulis catatan tambahan.
4. Klik **Kirim Simulasi Webhook**. Sistem akan memproses dan mengubah status surat di database secara real-time.

### Menjalankan Unit/Feature Test
Anda juga dapat memverifikasi seluruh fungsionalitas sistem (login, CRUD, pembuatan surat, hingga parse webhook Fonnte) dengan menjalankan test suite:

```bash
./vendor/bin/phpunit --configuration=phpunit.xml
```
Semua test diprogram untuk berjalan menggunakan database transaksi MySQL secara terisolasi tanpa merusak data asli.
