<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriProdukModel;
use CodeIgniter\HTTP\RedirectResponse;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;
    protected $session;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriProdukModel();
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
            'title' => 'Kelola Produk - Admin',
            'produk' => $this->produkModel
                ->select('produk.*, kategori_produk.nama as kategori_nama')
                ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                ->orderBy('produk.created_at', 'DESC')
                ->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/produk/index', $data)
             . view('admin/templates/footer');
    }

    public function tambah()
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $data = [
            'title' => 'Tambah Produk - Admin',
            'kategori' => $this->kategoriModel->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/produk/form', $data)
             . view('admin/templates/footer');
    }

    public function simpan(): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $rules = [
            'nama'        => 'required|min_length[3]',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/produk/tambah')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $nama = $this->request->getPost('nama');
        $slug = url_title($nama, '-', true) . '-' . time();

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = null;
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/produk', $gambarName);
        }

        $data = [
            'nama'        => $nama,
            'slug'        => $slug,
            'kategori_id' => $this->request->getPost('kategori_id'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'berat'       => $this->request->getPost('berat') ?? 0,
            'gambar'      => $gambarName,
            'status'      => $this->request->getPost('status') ?? 'aktif',
        ];

        $this->produkModel->insert($data);

        return redirect()->to('/admin/produk')
                       ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Produk - Admin',
            'produk' => $produk,
            'kategori' => $this->kategoriModel->findAll(),
        ];
        
        return view('admin/templates/header', $data)
             . view('admin/produk/form', $data)
             . view('admin/templates/footer');
    }

    public function update(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan.');
        }

        $rules = [
            'nama'        => 'required|min_length[3]',
            'kategori_id' => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/admin/produk/edit/' . $id)
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Handle image upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = $produk['gambar'];
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            if ($gambarName && file_exists('uploads/produk/' . $gambarName)) {
                unlink('uploads/produk/' . $gambarName);
            }
            $gambarName = $gambar->getRandomName();
            $gambar->move('uploads/produk', $gambarName);
        }

        $data = [
            'nama'        => $this->request->getPost('nama'),
            'kategori_id' => $this->request->getPost('kategori_id'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'harga'       => $this->request->getPost('harga'),
            'stok'        => $this->request->getPost('stok'),
            'berat'       => $this->request->getPost('berat') ?? 0,
            'gambar'      => $gambarName,
            'status'      => $this->request->getPost('status') ?? 'aktif',
        ];

        $this->produkModel->update($id, $data);

        return redirect()->to('/admin/produk')
                       ->with('success', 'Produk berhasil diperbarui.');
    }

    public function hapus(int $id): RedirectResponse
    {
        if ($redirect = $this->checkAdmin()) return $redirect;

        $produk = $this->produkModel->find($id);
        if ($produk && $produk['gambar']) {
            if (file_exists('uploads/produk/' . $produk['gambar'])) {
                unlink('uploads/produk/' . $produk['gambar']);
            }
        }

        $this->produkModel->delete($id);

        return redirect()->to('/admin/produk')
                       ->with('success', 'Produk berhasil dihapus.');
    }
}
