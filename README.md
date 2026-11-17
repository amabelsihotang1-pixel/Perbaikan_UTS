# Garasi Roda

Dashboard inventaris untuk showroom sepeda motor. Aplikasi menggunakan pola MVC dengan PHP native dan mendukung MySQL/MariaDB maupun SQLite.

## Fitur

- Ringkasan model, unit, nilai inventaris, dan stok menipis.
- CRUD inventaris motor: tambah, lihat, ubah, dan hapus.
- Data spesifik kendaraan: merek, model, jenis, tahun produksi, kapasitas mesin, warna, harga, jumlah unit, dan lokasi showroom.
- Pencarian berdasarkan merek, model, atau lokasi, dan filter jenis motor.
- Validasi formulir di sisi server, prepared statement PDO, dan perlindungan CSRF.
- Layout responsif untuk desktop dan perangkat seluler.
- Delapan data contoh sepeda motor baru dan elektrik.

## Teknologi

- PHP 8.1 atau lebih baru (ekstensi `mbstring` dan salah satu `pdo_mysql` / `pdo_sqlite`).
- MySQL 8.0 atau MariaDB yang mendukung `utf8mb4`; SQLite tersedia untuk menjalankan demo tanpa server database.
- HTML, CSS, dan JavaScript tanpa framework frontend.

## Struktur folder

```text
app/
  Controllers/      Pengendali dashboard dan CRUD motor
  Core/             Router, koneksi database, dan controller dasar
  Models/           Model inventaris sepeda motor
  Views/            Template layout dan halaman
  helpers.php       Fungsi tampilan bersama
database/
  schema.sql        Skema dan data awal MySQL/MariaDB
  schema.sqlite.sql Skema dan data awal SQLite
  garasi_roda.sqlite Database SQLite berisi data contoh
public/
  assets/css/       Gaya responsif
  assets/js/        Navigasi dan konfirmasi hapus
  index.php         Front controller
  .htaccess         Rewrite URL untuk Apache
```

## Cara menjalankan

### Jalankan cepat dengan database SQLite

Database SQLite beserta data contoh sudah disertakan. Dari folder utama proyek, jalankan:

```powershell
php -S localhost:8000 -t public
```

Buka `http://localhost:8000`. Nomor port (`:8000`) wajib ditulis saat menjalankan server PHP bawaan.

### Gunakan MySQL / MariaDB

1. Pastikan PHP, ekstensi `pdo_mysql` dan `mbstring`, serta MySQL/MariaDB sudah tersedia.
2. Impor `database/schema.sql` melalui MySQL Workbench, phpMyAdmin, atau terminal:

   ```sh
   mysql -u root -p < database/schema.sql
   ```

3. Atur driver dan kredensial database dengan environment variable `DB_DRIVER=mysql`, `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, dan `DB_PASSWORD`. Nilai koneksi bawaan MySQL adalah host `127.0.0.1`, port `3306`, database `garasi_roda`, user `root`, dan password kosong. Tanpa `DB_DRIVER=mysql`, aplikasi menggunakan database SQLite bawaan.
4. Jalankan server pengembangan dari folder proyek:

   ```sh
   php -S 127.0.0.1:8000 -t public
   ```

Untuk Apache, arahkan document root ke folder `public/` dan aktifkan `mod_rewrite`.

## Publikasi dengan akun sendiri

Untuk membuat tautan yang dapat dibagikan, unggah proyek ke layanan hosting PHP/MySQL milikmu sendiri. Buat repositori baru di akun GitHub milikmu (bukan repositori orang lain), lalu hubungkan repositori itu ke hosting yang mendukung PHP dan MySQL. Atur kredensial database melalui environment variable hosting dan arahkan document root ke folder `public/`. GitHub Pages saja tidak dapat menjalankan aplikasi PHP ini.

## Identitas pemilik proyek

> Lengkapi bagian ini sebelum mengumpulkan tugas. Detail identitas tidak disertakan karena belum diberikan.

- Nama: **[Isi nama lengkap]**
- Kelas: **[Isi kelas]**
- Nomor absen / NIM: **[Isi nomor identitas]**
- GitHub milik sendiri: **[Isi URL profil GitHub milikmu]**

## Catatan

Proyek ini adalah contoh aplikasi pembelajaran dan belum mencakup autentikasi pengguna maupun pengelolaan transaksi penjualan.
