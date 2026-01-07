<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TpsModel;
use CodeIgniter\HTTP\RedirectResponse;

class Tps extends BaseController
{
    protected $tpsModel;
    protected $session;

    public function __construct()
    {
        $this->tpsModel = new TpsModel();
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
            'title' => 'Kelola TPS - Admin',
            'tps' => $this->tpsModel->orderBy('created_at', 'DESC')->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/tps/index', $data)
             . view('admin/templates/footer');
    }

    public function tambah()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $data = [
            'title' => 'Tambah TPS - Admin',
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/tps/form', $data)
             . view('admin/templates/footer');
    }

    public function simpan(): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $rules = [
            'nama'      => 'required|min_length[3]',
            'alamat'    => 'required',
            'latitude'  => 'required|decimal',
            'longitude' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/tps/tambah')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = null;
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/tps', $gambarName);
        }

        // Handle jenis sampah array
        $jenisSampah = $this->request->getPost('jenis_sampah');
        $jenisSampahJson = $jenisSampah ? json_encode($jenisSampah) : null;

        $data = [
            'nama'             => $this->request->getPost('nama'),
            'alamat'           => $this->request->getPost('alamat'),
            'latitude'         => $this->request->getPost('latitude'),
            'longitude'        => $this->request->getPost('longitude'),
            'telepon'          => $this->request->getPost('telepon'),
            'jam_buka'         => $this->request->getPost('jam_buka'),
            'jam_tutup'        => $this->request->getPost('jam_tutup'),
            'hari_operasional' => $this->request->getPost('hari_operasional'),
            'jenis_sampah'     => $jenisSampahJson,
            'kapasitas'        => $this->request->getPost('kapasitas') ?? 0,
            'terisi'           => $this->request->getPost('terisi') ?? 0,
            'gambar'           => $gambarName,
            'status'           => $this->request->getPost('status') ?? 'aktif',
        ];

        $this->tpsModel->insert($data);

        return redirect()->to('/admin/tps')
                       ->with('success', 'TPS berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $tps = $this->tpsModel->find($id);
        if (!$tps) {
            return redirect()->to('/admin/tps')->with('error', 'TPS tidak ditemukan.');
        }

        $tps['jenis_sampah_array'] = json_decode($tps['jenis_sampah'] ?? '[]', true) ?? [];

        $data = [
            'title' => 'Edit TPS - Admin',
            'tps' => $tps,
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/tps/form', $data)
             . view('admin/templates/footer');
    }

    public function update(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $tps = $this->tpsModel->find($id);
        if (!$tps) {
            return redirect()->to('/admin/tps')->with('error', 'TPS tidak ditemukan.');
        }

        $rules = [
            'nama'      => 'required|min_length[3]',
            'alamat'    => 'required',
            'latitude'  => 'required|decimal',
            'longitude' => 'required|decimal',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/tps/edit/' . $id)
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = $tps['gambar'];
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            if ($gambarName && file_exists('uploads/tps/' . $gambarName)) {
                unlink('uploads/tps/' . $gambarName);
            }
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/tps', $gambarName);
        }

        $jenisSampah = $this->request->getPost('jenis_sampah');
        $jenisSampahJson = $jenisSampah ? json_encode($jenisSampah) : null;

        $data = [
            'nama'             => $this->request->getPost('nama'),
            'alamat'           => $this->request->getPost('alamat'),
            'latitude'         => $this->request->getPost('latitude'),
            'longitude'        => $this->request->getPost('longitude'),
            'telepon'          => $this->request->getPost('telepon'),
            'jam_buka'         => $this->request->getPost('jam_buka'),
            'jam_tutup'        => $this->request->getPost('jam_tutup'),
            'hari_operasional' => $this->request->getPost('hari_operasional'),
            'jenis_sampah'     => $jenisSampahJson,
            'kapasitas'        => $this->request->getPost('kapasitas') ?? 0,
            'terisi'           => $this->request->getPost('terisi') ?? 0,
            'gambar'           => $gambarName,
            'status'           => $this->request->getPost('status') ?? 'aktif',
        ];

        $this->tpsModel->update($id, $data);

        return redirect()->to('/admin/tps')
                       ->with('success', 'TPS berhasil diperbarui.');
    }

    public function hapus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $tps = $this->tpsModel->find($id);
        if ($tps && $tps['gambar']) {
            if (file_exists('uploads/tps/' . $tps['gambar'])) {
                unlink('uploads/tps/' . $tps['gambar']);
            }
        }

        $this->tpsModel->delete($id);

        return redirect()->to('/admin/tps')
                       ->with('success', 'TPS berhasil dihapus.');
    }
}
