<?php
require APPPATH . 'views/katalog/header.php';
require APPPATH . 'views/katalog/navbar.php';

$daftarPembayaran = $daftarPembayaran ?? [];

$e = static function ($value) {
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
};
?>

<div class="container py-5">

    <h2 class="mb-2">Pembayaran Saya</h2>

    <p class="text-muted mb-4">
        Berikut daftar pembayaran DP transaksi sewa kendaraan Anda.
    </p>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Kode Pembayaran</th>
                            <th>Kode Sewa</th>
                            <th>Periode Sewa</th>
                            <th>Nominal DP</th>
                            <th>Status</th>
                            <th>Bukti Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if (empty($daftarPembayaran)): ?>

                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada pembayaran.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($daftarPembayaran as $i => $item): ?>

                            <tr>

                                <td><?= $i + 1 ?></td>

                                <td>
                                    <?= $e($item['kode_bayar']) ?>
                                </td>

                                <td>
                                    <?= $e($item['kode_sewa']) ?>
                                </td>

                                <td>
                                    <?= $e($item['tgl_mulai']) ?>
                                    s.d.
                                    <?= $e($item['tgl_selesai']) ?>
                                </td>

                                <td>
                                    Rp <?= number_format(
                                        (int) $item['nominal'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </td>

                                <td>
                                    <?php if ($item['sttus_byr'] === 'pending'): ?>
                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    <?php elseif ($item['sttus_byr'] === 'valid'): ?>
                                        <span class="badge bg-success">
                                            Valid
                                        </span>

                                    <?php elseif ($item['sttus_byr'] === 'invalid'): ?>
                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>

                                    <?php else: ?>
                                        <?= $e($item['sttus_byr']) ?>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= !empty($item['ft_byr'])
                                        ? 'Sudah ada'
                                        : 'Belum ada' ?>
                                </td>

                                <td>
                                    <a
                                        href="<?= $e(site_url(
                                            'pembayaran/detail/' .
                                            str_replace(
                                                '/',
                                                '~',
                                                $item['kode_bayar']
                                            )
                                        )) ?>"
                                        class="btn btn-primary btn-sm">

                                        Detail

                                    </a>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>

</div>

<?php require APPPATH . 'views/katalog/footer.php'; ?>