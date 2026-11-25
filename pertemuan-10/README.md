# pertemuan-10
# PRAKTIKUM P10 – DESAIN DAN PEMROGRAMAN WEB LANJUTAN

## A.3 Menyiapkan Dokumentasi dan Git

### Identitas Mahasiswa
- Nama: Indah Permata Sriningsih
- NIM: 2522500041
- Program Studi: Sistem Informasi
- Mata Kuliah: Desain dan Pemrograman Web Lanjutan

### 1. Artefak P9
Pengembangan P10 menggunakan aplikasi DPWL dari praktikum P9 sebagai dasar pengembangan. Aplikasi yang digunakan merupakan aplikasi yang telah dikembangkan pada pertemuan sebelumnya.

### 2. Kondisi Awal Aplikasi P9
Aplikasi P9 digunakan sebagai workspace utama untuk pengembangan P10. Pengembangan dilakukan secara kumulatif dengan mempertahankan fitur-fitur yang telah dibuat pada P9.

### 3. Pemeriksaan Fitur P9
Pemeriksaan awal dilakukan terhadap fitur aplikasi P9 sebelum pengembangan P10 dimulai, meliputi:
- Login admin.
- Login penyewa.
- Daftar dan detail pembayaran.
- Upload bukti pembayaran DP oleh penyewa.
- Verifikasi pembayaran DP oleh admin.
- Informasi kendaraan pada detail transaksi.

### 4. Tahapan Pengembangan P10
Pengembangan P10 meliputi:
- Menyesuaikan struktur basis data untuk status transaksi lunas.
- Mengimplementasikan model pelunasan.
- Mengimplementasikan controller pelunasan.
- Membuat route dan integrasi menu pelunasan.
- Membuat view daftar dan detail pelunasan.
- Membuat dokumen transaksi yang dapat dicetak.

### 5. Dokumentasi Pengembangan
Dokumentasi akan diperbarui secara bertahap pada setiap tahap pengembangan P10, meliputi perubahan source code, basis data, pengujian, kendala, dan perbaikan.

### 6. Git
Pengelolaan versi dilakukan menggunakan Git untuk menyimpan perubahan setiap tahap pengembangan P10.

## B.3 Memverifikasi Perubahan Struktur Basis Data

### Tujuan
Memastikan nilai ENUM `lunas` berhasil ditambahkan pada kolom `status_sewa` di tabel `t_sewa`.

### Hasil Pemeriksaan
- Tabel: `t_sewa`
- Kolom: `status_sewa`
- Tipe data: ENUM
- Nilai ENUM: `diajukan`, `disetujui`, `ditolak`, `aktif`, `selesai`, `batal`, `keranjang`, `lunas`.

### Kesimpulan
Penambahan nilai ENUM `lunas` berhasil dilakukan dan nilai ENUM sebelumnya tetap dipertahankan. Perubahan struktur database telah diverifikasi sebelum melanjutkan implementasi Model Pelunasan P10.

# P10 – C.5 Implementasi Model Pelunasan

## Tujuan
Tahap ini bertujuan untuk menambahkan dan mengimplementasikan fungsi pelunasan pada `Pembayaran_model.php` dengan menggabungkan fungsi daftar pelunasan, detail pelunasan, pembuatan kode pembayaran, dan penyimpanan pelunasan.

## C.1 – Membuat Fungsi Daftar Pelunasan
Pada tahap ini dibuat fungsi `getDaftarPelunasan()` untuk menampilkan daftar transaksi penyewaan yang memiliki kewajiban pembayaran dan membutuhkan pelunasan.

Fungsi ini digunakan untuk mengambil data transaksi, data penyewa, total biaya sewa, total pembayaran yang telah dilakukan, serta sisa kewajiban pembayaran.

## C.2 – Membuat Fungsi Detail Pelunasan
Pada tahap ini dibuat fungsi `getDetailPelunasan()` untuk menampilkan detail transaksi penyewaan yang akan dilunasi.

Data yang ditampilkan meliputi informasi penyewa, detail mobil, total biaya sewa, riwayat pembayaran, serta sisa pembayaran yang harus diselesaikan.

## C.3 – Membuat Kode Pembayaran Pelunasan
Pada tahap ini dibuat fungsi `buatKodeBayarPelunasan()` untuk menghasilkan kode pembayaran pelunasan secara otomatis.

Kode pembayaran dibuat dengan format `PAY/YYYYMMDD/NN` agar transaksi pembayaran memiliki kode unik dan dapat dibedakan berdasarkan tanggal pembuatannya.

## C.4 – Menyimpan Pelunasan
Pada tahap ini dibuat fungsi `simpanPelunasan()` untuk memproses dan menyimpan pembayaran pelunasan ke dalam database.

Proses ini mencakup pemilihan metode pembayaran, validasi bukti pembayaran transfer, perhitungan sisa kewajiban, penyimpanan data pembayaran, serta perubahan status transaksi penyewaan menjadi `lunas`.

