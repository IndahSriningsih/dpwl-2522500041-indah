# pertemuan-09
# README
## PRAKTIKUM P9 – TRANSAKSI MVC II
### Tahap 1: Membuat Halaman Pembayaran Penyewa

**Project:** Rental Kendaraan  
**Mata Kuliah:** DPWL  
**Tahap:** 1 – Halaman Pembayaran Penyewa

---

## 1. Deskripsi

Tahap 1 merupakan pengembangan aplikasi rental kendaraan dari project P7. Pada tahap ini dibuat halaman pembayaran penyewa untuk menampilkan informasi pembayaran uang muka (DP) dari transaksi yang sudah dilakukan melalui proses checkout.

Data pembayaran diambil dari tabel pembayaran yang sudah tersedia pada database P7.

## 2. Tujuan

1. Membuat halaman daftar pembayaran penyewa.
2. Menampilkan kode pembayaran dan kode transaksi sewa.
3. Menampilkan nominal pembayaran DP.
4. Menampilkan status pembayaran.
5. Menampilkan detail pembayaran penyewa.

## 3. File yang Dibuat

| No. | Nama File | Keterangan |
|---|---|---|
| 1 | `Pembayaran_controller.php` | Mengatur proses halaman pembayaran |
| 2 | `Pembayaran_model.php` | Mengambil data pembayaran dari database |
| 3 | `pembayaran.php` | Menampilkan daftar pembayaran |
| 4 | `pembayaran_detail.php` | Menampilkan detail pembayaran |

## 4. File yang Diubah

1. `application/config/routes.php`
2. `application/views/katalog/navbar.php`

## 5. Fitur yang Dibuat

- Menu Pembayaran Saya pada navbar penyewa.
- Daftar pembayaran DP.
- Informasi kode pembayaran.
- Informasi transaksi sewa.
- Informasi nominal DP.
- Status pembayaran.
- Halaman detail pembayaran.

## 6. Route

Halaman daftar pembayaran:

`http://localhost/dpwl-2522500041/pembayaran`

Halaman detail pembayaran:

`http://localhost/dpwl-2522500041/pembayaran/detail/KODE_PEMBAYARAN`

## 7. Cara Menjalankan

1. Jalankan XAMPP.
2. Aktifkan Apache dan MySQL.
3. Pastikan database project P7 sudah diimpor.
4. Buka browser.
5. Akses aplikasi rental kendaraan.
6. Login menggunakan akun penyewa.
7. Klik menu **Pembayaran Saya**.
8. Klik tombol **Detail** untuk melihat informasi pembayaran.

## 8. Hasil yang Diharapkan

Halaman Pembayaran Saya dapat menampilkan daftar pembayaran DP milik penyewa yang sedang login. Penyewa dapat melihat informasi pembayaran dan membuka halaman detail pembayaran.

## 9. Catatan

- Tahap ini menggunakan database dan transaksi dari project P7.
- Data pembayaran DP berasal dari proses checkout yang sudah tersedia.
- Tidak membuat transaksi DP baru.
- Fitur upload bukti pembayaran dikerjakan pada Tahap 2.
- Fitur verifikasi pembayaran admin dikerjakan pada Tahap 3.

---

**Dokumentasi Praktikum P9 – Tahap 1 selesai.**

# README – PRAKTIKUM MANDIRI P9
## Tahap 2: Menambahkan Fitur Upload Bukti Pembayaran

### 1. Deskripsi
Pada tahap 2 Praktikum Mandiri P9 dilakukan pengembangan fitur upload bukti pembayaran pada aplikasi penyewaan kendaraan berbasis PHP dengan konsep MVC.

Fitur ini memungkinkan penyewa mengunggah bukti pembayaran DP melalui halaman detail pembayaran. Bukti pembayaran yang diunggah akan disimpan ke dalam folder aplikasi dan dicatat pada database untuk keperluan verifikasi oleh admin.

