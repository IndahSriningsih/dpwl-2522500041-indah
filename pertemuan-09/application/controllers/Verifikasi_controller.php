
<?php

require_once APPPATH . 'models/Verifikasi_model.php';

class Verifikasi_controller extends Controller
{
    private Verifikasi_model $verifikasiModel;

    public function __construct()
    {
        $this->verifikasiModel = new Verifikasi_model();
    }

    // Memastikan hanya admin aktif yang dapat mengakses
    private function wajibLoginAdmin(): void
    {
        if (
            empty($_SESSION['admin_username']) ||
            ($_SESSION['admin_status'] ?? '') !== 'aktif'
        ) {
            header('Location: ' . site_url('auth/login'));
            exit;
        }
    }

    // Memeriksa lokasi file bukti pembayaran
    private function pathBukti(string $namaFile): string
    {
        return dirname(APPPATH)
            . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR . 'bayar'
            . DIRECTORY_SEPARATOR . basename($namaFile);
    }

    // Halaman daftar pembayaran
    public function index(): void
    {
        $this->wajibLoginAdmin();

        try {
            $daftar = $this->verifikasiModel
                ->getDaftarVerifikasi();

            $flash = $_SESSION['flash_verifikasi'] ?? null;
            unset($_SESSION['flash_verifikasi']);

            $this->view('admin/verifikasi', [
                'daftarVerifikasi' => $daftar,
                'flash' => $flash,
                'username' => $_SESSION['admin_username'] ?? ''
            ]);

        } catch (Throwable $e) {
            error_log($e->getMessage());

            http_response_code(500);
            exit('Daftar verifikasi belum dapat ditampilkan.');
        }
    }

    // Halaman detail pembayaran
    public function detail(?string $kodeBayar = null): void
    {
        $this->wajibLoginAdmin();

        if (!$kodeBayar) {
            header('Location: ' . site_url('admin/verifikasi'));
            exit;
        }

        $kodeBayar = str_replace('~', '/', $kodeBayar);

        try {
            $pembayaran = $this->verifikasiModel
                ->getDetailVerifikasi($kodeBayar);

            if (!$pembayaran) {
                http_response_code(404);
                exit('Data pembayaran tidak ditemukan.');
            }

            // Memastikan file bukti benar-benar tersedia
            $buktiAda = !empty($pembayaran['ft_byr'])
                && is_file($this->pathBukti($pembayaran['ft_byr']));

            $this->view('admin/verifikasi_detail', [
                'pembayaran' => $pembayaran,
                'buktiAda' => $buktiAda,
                'username' => $_SESSION['admin_username'] ?? ''
            ]);

        } catch (Throwable $e) {
            error_log($e->getMessage());

            http_response_code(500);
            exit('Detail pembayaran belum dapat ditampilkan.');
        }
    }

    // Terima pembayaran
    public function terima(?string $kodeBayar = null): void
    {
        $this->wajibLoginAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Method Not Allowed');
        }

        $this->proses($kodeBayar, 'valid');
    }

    // Tolak pembayaran
    public function tolak(?string $kodeBayar = null): void
    {
        $this->wajibLoginAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Method Not Allowed');
        }

        $this->proses($kodeBayar, 'invalid');
    }

    // Proses keputusan admin
    private function proses(
        ?string $kodeBayar,
        string $keputusan
    ): void {
        if (!$kodeBayar) {
            $_SESSION['flash_verifikasi'] =
                'Kode pembayaran tidak ditemukan.';

        } else {
            $kodeBayar = str_replace('~', '/', $kodeBayar);

            $pembayaran = $this->verifikasiModel
                ->getDetailVerifikasi($kodeBayar);

            // Periksa apakah bukti pembayaran tersedia
            $buktiAda = $pembayaran
                && !empty($pembayaran['ft_byr'])
                && is_file($this->pathBukti($pembayaran['ft_byr']));

            if (!$buktiAda) {
                $_SESSION['flash_verifikasi'] =
                    'Verifikasi gagal. File bukti pembayaran belum tersedia.';

            } else {
                $berhasil = $this->verifikasiModel
                    ->prosesVerifikasi($kodeBayar, $keputusan);

                if ($berhasil) {
                    $_SESSION['flash_verifikasi'] =
                        ($keputusan === 'valid')
                        ? 'Pembayaran berhasil diterima.'
                        : 'Pembayaran berhasil ditolak.';

                } else {
                    $_SESSION['flash_verifikasi'] =
                        'Verifikasi gagal. Pembayaran mungkin sudah diproses atau status transaksi tidak sesuai.';
                }
            }
        }

        // Kembali ke halaman daftar verifikasi
        header('Location: ' . site_url('admin/verifikasi'));
        exit;
    }
}
