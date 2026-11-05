# pertemuan-08
Langkah Pengerjaan Tahap Awal
1. Ekstraksi Bahan & Penyiapan Lingkungan Lokal
Ekstrak berkas ZIP bahan UTS P8 DPWL yang disediakan dosen.

Pindahkan seluruh direktori project ke dalam folder peladen lokal (htdocs untuk XAMPP atau www untuk Laragon).

Pastikan layanan Apache dan MySQL pada peladen lokal sudah berjalan dengan baik.

2. Impor Basis Data
Buka phpMyAdmin (http://localhost/phpmyadmin) pada peramban.

Buat basis data baru (atau gunakan basis data yang disiapkan untuk aplikasi penyewaan kendaraan).

Impor berkas database awal bahan uts dpwl localhost.sql yang terdapat dalam folder bahan UTS ke dalam basis data tersebut.

Sesuaikan konfigurasi koneksi basis data pada berkas proyek (misal: config.php atau berkas konfigurasi MySQLi) agar terhubung dengan localhost, nama pengguna, kata sandi, dan nama basis data yang sesuai.

3. Inisialisasi Repositori Git
Buka terminal / command prompt, lalu masuk ke direktori proyek.

Jalankan perintah inisialisasi Git dan lakukan commit awal:
Laporan UTS DPWL - Fitur Manajemen Data PenyewaIdentitas MahasiswaNama: [Isi Nama Kamu]NIM: 2522500041Kelas: SI3AMata Kuliah: Desain & Pemrograman Web L.Dosen Pengampu: Yohanes Setiawan J., M.Kom.   Tanggal Pengerjaan: 05 November 2026   1. Arsitektur & Alur Kerja SistemAplikasi ini dibangun menggunakan arsitektur MVC berbasis Front Controller kustom dan URL Rewriting melalui Apache .htaccess.URL Rewriting (.htaccess): Mengarahkan semua permintaan non-fisik ke index.php?route=$1 dengan nama folder basis /dpwl-2522500041/.Routing (index.php): Mendeteksi parameter route, mencocokkan pola rute (seperti (:any)), lalu secara dinamis memanggil Controller, Method, dan Parameter yang sesuai.Sistem Database: Menggunakan MySQLi dengan Prepared Statements untuk mencegah SQL Injection.