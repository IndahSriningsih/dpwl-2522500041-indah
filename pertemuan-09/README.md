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


# PRAKTIKUM MANDIRI P9
## TAHAP 3 – MEMBUAT VERIFIKASI PEMBAYARAN ADMIN

### 1. Deskripsi
Tahap 3 merupakan pengembangan fitur verifikasi pembayaran oleh admin pada aplikasi rental kendaraan. Fitur ini digunakan untuk memeriksa bukti pembayaran yang telah diunggah oleh penyewa, kemudian menentukan apakah pembayaran diterima atau ditolak.

### 2. Tujuan
- Membuat halaman verifikasi pembayaran admin.
- Menampilkan daftar pembayaran yang menunggu verifikasi.
- Menampilkan detail informasi pembayaran dan penyewa.
- Menampilkan bukti pembayaran yang telah diunggah.
- Menyediakan fitur menerima dan menolak pembayaran.
- Memperbarui status pembayaran dan transaksi sewa secara otomatis.

### 3. File yang Dibuat dan Diubah

**A. Model**

Lokasi: `application/models/Verifikasi_model.php`

Fungsi:
- Mengambil daftar pembayaran dengan status `pending`.
- Mengambil detail pembayaran berdasarkan kode pembayaran.
- Memproses keputusan verifikasi pembayaran.
- Memperbarui status pembayaran dan status transaksi sewa.

**B. Controller**

Lokasi: `application/controllers/Verifikasi_controller.php`

Fungsi:
- Memeriksa login dan status admin.
- Menampilkan daftar pembayaran.
- Menampilkan detail pembayaran.
- Memeriksa keberadaan file bukti pembayaran.
- Memproses tindakan menerima dan menolak pembayaran.
- Mengirim pesan pemberitahuan setelah proses verifikasi.

**C. View**

Lokasi: `application/views/admin/`

File:
- `verifikasi.php` – halaman daftar pembayaran.
- `verifikasi_detail.php` – halaman detail pembayaran.

Kedua halaman menggunakan template AdminLTE yang terdiri dari header, sidebar, dan footer.

**D. Routes**

Lokasi: `application/config/routes.php`

Routes yang ditambahkan:

```php
$route['admin/verifikasi'] = 'Verifikasi_controller/index';
$route['admin/verifikasi/detail/(:any)'] = 'Verifikasi_controller/detail/$1';
$route['admin/verifikasi/terima/(:any)'] = 'Verifikasi_controller/terima/$1';
$route['admin/verifikasi/tolak/(:any)'] = 'Verifikasi_controller/tolak/$1';
```

**E. Sidebar Admin**

Lokasi: `application/views/templates/sidebar.php`

Menambahkan menu:
- Verifikasi Pembayaran

Menu digunakan admin untuk membuka halaman daftar pembayaran.

### 4. Alur Kerja Verifikasi Pembayaran

1. Admin melakukan login ke aplikasi.
2. Admin membuka menu Verifikasi Pembayaran.
3. Sistem menampilkan daftar pembayaran yang berstatus `pending`.
4. Admin memilih tombol Detail.
5. Sistem menampilkan informasi penyewa, transaksi, nominal, dan bukti pembayaran.
6. Admin memeriksa bukti pembayaran.
7. Admin memilih Terima atau Tolak.
8. Sistem memperbarui status pembayaran dan transaksi sewa.

### 5. Ketentuan Status Pembayaran

| Keputusan Admin | Status Pembayaran | Status Sewa |
|---|---|---|
| Terima | `valid` | `disetujui` |
| Tolak | `invalid` | `ditolak` |

Sistem hanya mengizinkan verifikasi jika pembayaran masih berstatus `pending`, transaksi masih berstatus `diajukan`, dan file bukti pembayaran tersedia.

### 6. Keamanan Sistem

- Halaman verifikasi hanya dapat diakses oleh admin yang sudah login dan berstatus aktif.
- Penyewa tidak dapat mengakses halaman verifikasi admin.
- Proses menerima dan menolak pembayaran menggunakan metode POST.
- File bukti pembayaran diperiksa keberadaannya sebelum verifikasi.
- Pembayaran yang sudah diproses tidak dapat diverifikasi kembali.
- Perubahan status pembayaran dan transaksi dilakukan menggunakan transaksi database agar konsisten.

### 7. Pengujian

Pengujian yang dilakukan:

1. Login sebagai admin.
2. Membuka menu Verifikasi Pembayaran.
3. Memastikan daftar pembayaran pending muncul.
4. Membuka detail pembayaran.
5. Memastikan informasi penyewa dan bukti pembayaran tampil.
6. Mencoba menerima pembayaran.
7. Memeriksa perubahan status menjadi `valid` dan `disetujui`.
8. Mencoba menolak pembayaran.
9. Memeriksa perubahan status menjadi `invalid` dan `ditolak`.
10. Memastikan pembayaran tanpa bukti tidak dapat diverifikasi.
11. Memastikan pembayaran yang sudah diproses tidak dapat diproses kembali.
12. Memastikan pengguna yang bukan admin tidak dapat mengakses halaman verifikasi.

### 8. Kesimpulan

