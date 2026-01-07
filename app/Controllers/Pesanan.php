<?php

namespace App\Controllers;

use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Pesanan extends BaseController
{
    protected $pesananModel;
    protected $detailPesananModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->userModel = new UserModel();
        $this->session = session();
    }

    /**
     * Check if user is logged in
     */
    private function checkLogin(): ?RedirectResponse
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/auth/login')
                           ->with('error', 'Silakan login terlebih dahulu.');
        }
        return null;
    }

    /**
     * List user orders
     */
    public function index()
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $pesanan = $this->pesananModel->getByUser($userId);

        $data = [
            'title' => 'Riwayat Pesanan - Lestari Pekalongan',
            'pesanan' => $pesanan,
        ];
        
        return view('templates/header', $data)
             . view('pesanan/index', $data)
             . view('templates/footer');
    }

    /**
     * View order detail
     */
    public function detail(string $kode)
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $pesanan = $this->pesananModel->getByKode($kode);

        if (!$pesanan || $pesanan['user_id'] != $userId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $details = $this->detailPesananModel->getByPesanan($pesanan['id']);

        $data = [
            'title' => 'Detail Pesanan ' . $kode . ' - Lestari Pekalongan',
            'pesanan' => $pesanan,
            'details' => $details,
        ];
        
        return view('templates/header', $data)
             . view('pesanan/detail', $data)
             . view('templates/footer');
    }

    /**
     * Cancel order (only for pending orders)
     */
    public function batal(string $kode): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $pesanan = $this->pesananModel->getByKode($kode);

        if (!$pesanan || $pesanan['user_id'] != $userId) {
            return redirect()->to('/pesanan')
                           ->with('error', 'Pesanan tidak ditemukan.');
        }

        if ($pesanan['status'] !== 'pending') {
            return redirect()->to('/pesanan')
                           ->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $this->pesananModel->updateStatus($pesanan['id'], 'dibatalkan');

        // TODO: Restore product stock

        return redirect()->to('/pesanan')
                       ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
