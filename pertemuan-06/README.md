# pertemuan-06
# Dokumentasi Praktikum Pertemuan 6 (P6)
**Mata Kuliah:** Desain dan Pemrograman Web Lanjutan (IS203)  
**Topik:** Antarmuka Sisi Pengguna Berbasis MVC: TemplateMo, Katalog, Detail, Autentikasi, dan Profil  

---

## A. Integrasi TemplateMo Zay Shop sebagai Antarmuka Sisi Pengguna

### 1. Tahap Pengembangan
* Menyiapkan direktori pengumpulan dan ruang kerja proyek `pertemuan-06`[cite: 4].
* Mengekstrak templat **TemplateMo 559 - Zay Shop** dan menguji/mengidentifikasi struktur komponen antarmuka yang akan digunakan[cite: 5].
* Memindahkan aset Zay Shop ke dalam direktori `assets/zay/` pada ruang kerja aplikasi[cite: 6].
* Menyesuaikan komponen header, navigasi, dan footer agar selaras dengan kebutuhan aplikasi rental kendaraan[cite: 7].

### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Aset Baru:** `assets/zay/css/`, `assets/zay/img/`, `assets/zay/js/`, dan `assets/zay/webfonts/`[cite: 6].
* **Catatan Penyesuaian Berkas:**
  * Berkas HTML asli templat (`index.html`, `shop.html`, `shop-single.html`) dipilah untuk diintegrasikan ke komponen View aplikasi MVC[cite: 6, 7].
  * Berkas `about.html` dan `contact.html` diabaikan sesuai lingkup praktikum P6[cite: 6].

### 3. Perubahan dan Fitur yang Diimplementasikan
* Pengaturan struktur direktori aset antarmuka pengguna di bawah `assets/zay/`[cite: 6].
* Identifikasi jalur relatif bawaan templat HTML untuk disesuaikan dengan fungsi helper URL CodeIgniter (`base_url()` dan `site_url()`)[cite: 8, 10].

### 4. Langkah Pengujian Awal Pemuatan Aset
1. Memeriksa keberadaan struktur folder `assets/zay/` beserta seluruh direktori di dalamnya (`css`, `img`, `js`, `webfonts`)[cite: 8].
2. Memastikan keberadaan berkas CSS utama:
   * `bootstrap.min.css`[cite: 8]
   * `templatemo.css`[cite: 8]
   * `custom.css`[cite: 8]
   * `fontawesome.min.css`[cite: 8]
3. Memastikan keberadaan berkas JavaScript utama:
   * `jquery-1.11.0.min.js`[cite: 8]
   * `bootstrap.bundle.min.js`[cite: 8]
   * `templatemo.js`[cite: 8]
   * `custom.js`[cite: 8]
4. Memeriksa ketersediaan ikon font di direktori `assets/zay/webfonts/` dan gambar dasar di `assets/zay/img/`[cite: 8].

### 5. Hasil Pengujian Aktual dan Status
* **Status Aset:** Berkas aset fisik (CSS, JS, Webfonts, Gambar) telah berhasil disalin ke `assets/zay/` tanpa menghapus aset admin/P5 yang sudah ada[cite: 6, 8].
* **Catatan Integrasi URL Aset:** Referensi jalur relatif templat asli (seperti `href="assets/css/bootstrap.min.css"`) telah dicatat dan dipisahkan untuk disesuaikan menggunakan pemanggilan `<?= base_url('assets/zay/css/bootstrap.min.css') ?>` saat tahap penggabungan ke View[cite: 7, 8].
* **Status Fitur:** Siap dilanjutkan ke tahap integrasi Model-Controller-View (MCV) Katalog Kendaraan.
## B. Mengimplementasikan Katalog Kendaraan Berbasis MVC

### B.4. Menguji Integrasi Model, Controller, View, dan Navigasi Katalog

#### 1. Tahap Pengembangan
* Menambahkan method `getKatalog()` pada `application/models/Mobil_model.php` untuk mengambil seluruh data kendaraan dari basis data[cite: 9, 10].
* Mengatur route `$route['katalog'] = 'Katalog_controller/index';` pada `application/config/routes.php`[cite: 10].
* Membuat `Katalog_controller.php` untuk memanggil Model dan meneruskan data kendaraan ke View[cite: 10].
* Membuat komponen View katalog yang terbagi menjadi `header.php`, `navbar.php`, `footer.php`, dan `index.php` di bawah folder `application/views/katalog/`[cite: 10, 16, 21].

#### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Model:** `application/models/Mobil_model.php` (menambahkan method `getKatalog()`)[cite: 9, 10].
* **Route:** `application/config/routes.php` (menambahkan route `katalog`)[cite: 10].
* **Controller:** `application/controllers/Katalog_controller.php` (Controller baru)[cite: 10].
* **View:** 
  * `application/views/katalog/header.php`[cite: 10]
  * `application/views/katalog/navbar.php`[cite: 11]
  * `application/views/katalog/footer.php`[cite: 13]
  * `application/views/katalog/index.php`[cite: 16]

#### 3. Langkah Pengujian
1. Membuka peramban (browser) dan mengakses URL aplikasi: `http://localhost/dpwl-[NIM]/index.php/katalog` (sesuaikan `[NIM]` dengan direktori aplikasi).
2. Memeriksa keberhasilan pemuatan antarmuka Zay Shop (header, carousel hero, kategori, dan footer)[cite: 16, 21].
3. Memeriksa kelengkapan data kendaraan yang muncul pada kartu katalog (nama mobil, jenis, tahun buat, transmisi, kapasitas kursi/bagasi, harga sewa per hari, dan status unit)[cite: 19, 21].
4. Memeriksa penanganan tampilan gambar kendaraan (`ft_depan`): menampilkan foto utama jika tersedia, atau menampilkan pesan alternatif jika foto belum diunggah[cite: 18, 21].
5. Memeriksa fungsi navigasi menu pada bar navigasi utama (Beranda, Katalog Kendaraan, Registrasi, Login Penyewa)[cite: 12, 21].

#### 4. Hasil Pengujian Aktual
* **Akses Halaman:** Halaman katalog dapat diakses melalui URL `/katalog` tanpa menghasilkan galat HTTP 404 atau HTTP 500.
* **Pengambilan Data Model:** Data kendaraan berhasil diambil dari tabel `t_mobil` secara berurutan (*ASC*) berdasarkan nama kendaraan[cite: 9, 21].
* **Render View:** Seluruh komponen View (`header`, `navbar`, `index`, `footer`) terisi dan terintegrasi dengan baik[cite: 16, 21].
* **Fungsi Navigasi:** Tautan navigasi dan responsivitas halaman katalog berfungsi dengan normal[cite: 12, 21].

#### 5. Catatan dan Penanganan Galat
* *Foto Kendaraan:* Apabila terdapat unit kendaraan yang gambarnya belum tampil atau menggunakan teks alternatif, foto unit dapat diunggah melalui fitur **Manajemen Kendaraan (P5)** pada sisi Admin[cite: 21].
* *Status Fitur:* Integrasi Model, Controller, View, dan Navigasi Katalog Kendaraan telah teruji dan berjalan sesuai spesifikasi praktikum P6[cite: 21].

## C. Mengimplementasikan Detail Kendaraan Berbasis MVC

### C.4. Menguji Navigasi Katalog ke Detail dan Penanganan Galat

#### 1. Tahap Pengembangan
* Menambahkan route `$route['katalog/detail/(:any)'] = 'Katalog_controller/detail/$1';` pada `application/config/routes.php`[cite: 21].
* Mengintegrasikan method `detail(string $noPlat)` pada `application/controllers/Katalog_controller.php` untuk mengambil data detail kendaraan berdasarkan nomor plat[cite: 21].
* Membuat View detail kendaraan di `application/views/katalog/detail.php` yang dilengkapi dengan tampilan foto utama, galeri thumbnail interaktif berbasis JavaScript, serta detail spesifikasi unit[cite: 21, 23, 24, 25].
* Menyesuaikan tautan pada kartu katalog (`index.php`) agar mengarahkan navigasi ke halaman detail kendaraan[cite: 18, 19].

#### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Route:** `application/config/routes.php` (menambahkan route detail kendaraan dengan parameter `:any`)[cite: 21].
* **Controller:** `application/controllers/Katalog_controller.php` (menambahkan method `detail()`)[cite: 21].
* **View:** `application/views/katalog/detail.php` (membuat View detail kendaraan baru)[cite: 21].

#### 3. Langkah Pengujian
1. **Pengujian Navigasi dari Katalog:**
   * Membuka halaman katalog pada peramban (`http://localhost/dpwl-[NIM]/index.php/katalog`)[cite: 21, 25].
   * Mengklik salah satu foto atau nama kendaraan (contoh: Toyota Kijang Innova Reborn)[cite: 25].
   * Memastikan peramban berhasil berpindah ke URL detail, seperti `http://localhost/dpwl-[NIM]/index.php/katalog/detail/B%201173%20HFF`[cite: 25].
