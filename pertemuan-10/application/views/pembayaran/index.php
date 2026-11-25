<?php
require APPPATH . 'views/katalog/header.php';

$e = static function ($value): string {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

require APPPATH . 'views/katalog/navbar.php';

$formatRupiah = static function ($nilai): string {
  return 'Rp ' . number_format((float) $nilai, 0, ',', '.');
};

// Label status pembayaran bagi penyewa.
$infoStatus = static function (array $p): array {
  $status = (string) ($p['sttus_byr'] ?? '');

  if ($status === 'pending') {
    return !empty($p['ada_bukti'])
      ? ['Menunggu verifikasi', 'bg-warning text-dark']
      : ['Belum ada bukti', 'bg-secondary'];
  }

  if ($status === 'valid') {
    return ['Diterima', 'bg-success'];
  }

  if ($status === 'invalid') {
    return ['Ditolak', 'bg-danger'];
  }

  return [$status !== '' ? $status : '-', 'bg-secondary'];
};

$daftar = is_array($daftarPembayaran ?? null) ? $daftarPembayaran : [];
?>

<section class="bg-success py-4">
  <div class="container">
    <h1 class="h2 text-white mt-3">Pembayaran Saya</h1>
    <p class="text-white mb-0">Daftar pembayaran uang muka (DP) dari transaksi yang telah Anda ajukan.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <?php if ($daftar === []): ?>
      <div class="alert alert-info" role="status">
        Belum ada pembayaran. Pembayaran DP dibuat setelah Anda mengajukan transaksi melalui checkout.
      </div>
      <a class="btn btn-outline-success" href="<?= $e(site_url('transaksi/keranjang')) ?>">
        <i class="fas fa-shopping-cart me-1" aria-hidden="true"></i> Buka Keranjang
      </a>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
          <thead class="table-light">
            <tr>
              <th scope="col">Kode Pembayaran</th>
              <th scope="col">Kode Transaksi</th>
              <th scope="col">Periode Sewa</th>
              <th scope="col" class="text-end">Nominal DP</th>
              <th scope="col" class="text-center">Status Pembayaran</th>
              <th scope="col" class="text-center">Status Transaksi</th>
              <th scope="col" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($daftar as $p): ?>
              <?php [$teksStatus, $kelasStatus] = $infoStatus($p); ?>
              <tr>
                <td class="text-nowrap"><?= $e($p['kode_bayar']) ?></td>
                <td class="text-nowrap"><?= $e($p['kode_sewa']) ?></td>
                <td class="text-nowrap"><?= $e($p['tgl_mulai']) ?> s.d. <?= $e($p['tgl_selesai']) ?></td>
                <td class="text-end text-nowrap"><?= $e($formatRupiah($p['nominal'])) ?></td>
                <td class="text-center"><span class="badge <?= $e($kelasStatus) ?>"><?= $e($teksStatus) ?></span></td>
                <td class="text-center"><span class="badge bg-secondary"><?= $e($p['status_sewa']) ?></span></td>
                <td class="text-center">
                  <a class="btn btn-sm btn-success"
                    href="<?= $e(site_url('pembayaran/detail?kode_bayar=' . rawurlencode((string) $p['kode_bayar']))) ?>">
                    Detail
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require APPPATH . 'views/katalog/footer.php'; ?>