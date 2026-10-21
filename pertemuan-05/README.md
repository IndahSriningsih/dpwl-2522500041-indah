# pertemuan-05
### A.5. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap A)

Pada tahap ini, dilakukan pembaruan struktur menu navigasi admin dan konfigurasi *route* dasar untuk fitur Manajemen Kendaraan:

1. **Perubahan Kode**:
   - **`application/views/templates/sidebar.php`**: Menambahkan item menu baru **Manajemen Kendaraan** (menggunakan ikon `fa-car`) di bawah menu *Manajemen Admin* yang mengarah ke URL `admin/mobil`.
   - **`application/config/routes.php`**: Menambahkan konfigurasi *route* `$route['admin/mobil'] = 'Mobil_controller/index';` untuk menghubungkan URL `admin/mobil` ke Controller yang akan menangani halaman utama kendaraan.

2. **Hasil Pengujian**:
   - Menu **Manajemen Kendaraan** berhasil tampil secara konsisten di bawah menu *Manajemen Admin* pada *sidebar*.
   - Saat menu diklik, URL pada peramban berhasil berubah menjadi `admin/mobil`.
   - Muncul pesan *"Controller tidak ditemukan."* ketika halaman diakses. Hal ini merupakan **kondisi yang diharapkan** (bukan galat pada sistem menu/route) karena berkas `Mobil_controller.php` belum dibuat dan baru akan diimplementasikan pada tahap C.

3. **Penyalinan & Git Commit**:
   - Seluruh hasil perubahan pada *workspace* (`dpwl-nim`) telah disalin ke folder arsip praktikum (`pertemuan-05`).
   - Perubahan dicatat ke repositori Git dengan perintah:
     ```bash
     git add .
     git commit -m "P5: Menambahkan menu dan route dasar Manajemen Kendaraan"
     git push
     ```
     ### B.3. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap B)

Pada tahap ini, dilakukan pembuatan komponen dasar *Controller* dan *View* untuk menangani tampilan utama halaman Manajemen Kendaraan:

1. **Perubahan Kode**:
   - **`application/controllers/Mobil_controller.php`**: Membuat *Controller* baru `Mobil_controller` yang mewarisi `CI_Controller`. Di dalamnya terdapat *method* `index()` yang memuat header, *sidebar*, *topbar*, tampilan utama (`admin/mobil_index`), dan footer.
   - **`application/views/admin/mobil_index.php`**: Membuat berkas *View* baru yang berisi struktur tampilan awal halaman Manajemen Kendaraan (seperti judul halaman, tombol *Tambah Data*, dan tabel tempat data kendaraan akan ditampilkan).

2. **Hasil Pengujian**:
   - Pengujian dilakukan dengan mengakses URL `admin/mobil` melalui peramban.
   - Halaman berhasil dimuat dengan sempurna tanpa pesan galat.
   - Tampilan *layout* utama admin (header, *sidebar*, *topbar*, footer) beserta konten awal dari berkas `mobil_index.php` muncul secara konsisten.

3. **Penyalinan & Git Commit**:
   - Seluruh hasil perubahan pada *workspace* (`dpwl-nim`) telah disalin ke folder arsip praktikum (`pertemuan-05`).
   - Perubahan dicatat ke repositori Git dengan perintah:
     ```bash
     git add .
     git commit -m "P5: Membuat Controller dan View dasar Manajemen Kendaraan"
     git push
     ```
     ### C.6. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap C)

Pada tahap ini, dilakukan penyempurnaan implementasi penuh bagi fitur Manajemen Kendaraan yang mencakup integrasi *Model*, pemrosesan data (CRUD: *Create, Read, Update, Delete*), penanganan unggahan foto, serta validasi formulir:

1. **Perubahan Kode**:
   - **`application/models/Mobil_model.php`**: Membuat *Model* baru untuk menangani interaksi basis data seperti mengambil data kendaraan, menambah data baru, memperbarui data, menghapus data, dan mengelola unggahan berkas gambar.
   - **`application/controllers/Mobil_controller.php`**: Melengkapi seluruh *method* logika bisnis mencakup `index()`, `tambah()`, `simpan()`, `edit()`, `update()`, dan `hapus()`.
   - **`application/views/admin/`**: 
     - Menyempurnakan `mobil_index.php` untuk menampilkan daftar data kendaraan secara dinamis dari basis data beserta tombol aksi.
     - Membuat berkas *View* `mobil_tambah.php` dan `mobil_edit.php` yang dilengkapi dengan formulir input dan validasi.

2. **Hasil Pengujian**:
   - **Tampil Data (Read)**: Data kendaraan dari basis data berhasil ditampilkan secara dinamis pada tabel halaman utama.
   - **Tambah & Edit Data (Create & Update)**: Validation rules berfungsi dengan baik, serta proses unggah foto depan kendaraan berhasil tersimpan ke dalam direktori server.
   - **Hapus Data (Delete)**: Fungsi hapus berhasil menghapus rekod data kendaraan beserta berkas foto terkait dari direktori.

