
<?php

class Pembayaran_model
{
    private mysqli $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    // Menampilkan daftar pembayaran DP milik penyewa
    public function getDaftarPembayaranPenyewa(string $userPlg): array
    {
        $sql = "SELECT
                    b.kode_bayar,
                    b.tgl_wkt_byr,
                    b.ft_byr,
                    b.mtode_byr,
                    b.jns_byr,
                    b.nominal,
                    b.sttus_byr,
                    b.kode_sewa,
                    s.tgl_mulai,
                    s.tgl_selesai,
                    s.status_sewa
                FROM t_bayar b
                INNER JOIN t_sewa s
                    ON s.kode_sewa = b.kode_sewa
                WHERE s.user_plg = ?
                  AND b.jns_byr = 'dp'
                ORDER BY b.tgl_wkt_byr DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $userPlg);
        $stmt->execute();

        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $hasil;
    }

    // Menampilkan detail pembayaran
    public function getPembayaranPenyewa(
        string $kodeBayar,
        string $userPlg
    ): ?array {

        $sql = "SELECT
                    b.kode_bayar,
                    b.ft_byr,
                    b.mtode_byr,
                    b.jns_byr,
                    b.nominal,
                    b.sttus_byr,
                    b.tgl_wkt_byr,
                    b.tgl_wkt_ver,
                    b.kode_sewa,
                    s.tgl_mulai,
                    s.tgl_selesai,
                    s.status_sewa
                FROM t_bayar b
                INNER JOIN t_sewa s
                    ON s.kode_sewa = b.kode_sewa
                WHERE b.kode_bayar = ?
                  AND s.user_plg = ?
                  AND b.jns_byr = 'dp'
                LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ss", $kodeBayar, $userPlg);
        $stmt->execute();

        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $hasil ?: null;
    }

    // Menampilkan kendaraan dalam transaksi sewa
    public function getDaftarKendaraanSewa(string $kodeSewa): array
    {
        $sql = "SELECT
                    m.no_plat,
                    m.nm_mobil
                FROM t_pilih p
                INNER JOIN t_mobil m
                    ON m.no_plat = p.no_plat
                WHERE p.kode_sewa = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $kodeSewa);
        $stmt->execute();

        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $hasil;
    }

    // Upload dan menyimpan bukti pembayaran penyewa
    public function uploadBuktiPembayaran(
        string $kodeBayar,
        string $userPlg,
        string $namaFile
    ): bool {

        $sql = "UPDATE t_bayar b
                INNER JOIN t_sewa s
                    ON s.kode_sewa = b.kode_sewa
                SET b.ft_byr = ?
                WHERE b.kode_bayar = ?
                  AND s.user_plg = ?
                  AND b.jns_byr = 'dp'
                  AND b.sttus_byr = 'pending'";

        $stmt = $this->db->prepare($sql);

        $stmt->bind_param(
            "sss",
            $namaFile,
            $kodeBayar,
            $userPlg
        );

        $berhasil = $stmt->execute()
            && $stmt->affected_rows > 0;

        $stmt->close();

        return $berhasil;
    }
}
