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