3. **Penyalinan & Git Commit**:
   - Seluruh hasil perubahan pada *workspace* (`dpwl-nim`) telah disalin ke folder arsip praktikum (`pertemuan-05`).
   - Perubahan dicatat ke repositori Git dengan perintah:
     ```bash
     git add .
     git commit -m "P5: Menyelesaikan implementasi CRUD dan penanganan foto Manajemen Kendaraan"
     git push
     ```

     ### D.5. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap D)

Pada tahap akhir ini, dilakukan pengujian menyeluruh (*end-to-end testing*), pembersihan kod, serta pemastian integrasi dan keselamatan sistem bagi keseluruhan fitur Manajemen Kendaraan:

1. **Pembersihan dan Optimasi Kode**:
   - Menghapus kod penyahpepijatan (*debugging code*) dan komen sementara pada berkas *Controller*, *Model*, dan *View*.
   - Memastikan struktur laluan direktori foto dan nama pemboleh ubah telah konsisten di seluruh aplikasi.
   - Memastikan mekanisme validasi input dan pengurusan ralat (*error handling*) berfungsi dengan baik apabila pengguna memasukkan format data yang salah atau gagal memuat naik foto.

2. **Hasil Pengujian Akhir**:
   - Keseluruhan alur kerja (*workflow*) CRUD (Tambah, Papar, Kemas Kini, dan Hapus) bagi data kendaraan berfungsi dengan lancar tanpa sebarang galat.
   - Antaramuka (*UI*) halaman Manajemen Kendaraan tampil kemas, responsif, dan sejajar pada pelbagai saiz skrin.
   - Pengurusan fail gambar (muat naik fail baharu dan pemadaman fail lama semasa kemas kini/hapus) berjalan dengan stabil pada pelayan.

3. **Penyalinan & Git Commit**:
   - Seluruh hasil perubahan akhir pada *workspace* (`dpwl-nim`) telah disalin ke folder arkib praktikum (`pertemuan-05`).
   - Perubahan dicatat dan dikemas kini ke repositori Git dengan perintah:
     ```bash
     git add .
     git commit -m "P5: Finalisasi, pembersihan kode, dan pengujian akhir Manajemen Kendaraan"
     git push
     ```
     ### E.6. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap E)

Pada tahap integrasi dan pengemasan akhir ini, dilakukan penyesuaian akhir pada struktur repositori serta pemastian bahawa seluruh dokumentasi praktikum telah lengkap dan tersusun rapi:

1. **Penyemakan Dokumentasi & Struktur Projek**:
   - Memastikan fail `README.md` telah dikemas kini sepenuhnya dengan liputan laporan bagi setiap tahap (Tahap A hingga Tahap E).
   - Memeriksa semula struktur folder `pertemuan-05` untuk memastikan semua fail *Controller*, *Model*, *View*, serta aset gambar yang diperlukan telah disalin dengan betul dari *workspace* utama (`dpwl-nim`).

2. **Hasil Pengukuhan Akhir**:
   - Dokumentasi projek mencerminkan keseluruhan proses pembangunan sistem secara sistematik dan terperinci.
   - Kod sumber (*source code*) bagi modul Manajemen Kendaraan sedia untuk dikesan, diselenggara, dan dinilai tanpa sebarang fail berangkai yang tertinggal.

3. **Penyalinan & Git Commit**:
   - Seluruh penyesuaian akhir dokumentasi pada folder arkib praktikum (`pertemuan-05`) telah disalin dan dikemas kini.
   - Perubahan akhir dicatat dan dihantar ke repositori Git melalui perintah:
     ```bash
     git add .
     git commit -m "P5: Melengkapi seluruh dokumentasi README dan penyelesaian modul Manajemen Kendaraan"
     git push
     ```
     ### F.4. Memperbarui Dokumentasi dan Mencatat Perubahan Git (Tahap F)

Pada tahap semakan akhir dan penyerahan tugasan ini, seluruh repositori telah disahkan berada dalam keadaan stabil, lengkap, dan sedia untuk dinilai:

1. **Penyemakan Akhir Repositori**:
   - Memastikan tiada fail sementara, log penyahpepijatan (*debug logs*), atau fail yang tidak diperlukan tertinggal dalam folder `pertemuan-05`.
   - Semakan semula dilakukan ke atas pautan aset, sambungan basis data, dan laluan *route* bagi memastikan modul berjalan tanpa sebarang ralat pada persekitaran ujian.
   - Dokumen `README.md` dikemas kini sepenuhnya dengan penutup dan ringkasan akhir keseluruhan pelaksanaan praktikum Pertemuan 05.

2. **Hasil Pengesahan Penyerahan**:
   - Seluruh struktur modul Manajemen Kendaraan dan dokumen sokongan berada dalam keadaan lengkap dan tersusun mengikut piawaian tugasan.
   - Perubahan terakhir telah berjaya disinkronkan ke dalam cawangan (*branch*) utama repositori Git secara selamat.

3. **Penyalinan & Git Commit**:
   - Kemas kini akhir bagi dokumentasi dan pembersihan folder pada `pertemuan-05` telah disalin sepenuhnya.
   - Komit dan penolakan (*push*) akhir dilakukan ke repositori Git melalui perintah:
     ```bash
     git add .
     git commit -m "P5: Penutupan dokumentasi dan penyerahan akhir modul Manajemen Kendaraan"
     git push
     ```