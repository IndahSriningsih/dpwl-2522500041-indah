## Laporan Ringkasan Pengujian (Modul P7)

---
### 1. Tahap A: Validasi Kesiapan Artefak P6
* **Prosedur Pengujian**: Memeriksa kesiapan struktur basis data, tata kelola folder *workspace*, serta fungsi-fungsi utama dari P6 (autentikasi akun, katalog kendaraan, rincian mobil, dan modul profil penyewa).
* **Hasil Eksekusi**: Seluruh fungsi P6 berjalan dengan lancar tanpa hambatan dan siap dijadikan *baseline* untuk pengembangan modul P7.
* **Status**: **Berhasil**

### 2. Tahap B: Pengembangan Model, Controller Transaksi, dan Pendaftaran Route
* **Prosedur Pengujian**: Menguji mekanisme penguncian *database* `GET_LOCK()`, pembentukan format kode sewa otomatis (`INV/YYYYMMDD/NN`), pembatasan metode HTTP (`POST`/`GET`), serta pemetaan jalur URL `/transaksi/tambah`.
* **Hasil Eksekusi**: Berkas `Transaksi_model` dan `Transaksi_controller` berhasil terstruktur dengan baik. Jalur `transaksi/tambah` terhubung secara akurat.
* **Status**: **Berhasil**

### 3. Tahap C: Integrasi Tombol Aksi Keranjang pada Katalog dan Detail Mobil
* **Prosedur Pengujian**:
  1. Mengunjungi halaman katalog dan rincian unit saat posisi *guest* (memastikan tombol *Tambah ke Keranjang* terkunci/mengarahkan ke menu masuk).
  2. Mengunjungi halaman katalog dan rincian unit setelah berhasil masuk ke akun penyewa (memastikan tombol aksi berfungsi aktif pada mobil yang tersedia).
  3. Menguji respons sistem terhadap kendaraan dengan status sedang disewa atau tidak tersedia.
* **Hasil Eksekusi**: Perilaku tombol merespons kondisi sesi penyewa dan ketersediaan unit secara presisi. Kendaraan yang tidak tersedia otomatis menyajikan tombol nonaktif bertuliskan *Tidak Dapat Disewa*.
* **Status**: **Berhasil**

### 4. Tahap D: Pesan Notifikasi, Tautan, dan Jumlah Keranjang pada Navbar
* **Langkah Pengujian**:
  1. Memeriksa keberadaan ikon dan *badge* jumlah keranjang pada `navbar.php`.
  2. Menguji navigasi dari berbagai halaman (Katalog, Detail, dan Profil) untuk memastikan data jumlah keranjang terkirim dengan konsisten.
  3. Memeriksa penanganan pesan notifikasi (*flash message*) saat penambahan barang atau error.
* **Hasil Aktual**: *Badge* jumlah keranjang pada *header*/navbar secara dinamis menampilkan total kendaraan dalam keranjang milik penyewa aktif. Pesan notifikasi sukses/error tampil dan dapat ditutup (*dismissible*).
* **Status**: **Berhasil**

### 5. Tahap E: Integrasi Proses Penambahan Kendaraan ke Keranjang
* **Langkah Pengujian**:
  1. Login sebagai penyewa, kemudian buka halaman katalog.
  2. Pilih kendaraan dengan status tersedia dan klik tombol *Tambah ke Keranjang*.
  3. Pastikan aplikasi kembali ke halaman katalog dan menampilkan notifikasi bahwa kendaraan berhasil ditambahkan.
  4. Periksa tabel `t_sewa` dan `t_pilih` melalui phpMyAdmin untuk memastikan data transaksi dan kendaraan tersimpan dengan `kode_sewa` yang sama.
  5. Tambahkan kendaraan lain dan pastikan kendaraan tersebut masuk ke keranjang aktif yang sama.
  6. Coba tambahkan kendaraan yang sama untuk kedua kalinya dan pastikan sistem menolak penambahan duplikat.
* **Hasil Aktual**: Proses penambahan kendaraan ke keranjang berhasil dijalankan. Data transaksi tersimpan pada tabel `t_sewa`, sedangkan data kendaraan yang dipilih tersimpan pada tabel `t_pilih` dengan `kode_sewa` yang sesuai. Penambahan kendaraan lain menggunakan keranjang aktif yang sama, dan sistem berhasil mencegah penambahan kendaraan yang sama secara duplikat. Hasil pemeriksaan melalui phpMyAdmin menunjukkan bahwa penyimpanan data telah sesuai dengan ketentuan.
* **Status**: **Berhasil**

### 6. Tahap F: Implementasi Modul Keranjang dan Finalisasi Checkout

#### F.1. Penyusunan Halaman Rincian Keranjang (`views/transaksi/keranjang.php`)
* **Pengujian**: Menampilkan rincian kendaraan, rentang waktu sewa, tarif harian, kalkulasi durasi, hingga total biaya. Halaman dibekali fitur penyesuaian jadwal sewa, pembatalan/penghapusan item, serta navigasi menuju *checkout*.
* **Hasil**: **Berhasil & Terverifikasi**

#### F.2. Integrasi Method Keranjang pada Controller (`Transaksi_controller.php`)
* **Pengujian**: Mengintegrasikan Model, Controller, dan Route untuk mengelola penambahan armada, penyajian keranjang, penyesuaian tanggal sewa, penghapusan unit, hingga tahapan *checkout*. Pengujian dilakukan pada penyewa dengan keranjang aktif maupun keranjang kosong. Lencana pada bilah navigasi turut diperiksa.
* **Hasil**: **Berhasil & Terverifikasi**

#### F.3. Pembuatan Halaman Konfirmasi dan Validasi Checkout
* **F.3.1. Tampilan Konfirmasi Transaksi (`views/transaksi/konfirmasi.php`)**: Menghasilkan resume persewaan, kalkulasi total tagihan, penentuan DP sebesar 30%, serta sisa biaya yang wajib dilunasi. (**Status: Berhasil**)
* **F.3.2. Pengujian Tampilan Konfirmasi Checkout**: Memastikan seluruh kalkulasi transaksi disajikan secara akurat dan tombol navigasi kembali ke keranjang berfungsi sebagaimana mestinya. (**Status: Berhasil**)
* **F.3.3. Pengujian Alur Eksekusi Checkout**:
  * Pesan dialog konfirmasi JavaScript muncul sebelum formulir dikirimkan.
  * Permohonan sewa berhasil diajukan dan penyewa diarahkan kembali ke halaman katalog dengan notifikasi sukses.
  * Pengecekan pada basis data memastikan:
    - Status sewa berubah dari `keranjang` menjadi `diajukan`.
    - Setoran Uang Muka (DP 30%) terekam pada tabel `t_bayar` dengan kondisi status `pending`.
    - Nomor transaksi yang telah diajukan terkunci dan tidak dapat diakses kembali sebagai keranjang aktif.
  * **Status**: **Berhasil & Terverifikasi**