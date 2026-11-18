
<?php
require APPPATH . '/views/templates/header.php';
require APPPATH . '/views/templates/sidebar.php';

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$kodeUrl = str_replace('/', '~', $pembayaran['kode_bayar']);

$buktiAda = !empty($buktiAda);

$nominal = number_format(
    (float) $pembayaran['nominal'],
    0,
    ',',
    '.'
);

$bolehVerifikasi =
    $buktiAda &&
    ($pembayaran['sttus_byr'] ?? '') === 'pending' &&
    ($pembayaran['status_sewa'] ?? '') === 'diajukan';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Content Header -->
    <section class="content-header">
        <h1>
            Detail Verifikasi Pembayaran
            <small>Periksa bukti pembayaran penyewa</small>
        </h1>

        <ol class="breadcrumb">
            <li>
                <a href="<?= e(site_url('admin')) ?>">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="<?= e(site_url('admin/verifikasi')) ?>">
                    Verifikasi Pembayaran
                </a>
            </li>

            <li class="active">Detail Pembayaran</li>
        </ol>
    </section>

    <!-- Main Content -->
    <section class="content">

        <div class="row">

            <div class="col-md-8">

                <!-- Informasi Pembayaran -->
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-money"></i>
                            Informasi Pembayaran
                        </h3>
                    </div>

                    <div class="box-body table-responsive">

                        <table class="table table-bordered table-striped">

                            <tr>
                                <th width="35%">Kode Pembayaran</th>
                                <td><?= e($pembayaran['kode_bayar']) ?></td>
                            </tr>

                            <tr>
                                <th>Kode Sewa</th>
                                <td><?= e($pembayaran['kode_sewa']) ?></td>
                            </tr>

                            <tr>
                                <th>Nama Penyewa</th>
                                <td><?= e($pembayaran['nm_lngkp']) ?></td>
                            </tr>

                            <tr>
                                <th>Nomor HP</th>
                                <td><?= e($pembayaran['no_hp']) ?></td>
                            </tr>

                            <tr>
                                <th>Nominal Pembayaran</th>
                                <td>
                                    <strong>
                                        Rp <?= $nominal ?>
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <th>Metode Pembayaran</th>
                                <td><?= e($pembayaran['mtode_byr']) ?></td>
                            </tr>

                            <tr>
                                <th>Jenis Pembayaran</th>
                                <td><?= e($pembayaran['jns_byr']) ?></td>
                            </tr>

                            <tr>
                                <th>Tanggal Pembayaran</th>
                                <td><?= e($pembayaran['tgl_wkt_byr']) ?></td>
                            </tr>

                            <tr>
                                <th>Status Pembayaran</th>
                                <td>
                                    <?php if ($pembayaran['sttus_byr'] === 'pending'): ?>
                                        <span class="label label-warning">Pending</span>
                                    <?php elseif ($pembayaran['sttus_byr'] === 'valid'): ?>
                                        <span class="label label-success">Valid</span>
                                    <?php else: ?>
                                        <span class="label label-danger">Invalid</span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>Status Sewa</th>
                                <td><?= e($pembayaran['status_sewa']) ?></td>
                            </tr>

                        </table>

                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <!-- Bukti Pembayaran -->
                <div class="box box-info">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-image"></i>
                            Bukti Pembayaran
                        </h3>
                    </div>

                    <div class="box-body text-center">

                        <?php if ($buktiAda): ?>

                            <img
                                src="<?= e(base_url(
                                    'uploads/bayar/' .
                                    rawurlencode(basename($pembayaran['ft_byr']))
                                )) ?>"
                                alt="Bukti Pembayaran"
                                class="img-responsive img-thumbnail"
                                style="max-height: 400px; margin: 0 auto;"
                            >

                        <?php else: ?>

                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i>
                                Bukti pembayaran belum tersedia.
                            </div>

                        <?php endif; ?>

                    </div>
                </div>

                <!-- Aksi Verifikasi -->
                <div class="box box-success">

                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Tindakan Verifikasi
                        </h3>
                    </div>

                    <div class="box-body">

                        <?php if ($bolehVerifikasi): ?>

                            <form
                                action="<?= e(site_url(
                                    'admin/verifikasi/terima/' . $kodeUrl
                                )) ?>"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menerima pembayaran ini?');"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-success btn-block"
                                >
                                    <i class="fa fa-check"></i>
                                    Terima Pembayaran
                                </button>
                            </form>

                            <br>

                            <form
                                action="<?= e(site_url(
                                    'admin/verifikasi/tolak/' . $kodeUrl
                                )) ?>"
                                method="POST"
                                onsubmit="return confirm('Apakah kamu yakin ingin menolak pembayaran ini?');"
                            >
                                <button
                                    type="submit"
                                    class="btn btn-danger btn-block"
                                >
                                    <i class="fa fa-times"></i>
                                    Tolak Pembayaran
                                </button>
                            </form>

                        <?php else: ?>

                            <div class="alert alert-warning">
                                Pembayaran ini belum dapat diverifikasi.
                                Periksa bukti dan status transaksi.
                            </div>

                        <?php endif; ?>

                        <hr>

                        <a
                            href="<?= e(site_url('admin/verifikasi')) ?>"
                            class="btn btn-default btn-block"
                        >
                            <i class="fa fa-arrow-left"></i>
                            Kembali ke Daftar Verifikasi
                        </a>

                    </div>
                </div>

            </div>

        </div>

    </section>
</div>

<?php
require APPPATH . '/views/templates/footer.php';
?>