2. **Pengujian Tampilan Detail & Galeri Interaktif:**
   * Memeriksa kesesuaian informasi unit yang ditampilkan (nama kendaraan, harga sewa per hari, jenis, tahun buat, transmisi, kapasitas, status, dan deskripsi kendaraan)[cite: 25].
   * Mengklik gambar thumbnail foto kendaraan (`ft_depan`, `ft_blkg`, `ft_interior`) atau tombol panah navigasi foto (kiri/kanan) untuk memastikan foto utama berganti secara dinamis[cite: 22, 23, 24].
3. **Pengujian Penanganan Galat (404 Not Found):**
   * Mengakses URL detail dengan nomor plat yang tidak ada/tidak terdaftar di basis data (contoh: `http://localhost/dpwl-[NIM]/index.php/katalog/detail/PLAT-PALSU`).
   * Memastikan aplikasi memberikan respon HTTP Status `404` dengan pesan *"Kendaraan tidak ditemukan."*[cite: 21].

#### 4. Hasil Pengujian Aktual
* **Navigasi & Transisi Halaman:** Tautan dari halaman katalog ke detail kendaraan berfungsi dengan baik tanpa galat[cite: 25].
* **Integritas Data Detail:** Seluruh data spesifikasi kendaraan yang diambil dari tabel `t_mobil` berhasil ditampilkan pada View detail secara tepat[cite: 21, 25].
* **Interaktivitas Galeri Foto:** Skrip JavaScript untuk pergantian gambar utama melalui thumbnail dan tombol panah navigasi berfungsi secara responsif[cite: 23, 24].
* **Penanganan Galat (404):** Sistem berhasil merespons dengan status HTTP 404 ketika nomor plat kendaraan tidak ditemukan di basis data[cite: 21].

#### 5. Catatan dan Perbaikan Galat
* *Status Fitur:* Integrasi route, model, controller, dan view untuk detail kendaraan beserta penanganan galatnya telah diuji dan berjalan sesuai instruksi modul P6[cite: 21, 26].

## D. Mengimplementasikan Registrasi Akun Penyewa

### D.5. Menguji Registrasi Berhasil, Input Tidak Valid, dan Akun Duplikat

#### 1. Tahap Pengembangan
* Menambahkan route `$route['auth/register'] = 'Auth/register';` pada `application/config/routes.php`[cite: 26].
* Membuat model `application/models/Penyewa_model.php` yang berisi method `findByUserPlg()` untuk mengecek ketersediaan username dan method `create()` untuk menyimpan data registrasi penyewa[cite: 26, 27].
* Mengintegrasikan method `register()` pada `application/controllers/Auth.php` untuk menangani logika validasi input, hashing password dengan `password_hash()`, serta penanganan galat[cite: 29, 30].
* Membuat View formulir registrasi di `application/views/auth/register.php`[cite: 30].

#### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Route:** `application/config/routes.php` (menambahkan route `auth/register`)[cite: 26].
* **Model:** `application/models/Penyewa_model.php` (Model baru untuk entitas penyewa)[cite: 26].
* **Controller:** `application/controllers/Auth.php` (menambahkan method `register()`)[cite: 29].
* **View:** `application/views/auth/register.php` (membuat View formulir registrasi penyewa)[cite: 30].

#### 3. Langkah Pengujian
1. **Pengujian Akses Halaman & Navigasi:**
   * Membuka peramban dan mengklik menu **Registrasi** atau mengakses URL `http://localhost/dpwl-[NIM]/index.php/auth/register`[cite: 34].
   * Memastikan formulir registrasi penyewa tampil dengan rapi dan semua *field* input wajib terlihat jelas[cite: 31, 34].
2. **Pengujian Input Tidak Valid (Validasi Server & Client):**
   * Mengisi username yang tidak sesuai format (misal mengandung spasi atau karakter ilegal) atau NIK kurang/lebih dari 16 digit[cite: 29].
   * Memasukkan password kurang dari 8 karakter atau konfirmasi password yang tidak cocok[cite: 29].
   * Memastikan sistem menampilkan pesan peringatan galat (*alert-danger*) dan mengembalikan input sebelumnya (*old input*)[cite: 29, 30, 31].
