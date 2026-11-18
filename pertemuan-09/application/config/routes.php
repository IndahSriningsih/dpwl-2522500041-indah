
<?php

$route = [];

// Default Controller
$route['default_controller'] = 'Katalog_controller';


// ==========================================
// ROUTE P3 - AUTENTIKASI
// ==========================================
$route['login'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';


// ==========================================
// ROUTE ADMIN
// ==========================================
$route['admin'] = 'admin/index';

$route['admin/madmin'] = 'madmin_controller/index';
$route['admin/madmin/tambah'] = 'madmin_controller/tambah';
$route['admin/madmin/ubah/(:any)'] = 'madmin_controller/ubah/$1';
$route['admin/madmin/hapus/(:any)'] = 'madmin_controller/hapus/$1';


// ==========================================
// ROUTE P5 - MANAJEMEN MOBIL
// ==========================================
$route['admin/mobil'] = 'Mobil_controller/index';
$route['admin/mobil/tambah'] = 'Mobil_controller/tambah';
$route['admin/mobil/ubah/(:any)'] = 'Mobil_controller/ubah/$1';
$route['admin/mobil/hapus/(:any)'] = 'Mobil_controller/hapus/$1';


// ==========================================
// ROUTE P6 - KATALOG DAN PENYEWA
// ==========================================
$route['katalog'] = 'Katalog_controller/index';
$route['katalog/detail/(:any)'] = 'Katalog_controller/detail/$1';

$route['auth/login-penyewa'] = 'Auth/loginPenyewa';
$route['auth/logout-penyewa'] = 'Auth/logoutPenyewa';

$route['penyewa/profil'] = 'Penyewa_controller/profil';


// ==========================================
// ROUTE P7 - TRANSAKSI DAN KERANJANG
// ==========================================
$route['transaksi/tambah'] = 'Transaksi_controller/tambah';
$route['transaksi/keranjang'] = 'Transaksi_controller/keranjang';
$route['transaksi/perbarui-periode'] = 'Transaksi_controller/perbaruiPeriode';
$route['transaksi/hapus'] = 'Transaksi_controller/hapus';
$route['transaksi/hapus/(:any)'] = 'Transaksi_controller/hapus/$1';
$route['transaksi/checkout'] = 'Transaksi_controller/checkout';


// ==========================================
// ROUTE P9 - PEMBAYARAN PENYEWA
// ==========================================
$route['pembayaran'] = 'Pembayaran_controller/index';
$route['pembayaran/detail/(:any)'] = 'Pembayaran_controller/detail/$1';
$route['pembayaran/upload/(:any)'] = 'Pembayaran_controller/upload/$1';


// ==========================================
// ROUTE P9 - VERIFIKASI PEMBAYARAN ADMIN
// ==========================================
$route['admin/verifikasi'] = 'Verifikasi_controller/index';
$route['admin/verifikasi/detail/(:any)'] = 'Verifikasi_controller/detail/$1';
$route['admin/verifikasi/terima/(:any)'] = 'Verifikasi_controller/terima/$1';
$route['admin/verifikasi/tolak/(:any)'] = 'Verifikasi_controller/tolak/$1';
