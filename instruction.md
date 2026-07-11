# Dokumentasi Sistem: Notifikasi WA Gateway Kelurahan Ledok Kulon

Sistem ini adalah platform administrasi internal Kelurahan Ledok Kulon untuk mengelola permohonan surat pengantar, manajemen data Ketua RT, dan integrasi WhatsApp Gateway menggunakan layanan **Fonnte**.

---

## 1. Arsitektur Basis Data (Database Schema)

Sistem menggunakan 4 tabel utama:

### A. Tabel `users` (Admin/Perangkat Desa)
Digunakan untuk autentikasi admin.
- `id` (Primary Key)
- `name` (String)
- `email` (String, unique)
- `password` (String, hashed)
- `timestamps`

### B. Tabel `ketua_rt`
Menyimpan data Ketua RT untuk keperluan pengiriman notifikasi WhatsApp.
- `id` (Primary Key)
- `nama` (String)
- `nik` (String, 16 digit, unique)
- `rt` (String, 3 digit) - Contoh: `"001"`
- `rw` (String, 3 digit) - Contoh: `"001"`
- `no_whatsapp` (String) - Format Fonnte: `"628xxx"` (wajib diawali 62)
- `timestamps`

### C. Tabel `surat_pengantar_rt`
Mencatat permohonan surat pengantar RT yang membutuhkan konfirmasi/approval via WhatsApp oleh Ketua RT terkait.
- `id` (Primary Key)
- `rt_id` (Foreign Key -> `ketua_rt.id` on delete cascade)
- `nama` (String)
- `tempat_lahir` (String)
- `tanggal_lahir` (Date)
- `nik` (String, 16 digit)
- `agama` (String)
- `status_perkawinan` (String)
- `pekerjaan` (String)
- `alamat` (Text)
- `keperluan` (Text)
- `status` (Enum: `'pending'`, `'disetujui'`, `'ditolak'`) - Default: `'pending'`
- `catatan` (Text, nullable) - Menyimpan catatan/alasan penolakan atau persetujuan dari Ketua RT
- `timestamps`

### D. Tabel `surat_pengantar_kelurahan`
Mencatat surat pengantar tingkat kelurahan yang dibuat langsung oleh Perangkat Desa tanpa perlu konfirmasi/approval RT.
- `id` (Primary Key)
- `rt_id` (Foreign Key -> `ketua_rt.id` on delete cascade)
- `nama` (String)
- `tempat_lahir` (String)
- `tanggal_lahir` (Date)
- `jenis_kelamin` (Enum: `'Laki-laki'`, `'Perempuan'`)
- `agama` (String)
- `status_perkawinan` (String)
- `pekerjaan` (String)
- `alamat` (Text)
- `bukti_diri` (Enum: `'KTP'`, `'KK'`) - Sebagai pembuktian identitas
- `nama_orang_tua` (String)
- `maksud_keperluan` (Text)
- `timestamps`

---

## 2. Pemasangan & Persiapan Database (Setup & Seed)

### Akun Default Admin
- **Email:** `admin@desa.com`
- **Password:** `password`

### Data Ketua RT (Seeded)
Sistem otomatis menginisialisasi 33 data Ketua RT dari RW 001 hingga RW 006.

### Perintah Artisan
Untuk membuat database (SQLite/MySQL) dan mengisi data awal (seeding), jalankan perintah berikut:

```bash
# Menjalankan migrasi dan seeder dari awal
php artisan migrate:fresh --seed
```

---

## 3. Alur Logika Notifikasi WhatsApp Gateway (Fonnte)

Sistem menggunakan Laravel Queue & Jobs (dengan database driver) untuk pemrosesan background agar tidak menghalangi request HTTP utama user.

### A. Pengiriman Notifikasi (Outbound)
1. **Pendaftaran Surat:** Ketika admin/warga mensubmit `surat_pengantar_rt`, data disimpan dengan status `'pending'`.
2. **Dispatch Job:** Sistem mendispatch job `SendRtNotificationJob` ke antrean.
3. **Pengiriman API:** Job tersebut mengirim POST request ke API Fonnte (`https://api.fonnte.com/send`):
   - **Header:** `Authorization: TOKEN_FONNTE_ANDA`
   - **Body:**
     - `target`: `no_whatsapp` milik Ketua RT terkait (misal: `"6281230854656"`)
     - `message`: Template pesan konfirmasi.
       *Contoh:*
       ```text
       Halo Pak/Bu [Nama Ketua RT], terdapat pengajuan Surat Pengantar RT baru:
       Nama: [Nama Pemohon]
       Keperluan: [Keperluan]
       
       Balas pesan ini untuk memproses:
       Ketik "ACC [catatan]" untuk menyetujui.
       Ketik "TOLAK [catatan]" untuk menolak.
       
       ID Pengajuan: [ID_SURAT]
       ```

### B. Penerimaan Balasan (Inbound / Webhook)
Untuk memproses jawaban ACC/TOLAK dari Ketua RT secara otomatis, buat sebuah API endpoint webhook:

1. **Route Webhook:** Daftarkan route POST di `routes/api.php` (tambahkan pengecualian CSRF di bootstrap/app.php jika diperlukan):
   ```php
   Route::post('/fonnte/webhook', [App\Http\Controllers\FonnteWebhookController::class, 'handle']);
   ```
2. **Logika Webhook Controller (`FonnteWebhookController`):**
   - Terima payload JSON dari Fonnte. Fonnte mengirimkan parameter seperti `sender` (nomor WA pengirim) dan `message` (isi teks pesan).
   - Validasi pengirim: Cari `KetuaRt` yang memiliki `no_whatsapp` sesuai dengan `sender`. Jika tidak ditemukan, abaikan atau log error.
   - Parse isi pesan (`message`):
     - Gunakan regex atau string helper untuk mencocokkan pola:
       - `ACC` / `DISUTUJUI` -> Set status surat menjadi `'disetujui'`.
       - `TOLAK` -> Set status surat menjadi `'ditolak'`.
     - Ambil sisa teks setelah kata kunci sebagai kolom `catatan`.
   - Cari data `SuratPengantarRt` yang berstatus `'pending'` milik RT tersebut. Jika sistem memiliki ID Pengajuan dalam pesan (misalnya Ketua RT menyertakan ID), gunakan ID tersebut untuk presisi. Jika tidak, ambil pengajuan `'pending'` terbaru dari RT terkait.
   - Update status dan catatan di database.
   - Kirim respon WhatsApp balik ke Ketua RT mengonfirmasi bahwa status pengajuan telah berhasil diubah.