3. **Pengujian Akun Duplikat:**
   * Mengisi formulir registrasi menggunakan *username* yang sudah terdaftar sebelumnya di dalam basis data `t_penyewa`[cite: 26, 30].
   * Memastikan sistem menolak pendaftaran dan memberikan pesan error *"Username sudah digunakan."*[cite: 30].
4. **Pengujian Registrasi Berhasil:**
   * Mengisi seluruh field wajib dengan data valid (Username 1-15 karakter, Password ≥ 8 karakter, NIK 16 digit, Nama Lengkap, Nomor HP, Alamat Lengkap)[cite: 29].
   * Mengklik tombol **Daftar**[cite: 33].
   * Memastikan data tersimpan ke tabel `t_penyewa`, password terenkripsi (*hash*), dan halaman menampilkan pesan sukses registrasi serta tombol menuju halaman **Login Penyewa**[cite: 27, 30, 31].

#### 4. Hasil Pengujian Aktual
* **Akses & Tampilan Form:** Halaman formulir registrasi dapat diakses dengan baik tanpa galat[cite: 34].
* **Penanganan Validasi & Input Galat:** Sistem secara responsif menolak masukan yang tidak sesuai kriteria validasi dan mempertahankan data inputan lama pada formulir[cite: 29, 30].
* **Pencegahan Akun Duplikat:** Pengecekan *username* terdaftar melalui `findByUserPlg()` berfungsi dengan presisi[cite: 26, 30].
* **Penyimpanan Data Berhasil:** Data akun penyewa baru berhasil masuk ke basis data `t_penyewa` dengan amatan password ter-hash secara aman[cite: 27, 30].

#### 5. Catatan dan Perbaikan Galat
* *Status Fitur:* Integrasi route, model, controller, dan view registrasi penyewa serta pengujian berbagai skenario input telah berhasil diverifikasi sesuai petunjuk modul P6[cite: 31, 35].

## E. Mengimplementasikan Login, Sesi, dan Logout Penyewa

### E.4. Menguji Login Berhasil, Login Gagal, Sesi, Logout, dan Pembatasan Akses

#### 1. Tahap Pengembangan
* Menambahkan route login dan logout penyewa pada `application/config/routes.php`[cite: 36]:
  * `$route['auth/login-penyewa'] = 'Auth/loginPenyewa';`[cite: 36]
  * `$route['auth/logout-penyewa'] = 'Auth/logoutPenyewa';`[cite: 36]
* Mengintegrasikan method `loginPenyewa()` dan `logoutPenyewa()` pada `application/controllers/Auth.php` untuk menangani otentikasi password, manajemen sesi (`$_SESSION['penyewa_user_plg']`), dan *flash message* navigasi[cite: 36, 37].
* Membuat View formulir login di `application/views/auth/login_penyewa.php`[cite: 37].
* Menyesuaikan komponen `navbar.php` untuk menampilkan menu *Logout* dan ikon *Profil* saat penyewa berhasil login[cite: 12, 13].

#### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Route:** `application/config/routes.php` (menambahkan route `auth/login-penyewa` dan `auth/logout-penyewa`)[cite: 36].
* **Controller:** `application/controllers/Auth.php` (menambahkan method `loginPenyewa()` dan `logoutPenyewa()`)[cite: 36, 37].
* **View:** `application/views/auth/login_penyewa.php` (membuat View formulir login penyewa)[cite: 37].
* **Navigasi:** `application/views/katalog/navbar.php` (penyesuaian kondisi login penyewa)[cite: 12, 13].

#### 3. Langkah Pengujian
1. **Pengujian Halaman Login:**
   * Mengakses menu **Login Penyewa** atau URL `http://localhost/dpwl-[NIM]/index.php/auth/login-penyewa`[cite: 38].
   * Memastikan formulir login tampil lengkap dengan input *username* dan *password*[cite: 37, 38].
2. **Pengujian Login Gagal (Validasi & Kredensial Salah):**
   * Memasukkan *username* atau *password* yang tidak terdaftar/salah[cite: 36].
   * Memastikan sistem menampilkan pesan galat *"Username atau password tidak sesuai."* tanpa mengarahkan ke halaman lain[cite: 36, 37].
3. **Pengujian Login Berhasil & Sesi:**
   * Memasukkan *username* dan *password* akun penyewa yang terdaftar[cite: 36, 38].
   * Mengklik tombol **Login**[cite: 37, 38].
   * Memastikan sistem meregenerasi ID sesi (`session_regenerate_id(true)`), mengarahkan ke halaman katalog, serta menampilkan pesan *flash* selamat datang dan menu *Logout* serta ikon *Profil* di navbar[cite: 13, 37, 39].
