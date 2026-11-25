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

        $daftarPembayaran =
            $this->pembayaranModel
            ->getDaftarPembayaranPenyewa($userPlg);

        $jumlahKeranjang =
            $this->transaksiModel
            ->getJumlahMobilKeranjang($userPlg);

        $this->view('penyewa/pembayaran', [
            'daftarPembayaran' => $daftarPembayaran,
            'jumlahKeranjang' => $jumlahKeranjang
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

        $pembayaran =
            $this->pembayaranModel
            ->getPembayaranPenyewa($kodeBayar, $userPlg);

        if ($pembayaran === null) {
            http_response_code(404);
            exit('Pembayaran tidak ditemukan.');
        }

        $daftarKendaraan =
            $this->pembayaranModel
            ->getDaftarKendaraanSewa($pembayaran['kode_sewa']);

        $jumlahKeranjang =
            $this->transaksiModel
            ->getJumlahMobilKeranjang($userPlg);

        $this->view('penyewa/pembayaran_detail', [
            'pembayaran' => $pembayaran,
            'daftarKendaraan' => $daftarKendaraan,
            'jumlahKeranjang' => $jumlahKeranjang
        ]);
    }
}