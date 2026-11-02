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