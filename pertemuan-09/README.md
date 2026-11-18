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