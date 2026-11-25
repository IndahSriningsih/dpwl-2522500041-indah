 
      $hasilWaktu = $this->db->query(
        "SELECT
          DATE_FORMAT(NOW(), '%Y%m%d') AS tanggal_kode,
          NOW() AS waktu_pembayaran"
      );

      if (!$hasilWaktu) {
        throw new RuntimeException(
          'Waktu pembayaran gagal dibaca.'
        );
      }

      $waktu = $hasilWaktu->fetch_assoc();
      $hasilWaktu->free();

      $tanggalKode = (string) ($waktu['tanggal_kode'] ?? '');
      $waktuPembayaran = (string) ($waktu['waktu_pembayaran'] ?? '');

      if (
        !preg_match('/^\\d{8}$/', $tanggalKode) ||
        $waktuPembayaran === ''
      ) {
        throw new RuntimeException(
          'Waktu pembayaran tidak valid.'
        );
      }

      $kodeBayar = $this->buatKodeBayarPelunasan($tanggalKode);

      $stmt = $this->db->prepare(
        "INSERT INTO t_bayar (
          kode_bayar,
          tgl_wkt_byr,
          ft_byr,
          mtode_byr,
          jns_byr,
          nominal,
          sttus_byr,
          tgl_wkt_ver,
          kode_sewa
        ) VALUES (?, ?, ?, ?, 'pelunasan', ?, 'valid', NOW(), ?)"
      );

      if (!$stmt) {
        throw new RuntimeException(
          'Pencatatan pelunasan gagal disiapkan.'
        );
      }

      $stmt->bind_param(
        'ssssis',
        $kodeBayar,
        $waktuPembayaran,
        $namaFileBukti,
        $metodeBayar,
        $sisaKewajiban,
        $kodeSewa
      );

      if (!$stmt->execute()) {
        $stmt->close();
        throw new RuntimeException(
          'Pelunasan gagal disimpan.'
        );
      }

      $stmt->close();

      // Perbarui status sewa menjadi lunas.
      $stmt = $this->db->prepare(
        "UPDATE t_sewa
          SET status_sewa = 'lunas'
          WHERE kode_sewa = ?
            AND status_sewa IN ('disetujui', 'lunas')"
      );

      if (!$stmt) {
        throw new RuntimeException(
          'Pembaruan status transaksi menjadi lunas gagal disiapkan.'
        );
      }

      $stmt->bind_param('s', $kodeSewa);

      if (!$stmt->execute()) {
        $stmt->close();
        throw new RuntimeException(
          'Status transaksi gagal diperbarui menjadi lunas.'
        );
      }

      if ($stmt->affected_rows !== 1) {
        $stmt->close();
        throw new RuntimeException(
          'Status transaksi tidak berubah menjadi lunas. Periksa kembali status transaksi.'
        );
      }

      $stmt->close();

      $this->db->commit();
      $transaksiDimulai = false;

      return $kodeBayar;
    } catch (Throwable $e) {
      if ($transaksiDimulai) {
        $this->db->rollback();
      }

      throw $e;
    } finally {
      if ($kunciDiperoleh) {
        $stmt = $this->db->prepare(
          'SELECT RELEASE_LOCK(?)'
        );

        if ($stmt) {
          $stmt->bind_param('s', $namaKunci);
          $stmt->execute();
          $stmt->close();
        }
      }
    }
  }

}
