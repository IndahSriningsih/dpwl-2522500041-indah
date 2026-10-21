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