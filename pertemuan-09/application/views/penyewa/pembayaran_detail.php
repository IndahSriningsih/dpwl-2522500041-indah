
<?php
require APPPATH . 'views/katalog/header.php';
require APPPATH . 'views/katalog/navbar.php';

$pembayaran = $pembayaran ?? [];
$daftarKendaraan = $daftarKendaraan ?? [];
$flash = $flash ?? null;

$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$status = (string) ($pembayaran['sttus_byr'] ?? '');
$namaBukti = trim((string) ($pembayaran['ft_byr'] ?? ''));

$bolehUnggah = (
    $status === 'pending' &&
    empty($pembayaran['tgl_wkt_ver']) &&
    ($pembayaran['mtode_byr'] ?? '') === 'transfer'
);
?>

<div class="container py-5">

    <h2 class="mb-4">Detail Pembayaran DP</h2>

    <?php if (is_array($flash) && !empty($flash['message'])): ?>
        <div class="alert alert-<?= $e(
            ($flash['type'] ?? '') === 'success'
                ? 'success'
                : 'danger'
        ) ?>">
            <?= $e($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- INFORMASI PEMBAYARAN -->
    <div class="card mb-4">
        <div class="card-header">
            Informasi Pembayaran
        </div>

        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Kode Pembayaran</th>
                    <td><?= $e($pembayaran['kode_bayar'] ?? '') ?></td>
                </tr>

                <tr>
                    <th>Kode Sewa</th>
                    <td><?= $e($pembayaran['kode_sewa'] ?? '') ?></td>
                </tr>

                <tr>
                    <th>Periode Sewa</th>
                    <td>
                        <?= $e($pembayaran['tgl_mulai'] ?? '') ?>
                        s.d.
                        <?= $e($pembayaran['tgl_selesai'] ?? '') ?>
                    </td>
                </tr>

                <tr>
                    <th>Nominal DP</th>
                    <td>
                        Rp <?= number_format(
                            (int) ($pembayaran['nominal'] ?? 0),
                            0,
                            ',',
                            '.'
                        ) ?>
                    </td>
                </tr>

                <tr>
                    <th>Metode Pembayaran</th>
                    <td><?= $e($pembayaran['mtode_byr'] ?? '') ?></td>
                </tr>

                <tr>
                    <th>Status Pembayaran</th>
                    <td><?= $e($status) ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- DAFTAR KENDARAAN -->
    <div class="card mb-4">
        <div class="card-header">
            Kendaraan yang Disewa
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Polisi</th>
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
                                <td><?= $e($mobil['no_plat'] ?? '') ?></td>
                                <td><?= $e($mobil['nm_mobil'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- TAMPILAN BUKTI PEMBAYARAN -->
    <?php if ($namaBukti !== ''): ?>

        <div class="card mb-4">
            <div class="card-header">
                Bukti Pembayaran
            </div>

            <div class="card-body">
                <img
                    src="<?= $e(base_url(
                        'uploads/bayar/' . rawurlencode($namaBukti)
                    )) ?>"
                    alt="Bukti pembayaran"
                    class="img-fluid img-thumbnail"
                    style="max-width: 520px;">
            </div>
        </div>

    <?php else: ?>

        <div class="alert alert-warning">
            Bukti pembayaran belum diunggah.
        </div>

    <?php endif; ?>

    <!-- FORM UPLOAD BUKTI PEMBAYARAN -->
    <?php if ($bolehUnggah): ?>

        <div class="card mb-4">
            <div class="card-header">
                Upload Bukti Pembayaran
            </div>

            <div class="card-body">

                <p class="text-muted">
                    Format JPG, JPEG, atau PNG. Maksimal 3 MB.
                </p>

                <form
                    action="<?= $e(site_url(
                        'pembayaran/upload/' .
                        str_replace(
                            '/',
                            '~',
                            $pembayaran['kode_bayar'] ?? ''
                        )
                    )) ?>"
                    method="POST"
                    enctype="multipart/form-data">

                    <div class="mb-3">
                        <label
                            for="bukti_pembayaran"
                            class="form-label">
                            Pilih Bukti Pembayaran
                        </label>

                        <input
                            type="file"
                            name="bukti_pembayaran"
                            id="bukti_pembayaran"
                            class="form-control"
                            accept=".jpg,.jpeg,.png"
                            required>
                    </div>

                    <button
                        type="submit"
                        class="btn btn-success">
                        Upload Bukti Pembayaran
                    </button>

                </form>

            </div>
        </div>

    <?php elseif ($status !== 'pending'): ?>

        <div class="alert alert-info">
            Pembayaran sudah diproses dan tidak dapat diubah.
        </div>

    <?php endif; ?>

    <!-- TOMBOL KEMBALI -->
    <a href="<?= $e(site_url('pembayaran')) ?>"
       class="btn btn-secondary">
        Kembali
    </a>

</div>

<?php require APPPATH . 'views/katalog/footer.php'; ?>
