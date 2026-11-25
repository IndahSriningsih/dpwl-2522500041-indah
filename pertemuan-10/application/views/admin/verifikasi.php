
<?php
require APPPATH . '/views/templates/header.php';
require APPPATH . '/views/templates/sidebar.php';

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Verifikasi Pembayaran
            <small>Kelola pembayaran penyewa</small>
        </h1>

        <ol class="breadcrumb">
            <li>
                <a href="<?= e(site_url('admin')) ?>">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="active">Verifikasi Pembayaran</li>
        </ol>
    </section>

    <section class="content">

        <?php if (!empty($flash)): ?>
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close"
                    data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>
                <?= e($flash) ?>
            </div>
        <?php endif; ?>

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">
                    Daftar Pembayaran Menunggu Verifikasi
                </h3>
            </div>

            <div class="box-body table-responsive">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Bayar</th>
                            <th>Nama Penyewa</th>
                            <th>Kode Sewa</th>
                            <th>Nominal</th>
                            <th>Tanggal Bayar</th>
                            <th>Bukti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (empty($daftarVerifikasi)): ?>
                        <tr>
                            <td colspan="8" class="text-center">
                                Belum ada pembayaran yang menunggu verifikasi.
                            </td>
                        </tr>
                    <?php else: ?>

                        <?php $no = 1; ?>

                        <?php foreach ($daftarVerifikasi as $row): ?>
                            <?php
                            $kodeUrl = str_replace(
                                '/',
                                '~',
                                $row['kode_bayar']
                            );
                            ?>

                            <tr>
                                <td><?= $no++ ?></td>

                                <td><?= e($row['kode_bayar']) ?></td>

                                <td><?= e($row['nm_lngkp']) ?></td>

                                <td><?= e($row['kode_sewa']) ?></td>

                                <td>
                                    Rp <?= number_format(
                                        (float) $row['nominal'],
                                        0,
                                        ',',
                                        '.'
                                    ) ?>
                                </td>

                                <td><?= e($row['tgl_wkt_byr']) ?></td>

                                <td>
                                    <?php if (!empty($row['ft_byr'])): ?>
                                        <span class="label label-success">
                                            Sudah diunggah
                                        </span>
                                    <?php else: ?>
                                        <span class="label label-warning">
                                            Belum diunggah
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <a
                                        href="<?= e(site_url(
                                            'admin/verifikasi/detail/' . $kodeUrl
                                        )) ?>"
                                        class="btn btn-primary btn-sm">

                                        <i class="fa fa-eye"></i>
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

    </section>
</div>

<?php
require APPPATH . '/views/templates/footer.php';
?>