Pada tahap 3 Praktikum Mandiri P9, telah dibuat fitur verifikasi pembayaran admin pada aplikasi rental kendaraan. Admin dapat melihat daftar pembayaran, memeriksa detail dan bukti pembayaran, serta menerima atau menolak pembayaran.

Fitur ini membantu memastikan pembayaran penyewa diperiksa terlebih dahulu sebelum transaksi sewa disetujui. Status pembayaran dan transaksi juga diperbarui secara otomatis sesuai keputusan admin.

---

**Praktikum Mandiri P9 – Tahap 3**  
**Membuat Verifikasi Pembayaran Admin**

# README P9 – TAHAP 4
## Menguji dan Memperbaiki Proses Pembayaran

### 1. Deskripsi
Tahap 4 merupakan tahap pengujian dan perbaikan proses pembayaran pada aplikasi penyewaan kendaraan. Pengujian dilakukan untuk memastikan fitur pembayaran penyewa, upload bukti pembayaran, dan verifikasi pembayaran oleh admin dapat berjalan dengan baik.

### 2. Tujuan
- Memastikan halaman pembayaran penyewa dapat ditampilkan.
- Memastikan penyewa dapat melihat informasi pembayaran.
- Memastikan fitur upload bukti pembayaran berfungsi.
- Memastikan bukti pembayaran tersimpan dengan benar.
- Memastikan admin dapat melihat daftar pembayaran yang menunggu verifikasi.
- Memastikan admin dapat menerima atau menolak pembayaran.
- Memastikan status pembayaran dan status penyewaan diperbarui dengan benar.

### 3. Proses Pengujian

#### A. Pengujian Halaman Pembayaran Penyewa
1. Jalankan aplikasi melalui browser.
2. Login menggunakan akun penyewa.
3. Buka halaman pembayaran.
4. Periksa informasi pembayaran dan nominal DP.
5. Pastikan data pembayaran sesuai dengan transaksi penyewaan.

**Hasil yang diharapkan:** Halaman pembayaran tampil dan informasi pembayaran sesuai dengan transaksi.

#### B. Pengujian Upload Bukti Pembayaran
1. Buka halaman pembayaran penyewa.
2. Pilih file bukti pembayaran.
3. Upload bukti pembayaran.
4. Periksa apakah file berhasil tersimpan di folder `uploads/bayar/`.
5. Pastikan status pembayaran masih menunggu verifikasi (`pending`).

**Hasil yang diharapkan:** Bukti pembayaran berhasil diunggah dan nama file tersimpan pada data pembayaran.

#### C. Pengujian Verifikasi Pembayaran Admin
1. Login menggunakan akun admin.
2. Buka menu Verifikasi Pembayaran.
3. Pilih salah satu data pembayaran.
4. Periksa detail pembayaran dan bukti yang diunggah.
5. Klik tombol Terima atau Tolak.
6. Periksa perubahan status pembayaran dan penyewaan.

**Hasil yang diharapkan:**
- Jika diterima, status pembayaran berubah menjadi `valid` dan status penyewaan menjadi `disetujui`.
- Jika ditolak, status pembayaran berubah menjadi `invalid` dan status penyewaan menjadi `ditolak`.

### 4. Pengujian Kondisi Kesalahan
Beberapa kondisi yang perlu diuji:
- Penyewa belum mengunggah bukti pembayaran.
- Format atau ukuran file tidak sesuai ketentuan aplikasi.
- File bukti pembayaran tidak ditemukan.
- Admin mencoba memverifikasi pembayaran yang sudah diproses.
- Pengguna yang bukan admin mencoba membuka halaman verifikasi.
- Data pembayaran tidak ditemukan.

**Hasil yang diharapkan:** Sistem menampilkan pesan kesalahan yang sesuai dan tidak memproses pembayaran secara tidak benar.

### 5. Perbaikan yang Dilakukan
Perbaikan dilakukan berdasarkan hasil pengujian, antara lain:
1. Memperbaiki tampilan halaman pembayaran agar informasi lebih mudah dibaca.
2. Memastikan proses upload menyimpan file pada folder yang benar.
3. Memastikan data bukti pembayaran tersimpan pada tabel `t_bayar`.
4. Memastikan halaman verifikasi hanya dapat diakses oleh admin yang aktif.
5. Memastikan tombol Terima dan Tolak memproses data melalui metode POST.
6. Memastikan status pembayaran dan penyewaan diperbarui secara konsisten.
7. Memastikan sistem tidak memproses verifikasi yang sama lebih dari satu kali.

### 6. Kesimpulan
Pada tahap 4 dilakukan pengujian terhadap seluruh proses pembayaran, mulai dari penyewa melihat informasi pembayaran, mengunggah bukti pembayaran, hingga admin melakukan verifikasi. Perbaikan dilakukan terhadap bagian yang belum berjalan sesuai harapan agar proses pembayaran pada aplikasi penyewaan kendaraan dapat berjalan dengan baik dan terintegrasi dengan sistem transaksi P7.

**Catatan:** Isi hasil pengujian berdasarkan kondisi aplikasi setelah benar-benar diuji. Jika masih ditemukan kendala, tuliskan kendala dan perbaikannya sesuai hasil yang sebenarnya.