4. **Pengujian Logout Penyewa:**
   * Mengklik tombol/menu **Logout** pada navbar[cite: 12, 39].
   * Memastikan

   ## F. Mengimplementasikan Profil dan Pembaruan Data Penyewa

### F.5. Menguji Pembaruan Profil dan Penanganan Input Tidak Valid

#### 1. Tahap Pengembangan
* Menambahkan route profil penyewa pada `application/config/routes.php` (`$route['penyewa/profil'] = 'Penyewa_controller/profil';`)[cite: 36].
* Mengintegrasikan `application/controllers/Penyewa_controller.php` untuk mengelola proteksi autentikasi (wajib login), pemrosesan validasi data, unggah foto KTP/SIM A (validasi format `.jpg`, `.png`, `.webp`, ukuran maksimal 5 MB), serta penggantian password[cite: 37, 38, 41, 42].
* Menambahkan method `updateProfil()` pada `application/models/Penyewa_model.php` untuk memperbarui data penyewa di database `t_penyewa`[cite: 43].
* Membuat View profil penyewa di `application/views/penyewa/profil.php` untuk menampilkan form data diri, foto identitas, dan form ubah password[cite: 44, 48].

#### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Route:** `application/config/routes.php` (menambahkan route `penyewa/profil`)[cite: 36].
* **Controller:** `application/controllers/Penyewa_controller.php` (Controller baru untuk profil penyewa)[cite: 37].
* **Model:** `application/models/Penyewa_model.php` (menambahkan method `updateProfil()`)[cite: 43].
* **View:** `application/views/penyewa/profil.php` (membuat View profil penyewa)[cite: 44].

#### 3. Langkah Pengujian
1. **Pengujian Proteksi Akses (Autentikasi):**
   * Mengakses URL `http://localhost/dpwl-[NIM]/index.php/penyewa/profil` secara langsung tanpa login terlebih dahulu[cite: 37, 52].
   * Memastikan sistem menolak akses, mengarahkan (*redirect*) ke halaman login penyewa, dan menampilkan pesan peringatan[cite: 37].
2. **Pengujian Tampilan Profil:**
   * Login menggunakan akun penyewa yang terdaftar, lalu mengklik ikon profil pada navbar[cite: 13, 52].
   * Memastikan data profil (Username, NIK, Nama Lengkap, Nomor HP, Alamat) dan foto KTP/SIM A yang tersimpan dapat tampil dengan benar[cite: 48, 52].
3. **Pengujian Penanganan Input Tidak Valid & Unggah File:**
   * Memasukkan NIK selain 16 digit angka, format nomor HP tidak valid, atau mengunggah berkas foto selain format image/ukuran > 5 MB[cite: 40, 42].
   * Mengisi form ganti password dengan password saat ini yang salah atau konfirmasi password baru tidak cocok[cite: 38].
   * Memastikan sistem menampilkan pesan galat (*alert-danger*) dan membatalkan proses pembaruan data[cite: 38, 48].
4. **Pengujian Pembaruan Profil & Foto Berhasil:**
   * Mengubah data diri dengan input valid, memilih file foto KTP/SIM A baru, atau mengisi perubahan password dengan benar[cite: 38, 42].
   * Mengklik tombol **Simpan Perubahan**[cite: 48, 52].
   * Memastikan data di database berhasil diperbarui, foto terunggah ke folder `uploads/penyewa/`, dan pesan sukses *"Profil berhasil diperbarui."* ditampilkan[cite: 40, 43, 48].

#### 4. Hasil Pengujian Aktual
* **Proteksi Halaman:** Fitur pembatasan akses berjalan baik, pengguna tanpa sesi login tidak dapat membuka halaman profil[cite: 37].
* **Validasi Input & Berkas:** Sistem berhasil memvalidasi format teks, kesesuaian password, serta batasan ukuran dan ekstensi berkas foto KTP/SIM A[cite: 38, 40, 42].
* **Pembaruan Data & Unggah File:** Data profil dan berkas foto baru berhasil tersimpan ke sistem basis data dan direktori penyimpanan[cite: 40, 43].

#### 5. Catatan dan Perbaikan Galat
* *Status Fitur:* Integrasi route, model, controller, dan view untuk pembaruan profil penyewa serta penanganan validasi inputnya telah diuji dan berjalan sesuai instruksi modul P6[cite: 52, 53].