Proses penyimpanan dilakukan menggunakan transaksi database untuk menjaga konsistensi data dan mencegah penyimpanan yang tidak lengkap apabila terjadi kesalahan.

## Hasil Implementasi
Penambahan fungsi C.1 sampai C.4 dilakukan pada file `Pembayaran_model.php` dengan tetap mempertahankan fungsi pembayaran yang sudah tersedia dari praktikum P9.

Model pelunasan digunakan sebagai dasar untuk melanjutkan pengembangan controller, halaman pelunasan, dan dokumen transaksi pada praktikum P10.

## Kesimpulan
Implementasi model pelunasan pada tahap C.1 sampai C.4 telah disiapkan untuk mendukung proses pelunasan transaksi penyewaan mobil. Fungsi-fungsi tersebut menjadi bagian dari pengembangan sistem pembayaran pada praktikum P10.

# P10 – D.7 Dokumentasi Implementasi Controller Pelunasan dan Dokumen Transaksi

## Deskripsi

Tahap D pada Praktikum P10 merupakan implementasi Controller Pelunasan dan Dokumen Transaksi pada aplikasi rental mobil berbasis MVC. Tahap ini bertujuan untuk menghubungkan model pelunasan dengan tampilan admin, memproses pembayaran pelunasan, serta menyediakan dokumen transaksi.

Implementasi dilakukan pada file `Pembayaran_controller.php` dengan tetap mempertahankan fitur pembayaran dan verifikasi yang telah dibuat pada praktikum P9.

## D.1 Menampilkan Daftar Pelunasan

Pada tahap ini dibuat method `pelunasanIndex()` yang berfungsi untuk menampilkan daftar transaksi penyewa yang membutuhkan pelunasan.

Fungsi yang diterapkan:

- Memastikan admin sudah login.
- Memastikan request menggunakan metode GET.
- Mengambil data transaksi yang membutuhkan pelunasan dari model.
- Menampilkan flash message.
- Mengirim data ke view admin pelunasan.

## D.2 Menampilkan Detail Pelunasan

Pada tahap ini dibuat method `pelunasanDetail()` untuk menampilkan detail transaksi yang akan dilunasi.

Fungsi yang diterapkan:

- Memastikan admin sudah login.
- Memastikan request menggunakan metode GET.
- Memvalidasi kode transaksi sewa.
- Mengambil detail transaksi melalui model.
- Menampilkan informasi transaksi pelunasan.
- Menangani apabila data transaksi tidak ditemukan.

## D.3 Memproses Pelunasan

Pada tahap ini dibuat method `prosesPelunasan()` untuk memproses pembayaran pelunasan yang diterima oleh admin.

Fungsi yang diterapkan:

- Memastikan admin sudah login.
- Memastikan request menggunakan metode POST.
- Memvalidasi kode transaksi sewa.
- Memvalidasi metode pembayaran tunai atau transfer.
- Mengelola unggahan bukti pembayaran apabila menggunakan transfer.
- Memanggil model untuk menyimpan pembayaran pelunasan.
- Menampilkan pesan keberhasilan atau kegagalan proses pembayaran.

## D.4 Menampilkan Dokumen Transaksi

Pada tahap ini dibuat method `dokumenTransaksi()` untuk menampilkan dokumen transaksi berdasarkan kode sewa.

Fungsi yang diterapkan:

- Memastikan admin sudah login.
- Memastikan request menggunakan metode GET.
- Memvalidasi kode transaksi sewa.
- Mengambil detail transaksi dari model.
- Mengirim data transaksi ke view dokumen transaksi.
- Menangani kesalahan apabila data transaksi tidak ditemukan.

## D.5 Mempertahankan Fitur P9

Implementasi Controller P10 dilakukan dengan mempertahankan fitur-fitur pembayaran yang sudah tersedia pada P9.

Fitur yang dipertahankan meliputi:

- Daftar verifikasi pembayaran.
- Detail verifikasi pembayaran.
- Proses verifikasi pembayaran oleh admin.
- Daftar pembayaran penyewa.
- Detail pembayaran penyewa.
- Upload bukti pembayaran.
- Validasi file bukti pembayaran.
- Pengelolaan flash message.
- Pembatasan akses berdasarkan sesi pengguna.

Dengan demikian, penambahan fitur pelunasan tidak menghilangkan fungsi pembayaran DP dan verifikasi pembayaran sebelumnya.

## D.6 Pengujian dan Pemeriksaan Controller

Pada tahap ini dilakukan pemeriksaan terhadap implementasi Controller Pelunasan dan Dokumen Transaksi.

Pemeriksaan meliputi:

- Memastikan method D.1 sampai D.4 tersedia pada controller.
- Memastikan fungsi P9 tetap tersedia.
- Memastikan validasi login admin diterapkan.
- Memastikan pembatasan metode HTTP GET dan POST diterapkan.
- Memastikan validasi kode transaksi berjalan.
- Memastikan metode pembayaran tunai dan transfer ditangani.
- Memastikan penanganan kesalahan dan flash message tersedia.
- Memeriksa sintaks PHP pada file controller.

