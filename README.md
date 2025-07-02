# Toko Online CodeIgniter 4

Proyek ini adalah platform toko online yang dibangun menggunakan [CodeIgniter 4](https://codeigniter.com/).  
Sistem ini menyediakan berbagai fungsionalitas untuk mendukung toko online, termasuk manajemen produk, keranjang belanja, transaksi, serta dashboard toko berbasis API.

---

## Daftar Isi

- [Fitur](#fitur)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Struktur Proyek](#struktur-proyek)
- [Webservice API](#webservice-api)

---

## Fitur

- **Katalog Produk**
  - Tampilan produk dengan gambar
  - Deskripsi, harga, dan stok produk
  - Pencarian produk

- **Keranjang Belanja**
  - Tambah/hapus produk ke keranjang
  - Update jumlah produk
  - Hitung subtotal, ongkir, dan grand total

- **Sistem Transaksi**
  - Proses checkout dengan input alamat pengiriman
  - Pilihan ongkos kirim (ongkir)
  - Simpan transaksi ke database
  - Melihat riwayat transaksi
  - Melihat detail transaksi
  - Status transaksi (Sudah Selesai / Belum Selesai)

- **Panel Admin**
  - Manajemen produk (CRUD)
  - Manajemen kategori
  - Laporan transaksi
  - Export laporan transaksi ke PDF
  - Dashboard admin menampilkan statistik transaksi

- **Sistem Autentikasi**
  - Login / Register pengguna
  - Manajemen akun
  - Role admin dan customer

- **Dashboard Toko via Webservice**
  - Menampilkan daftar transaksi pembelian:
    - No
    - Username
    - Alamat
    - Total Harga
    - Ongkir
    - Jumlah Item
    - Status transaksi (Sudah / Belum berhasil)
    - Tanggal transaksi
  - Mengambil data dari API backend menggunakan CURL

---

## Persyaratan Sistem

- PHP >= 8.2
- Composer
- Web Server (XAMPP / Laragon / Apache)
- MySQL / MariaDB
- Node.js (jika compile asset NiceAdmin)

## Instalasi

1. **Clone repository ini**
   ```bash
   git clone [URL repository]
   cd belajar-ci-tugas
   ```
2. **Install dependensi**
   ```bash
   composer install
   ```
3. **Konfigurasi database**

   - Start module Apache dan MySQL pada XAMPP
   - Buat database **db_ci4** di phpmyadmin.
   - copy file .env dari tutorial https://www.notion.so/april-ns/Codeigniter4-Migration-dan-Seeding-045ffe5f44904e5c88633b2deae724d2

4. **Jalankan migrasi database**
   ```bash
   php spark migrate
   ```
5. **Seeder data**
   ```bash
   php spark db:seed ProductSeeder
   ```
   ```bash
   php spark db:seed UserSeeder
   ```
6. **Jalankan server**
   ```bash
   php spark serve
   ```
7. **Akses aplikasi**
   Buka browser dan akses `http://localhost:8080` untuk melihat aplikasi.

## Struktur Proyek

Proyek menggunakan struktur MVC CodeIgniter 4:

- app/Controllers - Logika aplikasi dan penanganan request
  - AuthController.php - Autentikasi pengguna
  - ProdukController.php - Manajemen produk
  - TransaksiController.php - Proses transaksi
- app/Models - Model untuk interaksi database
  - ProductModel.php - Model produk
  - UserModel.php - Model pengguna
- app/Views - Template dan komponen UI
  - v_produk.php - Tampilan produk
  - v_keranjang.php - Halaman keranjang
- public/img - Gambar produk dan aset
- public/NiceAdmin - Template admin
