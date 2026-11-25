<?php
require APPPATH . 'views/katalog/header.php';

$e = static function ($value): string {
  return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

require APPPATH . 'views/katalog/navbar.php';

$formatRupiah = static function ($nilai): string {
  return 'Rp ' . number_format((float) $nilai, 0, ',', '.');
};

$p = is_array($pembayaran ?? null) ? $pembayaran : [];
$detail = is_array($p['detail'] ?? null) ? $p['detail'] : [];

// Label status pembayaran bagi penyewa.
$status = (string) ($p['sttus_byr'] ?? '');
$adaBukti = !empty($p['ada_bukti']);

if ($status === 'pending') {
  [$teksStatus, $kelasStatus] = $adaBukti
    ? ['Menunggu verifikasi', 'bg-warning text-dark']
    : ['Belum ada bukti', 'bg-secondary'];
} elseif ($status === 'valid') {
  [$teksStatus, $kelasStatus] = ['Diterima', 'bg-success'];
} elseif ($status === 'invalid') {
  [$teksStatus, $kelasStatus] = ['Ditolak', 'bg-danger'];
} else {
  [$teksStatus, $kelasStatus] = [$status !== '' ? $status : '-', 'bg-secondary'];
}
?>

<section class="bg-success py-4">
  <div class="container">
    <h1 class="h2 text-white mt-3">Detail Pembayaran</h1>
    <p class="text-white mb-0">Pembayaran uang muka (DP) untuk transaksi <?= $e($p['kode_sewa'] ?? '') ?>.</p>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row g-4 mb-4">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-light">
            <h2 class="h5 mb-0">Informasi Transaksi</h2>
          </div>
          <div class="card-body">
            <dl class="row mb-0">
              <dt class="col-sm-5">Kode transaksi</dt>
              <dd class="col-sm-7"><?= $e($p['kode_sewa'] ?? '-') ?></dd>
              <dt class="col-sm-5">Status transaksi</dt>
              <dd class="col-sm-7"><span class="badge bg-secondary"><?= $e($p['status_sewa'] ?? '-') ?></span></dd>
              <dt class="col-sm-5">Tanggal mulai</dt>
              <dd class="col-sm-7"><?= $e($p['tgl_mulai'] ?? '-') ?></dd>
              <dt class="col-sm-5">Tanggal selesai</dt>
              <dd class="col-sm-7"><?= $e($p['tgl_selesai'] ?? '-') ?></dd>
              <dt class="col-sm-5">Waktu pengambilan</dt>
              <dd class="col-sm-7"><?= $e(substr((string) ($p['wkt_ambil'] ?? '-'), 0, 5)) ?> WIB</dd>
            </dl>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-light">
            <h2 class="h5 mb-0">Informasi Pembayaran</h2>
          </div>
          <div class="card-body">
            <dl class="row mb-0">
              <dt class="col-sm-5">Kode pembayaran</dt>
              <dd class="col-sm-7"><?= $e($p['kode_bayar'] ?? '-') ?></dd>
              <dt class="col-sm-5">Jenis</dt>
              <dd class="col-sm-7"><?= $e(strtoupper((string) ($p['jns_byr'] ?? '-'))) ?></dd>
              <dt class="col-sm-5">Metode</dt>
              <dd class="col-sm-7"><?= $e(ucfirst((string) ($p['mtode_byr'] ?? '-'))) ?></dd>
              <dt class="col-sm-5">Status</dt>
              <dd class="col-sm-7"><span class="badge <?= $e($kelasStatus) ?>"><?= $e($teksStatus) ?></span></dd>
              <dt class="col-sm-5">Waktu pencatatan/unggah</dt>
              <dd class="col-sm-7"><?= $e($p['tgl_wkt_byr'] ?? '-') ?></dd>
              <dt class="col-sm-5">Waktu verifikasi</dt>
              <dd class="col-sm-7"><?= $e($p['tgl_wkt_ver'] ?? '-') ?></dd>
            </dl>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive mb-4">
      <table class="table table-bordered table-hover align-middle bg-white">
        <thead class="table-light">
          <tr>
            <th scope="col">Kendaraan</th>
            <th scope="col">Nomor Polisi</th>
            <th scope="col" class="text-end">Harga per Hari</th>
            <th scope="col" class="text-center">Durasi</th>
            <th scope="col" class="text-end">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($detail as $item): ?>
            <?php
            $harga = (int) ($item['hrg_sewa'] ?? 0);
            $hari = (int) ($item['n_hari'] ?? 0);
            ?>
            <tr>
              <td><?= $e($item['nm_mobil'] ?? '-') ?></td>
              <td><?= $e($item['no_plat'] ?? '-') ?></td>
              <td class="text-end text-nowrap"><?= $e($formatRupiah($harga)) ?></td>
              <td class="text-center"><?= $e($hari) ?> hari</td>
              <td class="text-end text-nowrap"><?= $e($formatRupiah($harga * $hari)) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="row justify-content-end mb-4">
      <div class="col-lg-6 col-xl-5">
        <div class="card border-success">
          <div class="card-body">
            <div class="d-flex justify-content-between gap-3 mb-2">
              <span>Total sewa</span>
              <strong class="text-nowrap"><?= $e($formatRupiah($p['total'] ?? 0)) ?></strong>
            </div>
            <div class="d-flex justify-content-between gap-3 mb-2">
              <span>Nominal DP yang harus ditransfer</span>
              <strong class="text-nowrap text-success"><?= $e($formatRupiah($p['nominal'] ?? 0)) ?></strong>
            </div>
            <hr>
            <div class="d-flex justify-content-between gap-3">
              <span>Sisa setelah DP</span>
              <strong class="text-nowrap"><?= $e($formatRupiah($p['sisa'] ?? 0)) ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="alert alert-info" role="status">
      Lakukan transfer sesuai nominal DP di atas. Formulir unggah bukti transfer akan tersedia pada tahap berikutnya.
    </div>

    <a class="btn btn-outline-secondary" href="<?= $e(site_url('pembayaran')) ?>">
      <i class="fas fa-arrow-left me-1" aria-hidden="true"></i> Kembali ke Daftar Pembayaran
    </a>
  </div>
</section>

<?php require APPPATH . 'views/katalog/footer.php'; ?>