File `Pembayaran_controller.php` hasil penggabungan P9 dan P10 telah diperiksa menggunakan PHP lint dan tidak ditemukan kesalahan sintaks.

Pengujian integrasi melalui browser dan database dilakukan setelah route serta view pelunasan selesai diimplementasikan.

## Kesimpulan

Tahap D.1 sampai D.6 merupakan implementasi Controller Pelunasan dan Dokumen Transaksi pada aplikasi rental mobil berbasis MVC. Implementasi mencakup daftar pelunasan, detail transaksi pelunasan, proses pembayaran pelunasan, serta tampilan dokumen transaksi.

Fitur pembayaran P9 tetap dipertahankan sehingga implementasi P10 dapat dikembangkan tanpa menghilangkan fungsi pembayaran DP dan verifikasi admin yang telah dibuat sebelumnya.

Tahap D.7 digunakan sebagai dokumentasi hasil implementasi Controller Pelunasan dan Dokumen Transaksi.


# P10 – E.4 Dokumentasi Routes dan Menu Admin Pelunasan

## Deskripsi

Tahap E pada Praktikum P10 merupakan implementasi Routes dan Menu Admin untuk fitur pelunasan transaksi pada aplikasi rental mobil berbasis MVC. Tahap ini bertujuan menghubungkan method Controller Pelunasan dengan URL aplikasi serta menambahkan akses menu pelunasan pada halaman administrasi.

Implementasi dilakukan pada file `application/config/routes.php` dan file sidebar admin, dengan tetap mempertahankan route dan menu yang telah dibuat pada praktikum sebelumnya.

## E.1 Menambahkan Routes Pelunasan

Pada tahap ini dilakukan penambahan route P10 untuk menghubungkan method Controller Pelunasan dengan URL aplikasi.

Route yang ditambahkan meliputi:

- Route daftar transaksi pelunasan.
- Route proses pelunasan.
- Route dokumen transaksi.
- Route detail transaksi pelunasan.

Route tersebut digunakan untuk mengakses method `pelunasanIndex()`, `prosesPelunasan()`, `dokumenTransaksi()`, dan `pelunasanDetail()` pada `Pembayaran_controller.php`.

Penambahan route dilakukan pada file `application/config/routes.php` tanpa menghapus route P9 yang telah tersedia.

## E.2 Menambahkan Menu Pelunasan Transaksi

Pada tahap ini dilakukan penambahan menu Pelunasan Transaksi pada sidebar admin.

Menu ini berfungsi sebagai akses bagi admin untuk membuka halaman daftar transaksi yang membutuhkan pelunasan.

Menu Pelunasan Transaksi diarahkan menuju route:

`admin/pembayaran/pelunasan`

Penambahan menu dilakukan pada file sidebar admin sehingga fitur pelunasan dapat diakses melalui navigasi halaman administrasi.

## E.3 Menghubungkan Menu dengan Routes

Pada tahap ini dilakukan penghubungan antara menu Pelunasan Transaksi dengan route yang telah dibuat pada E.1.

Penghubungan dilakukan agar ketika admin memilih menu Pelunasan Transaksi, aplikasi dapat mengarahkan admin ke Controller Pelunasan melalui route yang telah ditentukan.

Integrasi ini memungkinkan navigasi menuju fitur pelunasan menjadi lebih mudah dan terstruktur sesuai konsep MVC.

## E.4 Pengujian dan Dokumentasi Routes serta Menu Admin

Pada tahap ini dilakukan pemeriksaan terhadap implementasi Routes dan Menu Admin Pelunasan.

Pemeriksaan meliputi:

- Memastikan route daftar pelunasan telah ditambahkan.
- Memastikan route proses pelunasan telah ditambahkan.
- Memastikan route dokumen transaksi telah ditambahkan.
- Memastikan route detail pelunasan telah ditambahkan.
- Memastikan menu Pelunasan Transaksi tersedia pada sidebar admin.
- Memastikan menu diarahkan ke route daftar pelunasan.
- Memastikan route P9 tetap dipertahankan.
- Memeriksa susunan route agar tidak tertangkap oleh route yang lebih umum.

Pengujian akses melalui browser dilakukan setelah view pelunasan tersedia dan seluruh komponen Controller, Model, Routes, serta View terintegrasi.

## Kesimpulan

Tahap E.1 sampai E.3 merupakan implementasi Routes dan Menu Admin Pelunasan pada aplikasi rental mobil berbasis MVC. Implementasi mencakup penambahan route daftar pelunasan, proses pelunasan, dokumen transaksi, detail pelunasan, serta penambahan menu Pelunasan Transaksi pada sidebar admin.

Tahap E.4 digunakan sebagai dokumentasi dan pemeriksaan hasil implementasi Routes serta Menu Admin agar fitur pelunasan dapat terintegrasi dengan struktur aplikasi yang telah dikembangkan pada praktikum sebelumnya.
