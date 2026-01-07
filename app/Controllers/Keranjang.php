<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\RedirectResponse;

class Keranjang extends BaseController
{
    protected $keranjangModel;
    protected $produkModel;
    protected $session;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->produkModel = new ProdukModel();
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
     * View cart
     */
    public function index()
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $items = $this->keranjangModel->getByUser($userId);
        $total = $this->keranjangModel->getTotal($userId);

        $data = [
            'title' => 'Keranjang Belanja - Lestari Pekalongan',
            'items' => $items,
            'total' => $total,
        ];
        
        return view('templates/header', $data)
             . view('keranjang/index', $data)
             . view('templates/footer');
    }

    /**
     * Add to cart
     */
    public function add(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $produkId = $this->request->getPost('produk_id');
        $jumlah = $this->request->getPost('jumlah') ?? 1;

        // Check product exists and has stock
        $produk = $this->produkModel->find($produkId);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        if ($produk['stok'] < $jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        $this->keranjangModel->addItem($userId, $produkId, $jumlah);

        return redirect()->to('/keranjang')
                       ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update cart item quantity
     */
    public function update(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $id = $this->request->getPost('id');
        $jumlah = $this->request->getPost('jumlah');

        if ($jumlah < 1) {
            return $this->remove();
        }

        // Validate stock
        $item = $this->keranjangModel->find($id);
        if ($item) {
            $produk = $this->produkModel->find($item['produk_id']);
            if ($produk && $jumlah > $produk['stok']) {
                return redirect()->to('/keranjang')
                               ->with('error', 'Stok tidak mencukupi. Stok tersedia: ' . $produk['stok']);
            }
        }

        $this->keranjangModel->updateJumlah($id, $jumlah, $userId);

        return redirect()->to('/keranjang')
                       ->with('success', 'Keranjang berhasil diperbarui.');
    }

    /**
     * Remove item from cart
     */
    public function remove(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $id = $this->request->getPost('id') ?? $this->request->getGet('id');

        $this->keranjangModel->removeItem($id, $userId);

        return redirect()->to('/keranjang')
                       ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /**
     * Get cart count (AJAX)
     */
    public function count()
    {
        $userId = $this->session->get('user_id');
        $count = $userId ? $this->keranjangModel->getCount($userId) : 0;
        
        return $this->response->setJSON(['count' => $count]);
    }
}
