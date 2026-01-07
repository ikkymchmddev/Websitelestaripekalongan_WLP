<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;
use App\Models\KategoriArtikelModel;
use CodeIgniter\HTTP\RedirectResponse;

class Artikel extends BaseController
{
    protected $artikelModel;
    protected $kategoriModel;
    protected $session;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->kategoriModel = new KategoriArtikelModel();
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
            'title' => 'Kelola Artikel - Admin',
            'artikel' => $this->artikelModel
                ->select('artikel.*, kategori_artikel.nama as kategori_nama')
                ->join('kategori_artikel', 'kategori_artikel.id = artikel.kategori_id')
                ->orderBy('artikel.created_at', 'DESC')
                ->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/artikel/index', $data)
             . view('admin/templates/footer');
    }

    public function tambah()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $data = [
            'title' => 'Tambah Artikel - Admin',
            'kategori' => $this->kategoriModel->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/artikel/form', $data)
             . view('admin/templates/footer');
    }

    public function simpan(): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $rules = [
            'judul'       => 'required|min_length[5]',
            'kategori_id' => 'required',
            'konten'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/artikel/tambah')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $judul = $this->request->getPost('judul');
        $slug = url_title($judul, '-', true) . '-' . time();

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = null;
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/artikel', $gambarName);
        }

        $data = [
            'judul'       => $judul,
            'slug'        => $slug,
            'kategori_id' => $this->request->getPost('kategori_id'),
            'user_id'     => $this->session->get('user_id'),
            'ringkasan'   => $this->request->getPost('ringkasan'),
            'konten'      => $this->request->getPost('konten'),
            'gambar'      => $gambarName,
            'status'      => $this->request->getPost('status') ?? 'draft',
        ];

        $this->artikelModel->insert($data);

        return redirect()->to('/admin/artikel')
                       ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            return redirect()->to('/admin/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Artikel - Admin',
            'artikel' => $artikel,
            'kategori' => $this->kategoriModel->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/artikel/form', $data)
             . view('admin/templates/footer');
    }

    public function update(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            return redirect()->to('/admin/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        $rules = [
            'judul'       => 'required|min_length[5]',
            'kategori_id' => 'required',
            'konten'      => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/artikel/edit/' . $id)
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $judul = $this->request->getPost('judul');
        
        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = $artikel['gambar'];
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Delete old image
            if ($gambarName && file_exists('uploads/artikel/' . $gambarName)) {
                unlink('uploads/artikel/' . $gambarName);
            }
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/artikel', $gambarName);
        }

        $data = [
            'judul'       => $judul,
            'kategori_id' => $this->request->getPost('kategori_id'),
            'ringkasan'   => $this->request->getPost('ringkasan'),
            'konten'      => $this->request->getPost('konten'),
            'gambar'      => $gambarName,
            'status'      => $this->request->getPost('status') ?? 'draft',
        ];

        $this->artikelModel->update($id, $data);

        return redirect()->to('/admin/artikel')
                       ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function hapus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $artikel = $this->artikelModel->find($id);
        if ($artikel && $artikel['gambar']) {
            if (file_exists('uploads/artikel/' . $artikel['gambar'])) {
                unlink('uploads/artikel/' . $artikel['gambar']);
            }
        }

        $this->artikelModel->delete($id);

        return redirect()->to('/admin/artikel')
                       ->with('success', 'Artikel berhasil dihapus.');
    }
}
