
<?php

class Verifikasi_model
{
    // Mengambil semua pembayaran yang masih menunggu verifikasi
    public function getDaftarVerifikasi(): array
    {
        global $db;

        $sql = "
            SELECT
                b.kode_bayar,
                b.tgl_wkt_byr,
                b.ft_byr,
                b.mtode_byr,
                b.jns_byr,
                b.nominal,
                b.sttus_byr,
                b.kode_sewa,
                s.status_sewa,
                s.user_plg,
                p.nm_lngkp
            FROM t_bayar b
            INNER JOIN t_sewa s
                ON s.kode_sewa = b.kode_sewa
            INNER JOIN t_penyewa p
                ON p.user_plg = s.user_plg
            WHERE b.sttus_byr = 'pending'
            ORDER BY b.tgl_wkt_byr DESC
        ";

        $result = $db->query($sql);

        if (!$result) {
            throw new RuntimeException(
                'Gagal mengambil daftar verifikasi.'
            );
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Mengambil detail pembayaran berdasarkan kode bayar
    public function getDetailVerifikasi(string $kodeBayar): ?array
    {
        global $db;

        $sql = "
            SELECT
                b.kode_bayar,
                b.tgl_wkt_byr,
                b.ft_byr,
                b.mtode_byr,
                b.jns_byr,
                b.nominal,
                b.sttus_byr,
                b.tgl_wkt_ver,
                b.kode_sewa,
                s.tgl_mulai,
                s.tgl_selesai,
                s.status_sewa,
                s.user_plg,
                p.nm_lngkp,
                p.no_hp
            FROM t_bayar b
            INNER JOIN t_sewa s
                ON s.kode_sewa = b.kode_sewa
            INNER JOIN t_penyewa p
                ON p.user_plg = s.user_plg
            WHERE b.kode_bayar = ?
            LIMIT 1
        ";

        $stmt = $db->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException(
                'Gagal menyiapkan query detail pembayaran.'
            );
        }

        $stmt->bind_param('s', $kodeBayar);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data ?: null;
    }

    // Menerima atau menolak pembayaran secara bersamaan
    public function prosesVerifikasi(
        string $kodeBayar,
        string $keputusan
    ): bool {
        global $db;

        if (!in_array($keputusan, ['valid', 'invalid'], true)) {
            return false;
        }

        $statusSewa = ($keputusan === 'valid')
            ? 'disetujui'
            : 'ditolak';

        try {
            $db->begin_transaction();

            // Kunci data pembayaran agar tidak diproses bersamaan
            $sql = "
                SELECT
                    kode_sewa,
                    ft_byr,
                    sttus_byr
                FROM t_bayar
                WHERE kode_bayar = ?
                FOR UPDATE
            ";

            $stmt = $db->prepare($sql);
            if (!$stmt) {
                throw new RuntimeException('Query pembayaran gagal.');
            }

            $stmt->bind_param('s', $kodeBayar);
            $stmt->execute();

            $pembayaran = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // Pembayaran harus ada, masih pending, dan memiliki bukti
            if (
                !$pembayaran ||
                $pembayaran['sttus_byr'] !== 'pending' ||
                empty($pembayaran['ft_byr'])
            ) {
                $db->rollback();
                return false;
            }

            $kodeSewa = $pembayaran['kode_sewa'];

            // Update status pembayaran
            $sqlBayar = "
                UPDATE t_bayar
                SET
                    sttus_byr = ?,
                    tgl_wkt_ver = NOW()
                WHERE kode_bayar = ?
                  AND sttus_byr = 'pending'
                  AND ft_byr IS NOT NULL
                  AND ft_byr <> ''
            ";

            $stmtBayar = $db->prepare($sqlBayar);
            if (!$stmtBayar) {
                throw new RuntimeException('Update pembayaran gagal.');
            }

            $stmtBayar->bind_param(
                'ss',
                $keputusan,
                $kodeBayar
            );

            $stmtBayar->execute();
            $jumlahBayar = $stmtBayar->affected_rows;
            $stmtBayar->close();

            if ($jumlahBayar !== 1) {
                throw new RuntimeException(
                    'Pembayaran sudah diproses atau tidak valid.'
                );
            }

            // Update status transaksi sewa
            $sqlSewa = "
                UPDATE t_sewa
                SET status_sewa = ?
                WHERE kode_sewa = ?
                  AND status_sewa = 'diajukan'
            ";

            $stmtSewa = $db->prepare($sqlSewa);
            if (!$stmtSewa) {
                throw new RuntimeException('Update transaksi gagal.');
            }

            $stmtSewa->bind_param(
                'ss',
                $statusSewa,
                $kodeSewa
            );

            $stmtSewa->execute();
            $jumlahSewa = $stmtSewa->affected_rows;
            $stmtSewa->close();

            if ($jumlahSewa !== 1) {
                throw new RuntimeException(
                    'Status transaksi tidak sesuai.'
                );
            }

            // Simpan kedua perubahan sekaligus
            $db->commit();

            return true;

        } catch (Throwable $e) {
            $db->rollback();

            error_log(
                'Verifikasi pembayaran gagal: ' . $e->getMessage()
            );

            return false;
        }
    }
}
