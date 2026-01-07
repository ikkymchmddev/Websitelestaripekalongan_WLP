<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Anggota extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
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

        $data = [
            'title' => 'Kelola Anggota - Admin',
            'anggota' => $this->userModel->where('role', 'anggota')->orderBy('created_at', 'DESC')->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/anggota/index', $data)
             . view('admin/templates/footer');
    }

    public function detail(int $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $anggota = $this->userModel->find($id);
        if (!$anggota || $anggota['role'] !== 'anggota') {
            return redirect()->to('/admin/anggota')->with('error', 'Anggota tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Anggota - Admin',
            'anggota' => $anggota,
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/anggota/detail', $data)
             . view('admin/templates/footer');
    }

    public function updateStatus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $anggota = $this->userModel->find($id);
        if (!$anggota || $anggota['role'] !== 'anggota') {
            return redirect()->to('/admin/anggota')->with('error', 'Anggota tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        if (!in_array($status, ['aktif', 'nonaktif'])) {
            return redirect()->to('/admin/anggota')->with('error', 'Status tidak valid.');
        }

        $this->userModel->update($id, ['status' => $status]);

        return redirect()->to('/admin/anggota')
                       ->with('success', 'Status anggota berhasil diperbarui.');
    }

    public function hapus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $anggota = $this->userModel->find($id);
        if (!$anggota || $anggota['role'] !== 'anggota') {
            return redirect()->to('/admin/anggota')->with('error', 'Anggota tidak ditemukan.');
        }

        $this->userModel->delete($id);

        return redirect()->to('/admin/anggota')
                       ->with('success', 'Anggota berhasil dihapus.');
    }
}
