<?php
require_once APPPATH . 'models/Mobil_model.php';
require_once APPPATH . 'models/Transaksi_model.php';

class Katalog_controller extends Controller
{
    private Mobil_model $mobilModel;
    private Transaksi_model $transaksiModel;

    public function __construct()
    {
        $this->mobilModel = new Mobil_model();
        $this->transaksiModel = new Transaksi_model(); // Inisialisasi wajib di dalam __construct
    }

    public function index(): void
    {
        $userPlg = trim((string) ($_SESSION['penyewa_user_plg'] ?? ''));

        $data = [
            'daftarMobil'     => $this->mobilModel->getKatalog(),
            'jumlahKeranjang' => $userPlg === ''
                ? 0
                : $this->transaksiModel->getJumlahMobilKeranjang($userPlg)
        ];

        $this->view('katalog/index', $data);
    }

    public function detail(string $noPlat = ''): void
    {
        $noPlat = trim(rawurldecode($noPlat));

        if ($noPlat === '') {
            http_response_code(404);
            exit('Kendaraan tidak ditemukan.');
        }

       $mobil = $this->mobilModel->getByNoPlat($noPlat);

        if ($mobil === null) {
            http_response_code(404);
            exit('Kendaraan tidak ditemukan.');
        }

        $userPlg = trim((string) ($_SESSION['penyewa_user_plg'] ?? ''));

        $this->view('katalog/detail', [
            'mobil'           => $mobil,
            'jumlahKeranjang' => $userPlg === ''
                ? 0
                : $this->transaksiModel->getJumlahMobilKeranjang($userPlg)
        ]);
    }
}