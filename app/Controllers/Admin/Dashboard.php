<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\ProdukModel;
use App\Models\ArtikelModel;
use App\Models\UserModel;
use App\Models\TpsModel;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    protected $pesananModel;
    protected $produkModel;
    protected $artikelModel;
    protected $userModel;
    protected $tpsModel;
    protected $session;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->produkModel = new ProdukModel();
        $this->artikelModel = new ArtikelModel();
        $this->userModel = new UserModel();
        $this->tpsModel = new TpsModel();
        $this->session = session();
    }

    /**
     * Check if user is admin
     */
    private function checkAdmin(): ?RedirectResponse
    {
        if (!$this->session->get('logged_in') || $this->session->get('user_role') !== 'admin') {
            return redirect()->to('/auth/login')
                           ->with('error', 'Akses ditolak. Silakan login sebagai admin.');
        }
        return null;
    }

    /**
     * Admin dashboard
     */
    public function index()
    {
        if ($redirect = $this->checkAdmin()) {
            return $redirect;
        }

        $stats = [
            'pesanan' => $this->pesananModel->getStats(),
            'produk_total' => $this->produkModel->countAll(),
            'produk_aktif' => $this->produkModel->where('status', 'aktif')->countAllResults(),
            'artikel_total' => $this->artikelModel->countAll(),
            'artikel_published' => $this->artikelModel->where('status', 'published')->countAllResults(),
            'anggota' => $this->userModel->where('role', 'anggota')->countAllResults(),
            'tps_aktif' => $this->tpsModel->where('status', 'aktif')->countAllResults(),
        ];

        $data = [
            'title' => 'Dashboard Admin - Lestari Pekalongan',
            'stats' => $stats,
            'pesanan_terbaru' => $this->pesananModel->getAllWithUser(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/dashboard/index', $data)
             . view('admin/templates/footer');
    }
}
