# pertemuan-02
## 1. Tujuan Praktikum
Jawaban:
Agar bisa memahami dan mampu membangun fondasi arsitektur MVC buatan sendiri
## 2. Struktur Direktori
Jawaban:
dpwl-2522500041/
├── application/
│   ├── config/
│   │   ├── config.php
│   │   └── routes.php
│   ├── controllers/
│   │   └── home.php
│   ├── helpers/
│   │   └── url_helper.php
│   └── views/
│       └── home/
│           ├── index.php
│           └── info.php
├── assets/
│   └── css/
│       └── app.css
├── system/
│   └── core/
│       ├── controller.php
│       └── router.php
└── index.php
fungsi bagian:index.php gerbang utama
aplication tempat utama proyek tempat ngoding aplikasi
config pengaturan aplikasi, config.php untuk data base URL, Routes.php untuk aturan URL,controllers otak pemroses logika yang mengatur alur request, helpers skrip pembantu untuk fungsi, views tampilan UI/HTML yang dilihat user, assets tempat file statis untuk styling tampilan, sytem/core mesin utama frame work buatan sendiri, controller.php induk controller, router.php pemecahan URL
## 3. Front controller
 Jawaban:
 indeks phpitu seperti penjaga sekaligus resepionis dipintu masuk depan aplikasiSemua request atau akses URL dari user bakal masuk lewat file ini dulu, dia yang nyiapin "mesin" aplikasi, manggil file konfigurasi, lalu nyuruh Router buat ngarahin user ke Controller dan View yang pas. Jadi, user nggak bisa asal masuk atau 'nyelonong' langsung ke file dalam folder lain.
## 4. Routing dan Pemetaan URL
| URL/Route | Controller | Method | Parameter | View |
|---|---|---|---|---|
| / | Home | index | - | home/index.php |
| home/index | Home | index | - | home/index.php |
| home/info/mvc | Home | info | mvc | home/info.php |
| info/routing | Home | info | routing | home/info.php |
Tambahkan satu baris untuk route hasil Tahap Modifikasi ATM yang dibuat berdasarkan objek atau konteks
aplikasi DPW, kemudian jelaskan pemetaan route → Controller → method → parameter → View.
Jawaban;
| mahasiswa/detaail/2522500041 |Mahasiswa | detail| 2522500041 | mahasiswa/detail.php |

penjelasan:
​.URL/Route (mahasiswa/detail/2522500041)
Ini alamat yang diketik user di browser buat melihat profil mahasiswa berdasarkan NIM.
.​Controller (Mahasiswa)
Alamat di atas langsung ditangkap sama router buat memanggil controller Mahasiswa yang bertugas mengurus logika data mahasiswa.
.Method (detail)
Di dalam controller Mahasiswa, sistem menjalankan fungsi/method detail() untuk memproses data.
​.Parameter (2522500041)
Angka NIM ini dilempar sebagai input variabel ke method detail(), jadi sistem tahu data mahasiswa mana yang mau dicari.
​.View (mahasiswa/detail.php)
Setelah datanya dapat, controller langsung me-render dan menampilkan hasilnya ke layar user lewat file mahasiswa/detail.php.

## 5. Base URL dan Helper
Jelaskan fungsi base_url() dan site_url(), kemudian berikan contoh penggunaannya pada implementasi P2:
- base_url() untuk memanggil assets/css/app.css;
- site_url() untuk membentuk URL navigasi/route aplikasi.
Jawaban:Jelaskan
.​base_url(): Digunakan untuk mengambil alamat domain utama/root web
.​site_url(): Digunakan untuk membuat link navigasi atau route aplikasi yang otomatis melewati front controller
contoh:
.Memanggil file CSS ( BASE_URL())
hasil render HTML:
<link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
.membuat link navigasi/route(site())
​Hasil render HTML:
<a href="http://localhost/dpwl-2522500041/index.php/home/info/mvc">Cek Info MVC</a>

## 6. Alur Request-response
 ​1. Alur Eksekusi Aktual P2 (Tanpa Model)
​Alur ini adalah proses kerja yang kita jalankan di P2, di mana datanya masih bersifat statis (belum ambil dari database):  
​Browser \rightarrow User mengetik URL di browser dan tekan Enter.  
​index.php \rightarrow Request diterima pintu utama (Front Controller).  
​Router \rightarrow Memecah URL untuk menentukan Controller dan Method mana yang harus dipanggil.  
​Controller \rightarrow Eksekusi logika dasar dan menyiapkan data yang mau ditampilkan.  
​View \rightarrow Controller memanggil file View (HTML) dan menyisipkan datanya ke tampilan.  
​Response \rightarrow Hasil akhir tampilan HTML dikirim balik ke browser user.  
​2. Posisi Model dalam Arsitektur MVC Lengkap (Nanti di P3)
​Di arsitektur MVC utuh, Model berperan sebagai "kurir data" yang menjembatani Controller dengan Database:
​Browser \rightarrow index.php \rightarrow Router \rightarrow Controller (Alurnya sama seperti P2).  
​Model \rightarrow Controller minta tolong ke Model untuk mengambil/mengolah data.
​Basis Data / Data \rightarrow Model melakukan query (panggil/simpan) ke Database.
​Basis Data \rightarrow Model \rightarrow Controller \rightarrow Database memberikan datanya ke Model, lalu Model menyerahkannya kembali ke Controller.
​View \rightarrow Response \rightarrow Controller melempar data mentah tadi ke View agar dirapiin jadi tampilan web, lalu dikirim ke browser user.
## 7. Hasil Pengujian dan Debugging
 Gejala: Muncul error 'php' is not recognized... saat mengetik php -l index.php di terminal VS Code.  
​Penyebab: Path folder PHP (Laragon/XAMPP) belum terdaftar di Environment Variables (PATH) Windows.
​Perbaikan: Menambahkan direktori PHP ke PATH System Windows dan mengubah terminal default VS Code ke CMD/Git Bash.
​Hasil Uji Ulang: Setelah VS Code di-restart, perintah php -l berjalan lancar dengan respon No syntax errors detected pada seluruh file.
## 8. Bukti Tangkapan Layar
Sisipkan gambar yang relevan dari folder dokumentasi/ dengan perintah:
### Gambar 1. Hasil Pengujian Halaman Utama
![Gambar 1 - Halaman Utama](dokumentasi/gambar1.jpg)
### Gambar 2. Hasil Pengujian Custom Route
![Gambar 2 - Custom Route](dokumentasi/gambar2.jpg)
## 9. Kesimpulan P2
Jelaskan apa yang sudah dapat dilakukan kerangka MVC dan apa yang baru akan ditambahkan pada P3.
Jawaban:
Yang Sudah Bisa di P2:
Web kita sudah punya pintu masuk terpusat (index.php), URL-nya sudah bisa dibaca otomatis sama Router buat panggil Controller, dan Controller sudah bisa nampilin halaman HTML/CSS pakai bantuan base_url() & site_url().  struktur dan jalurnya sudah jadi  
​Yang Baru Ditambah di P3:
Kita baru mulai bikin komponen Model buat nyambungin aplikasi ke Database (MySQL). Jadi di P3 nanti websitenya tidak cuma nampilin halaman statis lagi, tapi sudah bisa CRUD (tampil, tambah, edit, dan hapus data asli dari database).