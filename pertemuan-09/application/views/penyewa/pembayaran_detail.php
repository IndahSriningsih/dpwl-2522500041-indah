<?php
require APPPATH . 'views/katalog/header.php';
require APPPATH . 'views/katalog/navbar.php';

$pembayaran = $pembayaran ?? [];
$daftarKendaraan = $daftarKendaraan ?? [];

$e = static function ($value) {
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
};
?>

<div class="container py-5">

    <h2 class="mb-4">Detail Pembayaran DP</h2>

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">
            Informasi Pembayaran
        </div>

        <div class="card-body">

            <table class="table">

                <tr>
                    <th>Kode Pembayaran</th>
                    <td><?= $e($pembayaran['kode_bayar']) ?></td>
                </tr>

                <tr>
                    <th>Kode Sewa</th>
                    <td><?= $e($pembayaran['kode_sewa']) ?></td>
                </tr>

                <tr>
                    <th>Tanggal Mulai</th>
                    <td><?= $e($pembayaran['tgl_mulai']) ?></td>
                </tr>

                <tr>
                    <th>Tanggal Selesai</th>
                    <td><?= $e($pembayaran['tgl_selesai']) ?></td>
                </tr>

                <tr>
                    <th>Waktu Pengambilan</th>
                    <td><?= $e($pembayaran['wkt_ambil'] ?? '-') ?></td>
                </tr>

                <tr>
                    <th>Nominal DP</th>
                    <td>
                        Rp <?= number_format(
                            (int) $pembayaran['nominal'],
                            0,
                            ',',
                            '.'
                        ) ?>
                    </td>
                </tr>

                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?= $e($pembayaran['mtode_byr']) ?></td>
                </tr>

                <tr>
                    <th>Status Pembayaran</th>
                    <td><?= $e($pembayaran['sttus_byr']) ?></td>
                </tr>

                <tr>
                    <th>Status Transaksi</th>
                    <td><?= $e($pembayaran['status_sewa']) ?></td>
                </tr>

            </table>

        </div>
    </div>

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">
            Kendaraan yang Disewa
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor Polisi</th>
                        <th>Nama Kendaraan</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (empty($daftarKendaraan)): ?>

                    <tr>
                        <td colspan="3" class="text-center">
                            Kendaraan tidak ditemukan.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarKendaraan as $i => $mobil): ?>

                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $e($mobil['no_plat']) ?></td>
                            <td><?= $e($mobil['nm_mobil']) ?></td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>

    <a
        href="<?= $e(site_url('pembayaran')) ?>"
        class="btn btn-secondary">

        Kembali

    </a>

</div>

<?php require APPPATH . 'views/katalog/footer.php'; ?>