### 2. Tujuan
- Menambahkan fitur upload bukti pembayaran DP.
- Memungkinkan penyewa mengunggah bukti transfer.
- Menyimpan file bukti pembayaran ke folder aplikasi.
- Menghubungkan file bukti pembayaran dengan data pembayaran di database.
- Menampilkan bukti pembayaran pada halaman detail pembayaran.

### 3. File yang Dibuat atau Diubah

**File yang diubah:**
- `application/views/penyewa/pembayaran_detail.php`
- `application/controllers/Pembayaran_controller.php`
- `application/models/Pembayaran_model.php`

**Folder penyimpanan:**
- `uploads/bayar/`

### 4. Fitur yang Ditambahkan

1. **Form Upload Bukti Pembayaran**  
   Menampilkan form untuk memilih dan mengunggah bukti transfer.

2. **Validasi File**  
   Memeriksa file yang diunggah berdasarkan format dan ukuran file sesuai validasi controller.

3. **Penyimpanan Bukti Pembayaran**  
   File bukti pembayaran disimpan pada folder `uploads/bayar/`.

4. **Penyimpanan Data ke Database**  
   Nama atau lokasi file bukti pembayaran disimpan pada kolom `ft_byr` di tabel `t_bayar`.

5. **Menampilkan Bukti Pembayaran**  
   Bukti pembayaran yang berhasil diunggah dapat ditampilkan kembali pada halaman detail pembayaran.

6. **Pembatasan Upload**  
   Upload hanya diperbolehkan untuk pembayaran dengan status `pending` dan metode pembayaran `transfer`.

### 5. Alur Proses Upload

1. Penyewa membuka halaman pembayaran.
2. Penyewa memilih salah satu transaksi pembayaran DP.
3. Sistem menampilkan halaman detail pembayaran.
4. Penyewa memilih foto bukti transfer.
5. Penyewa menekan tombol Upload Bukti Pembayaran.
6. Controller memeriksa file yang dikirim.
7. File disimpan ke folder `uploads/bayar/`.
8. Model memperbarui data bukti pembayaran pada tabel `t_bayar`.
9. Sistem menampilkan bukti pembayaran pada halaman detail.

### 6. Ketentuan Upload

- Format file: JPG, JPEG, dan PNG.
- Ukuran maksimal: 3 MB sesuai validasi controller.
- Nama input file: `bukti_pembayaran`.
- Metode form: `POST`.
- Enctype: `multipart/form-data`.
- Folder penyimpanan: `uploads/bayar/`.

### 7. Pengujian

Pengujian dilakukan dengan langkah berikut:

1. Login menggunakan akun penyewa.
2. Buka menu pembayaran.
3. Pilih pembayaran DP yang masih berstatus `pending`.
4. Masuk ke halaman detail pembayaran.
5. Pilih file bukti transfer.
6. Klik tombol Upload Bukti Pembayaran.
7. Periksa apakah file tersimpan di folder `uploads/bayar/`.
8. Periksa apakah data `ft_byr` berhasil diperbarui pada tabel `t_bayar`.
9. Pastikan gambar bukti pembayaran tampil pada halaman detail.

### 8. Hasil yang Diharapkan

- Form upload bukti pembayaran tampil pada halaman detail.
- Penyewa dapat memilih dan mengunggah foto bukti transfer.
- File tersimpan pada folder `uploads/bayar/`.
- Data bukti pembayaran tersimpan pada tabel `t_bayar`.
- Foto bukti pembayaran dapat ditampilkan kembali.
- Pembayaran tetap menunggu verifikasi admin.

### 9. Kesimpulan

Pada tahap 2 Praktikum Mandiri P9 berhasil ditambahkan fitur upload bukti pembayaran DP. Fitur ini digunakan untuk mengirimkan bukti transfer dari penyewa agar dapat diperiksa dan diverifikasi oleh admin pada tahap berikutnya.

**Tahap selanjutnya:** Tahap 3 – Membuat Fitur Verifikasi Pembayaran Admin.