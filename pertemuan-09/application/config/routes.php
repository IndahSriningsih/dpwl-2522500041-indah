<?php

$route = [];

// Default Controller
$route['default_controller'] = 'Katalog_controller';

// Route autentikasi P3
$route['login'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

// Route halaman administrasi
$route['admin'] = 'admin/index';
$route['admin/madmin'] = 'madmin_controller/index';
$route['admin/madmin/tambah'] = 'madmin_controller/tambah';
$route['admin/madmin/ubah/(:any)'] = 'madmin_controller/ubah/$1';
$route['admin/madmin/hapus/(:any)'] = 'madmin_controller/hapus/$1';

// Route P5 - Mobil
$route['admin/mobil'] = 'Mobil_controller/index';
$route['admin/mobil/tambah'] = 'Mobil_controller/tambah';
$route['admin/mobil/ubah/(:any)'] = 'Mobil_controller/ubah/$1';
$route['admin/mobil/hapus/(:any)'] = 'Mobil_controller/hapus/$1';

// Route P6 - Katalog dan Penyewa
$route['katalog'] = 'Katalog_controller/index';
$route['katalog/detail/(:any)'] = 'Katalog_controller/detail/$1';
$route['auth/login-penyewa'] = 'Auth/loginPenyewa';
$route['auth/logout-penyewa'] = 'Auth/logoutPenyewa';
$route['penyewa/profil'] = 'Penyewa_controller/profil';

// Route P7 - Transaksi dan Keranjang
$route['transaksi/tambah'] = 'Transaksi_controller/tambah';
$route['transaksi/keranjang'] = 'Transaksi_controller/keranjang';
$route['transaksi/perbarui-periode'] = 'Transaksi_controller/perbaruiPeriode';
$route['transaksi/hapus'] = 'Transaksi_controller/hapus';
$route['transaksi/hapus/(:any)'] = 'Transaksi_controller/hapus/$1';
$route['transaksi/checkout'] = 'Transaksi_controller/checkout';

// Route P9 - Pembayaran Penyewa
$route['pembayaran'] = 'Pembayaran_controller/index';
$route['pembayaran/detail/(:any)'] = 'Pembayaran_controller/detail/$1';
$route['pembayaran/upload/(:any)'] = 'Pembayaran_controller/upload/$1';