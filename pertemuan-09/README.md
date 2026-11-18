# pertemuan-09# pertemuan-09

Transaksi MVC II: Pembayaran Awal dan Verifikasi Pembayaran (DPWL, Gasal 2026/2027)

## Langkah A. Memastikan Artefak P7 Siap Digunakan

### Langkah Pengujian
1. Menjalankan Laragon dan memeriksa PHP 8.4 (`php -v`) serta pengaturan unggah berkas (`file_uploads`, `upload_max_filesize`, `post_max_size`).
2. Membuka katalog kendaraan melalui `http://localhost/dpwl-2522500041/`.
3. Login admin dan membuka dashboard, Manajemen Admin, serta Manajemen Kendaraan.
4. Login penyewa, membuka detail kendaraan dan profil penyewa.
5. Menambahkan kendaraan ke keranjang, membuka konfirmasi, lalu checkout.
6. Memeriksa `t_sewa` dan `t_bayar` di phpMyAdmin, termasuk `SHOW CREATE TABLE`.
7. Memeriksa keberadaan folder `uploads/bayar/`.

### Hasil Aktual
- (isi sesuai hasil uji: login admin dan penyewa, katalog, detail, profil, keranjang, checkout)
- Record DP pada `t_bayar`: kode_bayar `PAY/........`, nominal `........`, sttus_byr `pending`, ft_byr `NULL`, tgl_wkt_ver `NULL`.
- `uploads/bayar/` belum tersedia (akan dibuat pada tahap upload bukti pembayaran).

### Temuan Baseline
1. Workspace identik dengan `pertemuan-07`; perubahan P8 (Manajemen Penyewa) ada di `pertemuan-08` dan tidak ikut disalin. (keputusan: ........)
2. `admin.php` memuat teks sebelum tag `<?php`. Tidak diubah pada langkah ini.
3. Beberapa berkas PHP diawali spasi/baris kosong sebelum `<?php`. Aman selama output buffering aktif; tidak diubah.
4. `Transaksi_controller` memuat `die()` berisi detail galat pada beberapa jalur. Tidak diubah.
5. Formulir P7 belum memakai token CSRF. Formulir baru P9 akan memakainya.
6. Kode transaksi/pembayaran memuat `/`, sehingga tidak dikirim lewat segmen URL `(:any)`, melainkan lewat query string atau POST.

 