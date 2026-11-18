
<?php

require_once APPPATH . 'models/Pembayaran_model.php';
require_once APPPATH . 'models/Transaksi_model.php';

class Pembayaran_controller extends Controller
{
    private Pembayaran_model $pembayaranModel;
    private Transaksi_model $transaksiModel;

    public function __construct()
    {
        $this->pembayaranModel = new Pembayaran_model();
        $this->transaksiModel = new Transaksi_model();
    }

    // Memastikan penyewa sudah login
    private function wajibLoginPenyewa(): string
    {
        $userPlg = trim(
            (string) ($_SESSION['penyewa_user_plg'] ?? '')
        );

        if ($userPlg === '') {
            header('Location: ' . site_url('auth/login-penyewa'));
            exit;
        }

        return $userPlg;
    }

    // Halaman daftar pembayaran
    public function index(): void
    {
        $userPlg = $this->wajibLoginPenyewa();

        $daftarPembayaran = $this->pembayaranModel
            ->getDaftarPembayaranPenyewa($userPlg);

        $jumlahKeranjang = $this->transaksiModel
            ->getJumlahMobilKeranjang($userPlg);

        $flash = $_SESSION['flash_pembayaran'] ?? null;
        unset($_SESSION['flash_pembayaran']);

        $this->view('penyewa/pembayaran', [
            'daftarPembayaran' => $daftarPembayaran,
            'jumlahKeranjang' => $jumlahKeranjang,
            'flash' => $flash
        ]);
    }

    // Halaman detail pembayaran
    public function detail(string $kodeBayar = ''): void
    {
        $userPlg = $this->wajibLoginPenyewa();

        $kodeBayar = str_replace('~', '/', trim($kodeBayar));

        if ($kodeBayar === '') {
            http_response_code(400);
            exit('Kode pembayaran tidak tersedia.');
        }

        $pembayaran = $this->pembayaranModel
            ->getPembayaranPenyewa($kodeBayar, $userPlg);

        if ($pembayaran === null) {
            http_response_code(404);
            exit('Pembayaran tidak ditemukan.');
        }

        $daftarKendaraan = $this->pembayaranModel
            ->getDaftarKendaraanSewa($pembayaran['kode_sewa']);

        $jumlahKeranjang = $this->transaksiModel
            ->getJumlahMobilKeranjang($userPlg);

        $flash = $_SESSION['flash_pembayaran'] ?? null;
        unset($_SESSION['flash_pembayaran']);

        $this->view('penyewa/pembayaran_detail', [
            'pembayaran' => $pembayaran,
            'daftarKendaraan' => $daftarKendaraan,
            'jumlahKeranjang' => $jumlahKeranjang,
            'flash' => $flash
        ]);
    }

    // Proses upload bukti pembayaran
    public function upload(string $kodeBayar = ''): void
    {
        $userPlg = $this->wajibLoginPenyewa();

        $kodeBayar = str_replace('~', '/', trim($kodeBayar));

        $urlDetail = 'pembayaran/detail/' .
            str_replace('/', '~', $kodeBayar);

        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            http_response_code(405);
            exit('Method Not Allowed');
        }

        if ($kodeBayar === '') {
            http_response_code(400);
            exit('Kode pembayaran tidak tersedia.');
        }

        // Ambil data pembayaran milik penyewa
        $pembayaran = $this->pembayaranModel
            ->getPembayaranPenyewa($kodeBayar, $userPlg);

        if (!$pembayaran) {
            http_response_code(404);
            exit('Pembayaran tidak ditemukan.');
        }

        // Bukti hanya dapat diunggah saat status pending
        if (($pembayaran['sttus_byr'] ?? '') !== 'pending') {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Bukti pembayaran hanya dapat diunggah saat status masih pending.'
            );
        }

        // Periksa file
        if (
            !isset($_FILES['bukti_pembayaran']) ||
            $_FILES['bukti_pembayaran']['error'] !== UPLOAD_ERR_OK
        ) {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Silakan pilih bukti pembayaran terlebih dahulu.'
            );
        }

        $file = $_FILES['bukti_pembayaran'];
        $tmpName = $file['tmp_name'];
        $ukuran = (int) $file['size'];

        // Maksimal ukuran 3 MB
        if (
            !is_uploaded_file($tmpName) ||
            $ukuran < 1 ||
            $ukuran > 3 * 1024 * 1024
        ) {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Ukuran file maksimal 3 MB.'
            );
        }

        // Validasi format gambar
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($tmpName);

        $formatDiizinkan = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png'
        ];

        if (
            !isset($formatDiizinkan[$mime]) ||
            getimagesize($tmpName) === false
        ) {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Format bukti pembayaran harus JPG, JPEG, atau PNG.'
            );
        }

        // Folder penyimpanan
        $folderUpload = dirname(APPPATH)
            . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR . 'bayar'
            . DIRECTORY_SEPARATOR;

        if (!is_dir($folderUpload)) {
            mkdir($folderUpload, 0755, true);
        }

        if (!is_dir($folderUpload) || !is_writable($folderUpload)) {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Folder uploads/bayar tidak dapat ditulis.'
            );
        }

        // Buat nama file acak
        $namaFile = 'bukti_' . date('YmdHis') . '_'
            . bin2hex(random_bytes(8)) . '.'
            . $formatDiizinkan[$mime];

        $lokasiFile = $folderUpload . $namaFile;
        $pathDatabase = 'uploads/bayar/' . $namaFile;

        if (!move_uploaded_file($tmpName, $lokasiFile)) {
            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Gagal menyimpan file bukti pembayaran.'
            );
        }

        // Simpan lokasi file ke database
        try {
            $berhasil = $this->pembayaranModel
                ->uploadBuktiPembayaran(
                    $kodeBayar,
                    $userPlg,
                    $pathDatabase
                );

            if (!$berhasil) {
                if (is_file($lokasiFile)) {
                    unlink($lokasiFile);
                }

                $this->redirectDenganPesan(
                    $urlDetail,
                    'error',
                    'Bukti pembayaran gagal disimpan ke database.'
                );
            }

            $this->redirectDenganPesan(
                $urlDetail,
                'success',
                'Bukti pembayaran berhasil diunggah dan menunggu verifikasi admin.'
            );

        } catch (Throwable $e) {
            error_log(
                'Upload bukti pembayaran: ' . $e->getMessage()
            );

            if (is_file($lokasiFile)) {
                unlink($lokasiFile);
            }

            $this->redirectDenganPesan(
                $urlDetail,
                'error',
                'Terjadi kesalahan saat menyimpan bukti pembayaran.'
            );
        }
    }

    // Menampilkan pesan dan mengarahkan halaman
    private function redirectDenganPesan(
        string $uri,
        string $jenis,
        string $pesan
    ): void {
        $_SESSION['flash_pembayaran'] = [
            'type' => $jenis,
            'message' => $pesan
        ];

        header('Location: ' . site_url($uri));
        exit;
    }
}
