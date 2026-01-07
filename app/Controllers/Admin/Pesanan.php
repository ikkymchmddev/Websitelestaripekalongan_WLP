<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use CodeIgniter\HTTP\RedirectResponse;

class Pesanan extends BaseController
{
    protected $pesananModel;
    protected $detailPesananModel;
    protected $session;

    public function __construct()
    {
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->session = session();
    }

    private function checkAdmin(): ?RedirectResponse
    {
        if (!$this->session->get('logged_in') || $this->session->get('user_role') !== 'admin') {
            return redirect()->to('/auth/login')->with('error', 'Akses ditolak.');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $status = $this->request->getGet('status');
        
        if ($status) {
            $pesanan = $this->pesananModel
                ->select('pesanan.*, users.nama as user_nama')
                ->join('users', 'users.id = pesanan.user_id')
                ->where('pesanan.status', $status)
                ->orderBy('pesanan.created_at', 'DESC')
                ->findAll();
        } else {
            $pesanan = $this->pesananModel->getAllWithUser();
        }

        $data = [
            'title' => 'Kelola Pesanan - Admin',
            'pesanan' => $pesanan,
            'current_status' => $status,
            'stats' => $this->pesananModel->getStats(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/pesanan/index', $data)
             . view('admin/templates/footer');
    }

    public function detail(int $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $pesanan = $this->pesananModel
            ->select('pesanan.*, users.nama as user_nama, users.email as user_email')
            ->join('users', 'users.id = pesanan.user_id')
            ->where('pesanan.id', $id)
            ->first();

        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $details = $this->detailPesananModel->getByPesanan($id);

        $data = [
            'title' => 'Detail Pesanan - Admin',
            'pesanan' => $pesanan,
            'details' => $details,
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/pesanan/detail', $data)
             . view('admin/templates/footer');
    }

    public function updateStatus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $pesanan = $this->pesananModel->find($id);
        if (!$pesanan) {
            return redirect()->to('/admin/pesanan')->with('error', 'Pesanan tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $validStatus = ['pending', 'dikonfirmasi', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];

        if (!in_array($status, $validStatus)) {
            return redirect()->to('/admin/pesanan/detail/' . $id)->with('error', 'Status tidak valid.');
        }

        $this->pesananModel->updateStatus($id, $status);

        return redirect()->to('/admin/pesanan/detail/' . $id)
                       ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
