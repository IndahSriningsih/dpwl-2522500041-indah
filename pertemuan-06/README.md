# pertemuan-06
# Dokumentasi Praktikum Pertemuan 6 (P6)
**Mata Kuliah:** Desain dan Pemrograman Web Lanjutan (IS203)  
**Topik:** Antarmuka Sisi Pengguna Berbasis MVC: TemplateMo, Katalog, Detail, Autentikasi, dan Profil  

---

## A. Integrasi TemplateMo Zay Shop sebagai Antarmuka Sisi Pengguna

### 1. Tahap Pengembangan
* Menyiapkan direktori pengumpulan dan ruang kerja proyek `pertemuan-06`[cite: 4].
* Mengekstrak templat **TemplateMo 559 - Zay Shop** dan menguji/mengidentifikasi struktur komponen antarmuka yang akan digunakan[cite: 5].
* Memindahkan aset Zay Shop ke dalam direktori `assets/zay/` pada ruang kerja aplikasi[cite: 6].
* Menyesuaikan komponen header, navigasi, dan footer agar selaras dengan kebutuhan aplikasi rental kendaraan[cite: 7].

### 2. Berkas dan Komponen yang Ditambahkan / Diubah
* **Aset Baru:** `assets/zay/css/`, `assets/zay/img/`, `assets/zay/js/`, dan `assets/zay/webfonts/`[cite: 6].
* **Catatan Penyesuaian Berkas:**
  * Berkas HTML asli templat (`index.html`, `shop.html`, `shop-single.html`) dipilah untuk diintegrasikan ke komponen View aplikasi MVC[cite: 6, 7].
  * Berkas `about.html` dan `contact.html` diabaikan sesuai lingkup praktikum P6[cite: 6].

### 3. Perubahan dan Fitur yang Diimplementasikan
* Pengaturan struktur direktori aset antarmuka pengguna di bawah `assets/zay/`[cite: 6].
* Identifikasi jalur relatif bawaan templat HTML untuk disesuaikan dengan fungsi helper URL CodeIgniter (`base_url()` dan `site_url()`)[cite: 8, 10].

### 4. Langkah Pengujian Awal Pemuatan Aset
1. Memeriksa keberadaan struktur folder `assets/zay/` beserta seluruh direktori di dalamnya (`css`, `img`, `js`, `webfonts`)[cite: 8].
2. Memastikan keberadaan berkas CSS utama:
   * `bootstrap.min.css`[cite: 8]
   * `templatemo.css`[cite: 8]
   * `custom.css`[cite: 8]
   * `fontawesome.min.css`[cite: 8]
3. Memastikan keberadaan berkas JavaScript utama:
   * `jquery-1.11.0.min.js`[cite: 8]
   * `bootstrap.bundle.min.js`[cite: 8]
   * `templatemo.js`[cite: 8]
   * `custom.js`[cite: 8]
4. Memeriksa ketersediaan ikon font di direktori `assets/zay/webfonts/` dan gambar dasar di `assets/zay/img/`[cite: 8].

### 5. Hasil Pengujian Aktual dan Status
* **Status Aset:** Berkas aset fisik (CSS, JS, Webfonts, Gambar) telah berhasil disalin ke `assets/zay/` tanpa menghapus aset admin/P5 yang sudah ada[cite: 6, 8].
* **Catatan Integrasi URL Aset:** Referensi jalur relatif templat asli (seperti `href="assets/css/bootstrap.min.css"`) telah dicatat dan dipisahkan untuk disesuaikan menggunakan pemanggilan `<?= base_url('assets/zay/css/bootstrap.min.css') ?>` saat tahap penggabungan ke View[cite: 7, 8].
* **Status Fitur:** Siap dilanjutkan ke tahap integrasi Model-Controller-View (MCV) Katalog Kendaraan.