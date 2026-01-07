<?php

namespace App\Controllers;

use App\Models\KeranjangModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\ProdukModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Checkout extends BaseController
{
    protected $keranjangModel;
    protected $pesananModel;
    protected $detailPesananModel;
    protected $produkModel;
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->keranjangModel = new KeranjangModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->produkModel = new ProdukModel();
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
     * Checkout page
     */
    public function index()
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $items = $this->keranjangModel->getByUser($userId);

        if (empty($items)) {
            return redirect()->to('/keranjang')
                           ->with('error', 'Keranjang belanja kosong.');
        }

        // Validate stock
        $stockErrors = $this->keranjangModel->validateStock($userId);
        if (!empty($stockErrors)) {
            $errorMsg = 'Stok tidak mencukupi untuk: ';
            foreach ($stockErrors as $error) {
                $errorMsg .= $error['produk'] . ' (tersedia: ' . $error['available'] . '), ';
            }
            return redirect()->to('/keranjang')
                           ->with('error', rtrim($errorMsg, ', '));
        }

        $user = $this->userModel->find($userId);
        $total = $this->keranjangModel->getTotal($userId);

        $data = [
            'title' => 'Checkout - Lestari Pekalongan',
            'items' => $items,
            'total' => $total,
            'user' => $user,
        ];
        
        return view('templates/header', $data)
             . view('checkout/index', $data)
             . view('templates/footer');
    }

    /**
     * Process checkout
     */
    public function proses(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $items = $this->keranjangModel->getByUser($userId);

        if (empty($items)) {
            return redirect()->to('/keranjang')
                           ->with('error', 'Keranjang belanja kosong.');
        }

        // Validate stock again
        $stockErrors = $this->keranjangModel->validateStock($userId);
        if (!empty($stockErrors)) {
            return redirect()->to('/keranjang')
                           ->with('error', 'Beberapa produk stoknya tidak mencukupi.');
        }

        // Validate form
        $rules = [
            'nama_penerima'     => 'required|min_length[3]',
            'telepon_penerima'  => 'required|min_length[10]',
            'alamat_pengiriman' => 'required|min_length[10]',
            'kota'              => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/checkout')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Calculate totals
        $subtotal = 0;
        $cartItems = [];
        foreach ($items as $item) {
            $itemSubtotal = $item['harga'] * $item['jumlah'];
            $subtotal += $itemSubtotal;
            $cartItems[] = [
                'produk_id' => $item['produk_id'],
                'nama'      => $item['nama'],
                'harga'     => $item['harga'],
                'jumlah'    => $item['jumlah'],
            ];
        }

        $ongkir = 0; // COD - no shipping cost for local
        $total = $subtotal + $ongkir;

        // Create order
        $pesananData = [
            'user_id'           => $userId,
            'kode_pesanan'      => $this->pesananModel->generateKode(),
            'nama_penerima'     => $this->request->getPost('nama_penerima'),
            'telepon_penerima'  => $this->request->getPost('telepon_penerima'),
            'alamat_pengiriman' => $this->request->getPost('alamat_pengiriman'),
            'provinsi'          => $this->request->getPost('provinsi'),
            'kota'              => $this->request->getPost('kota'),
            'kecamatan'         => $this->request->getPost('kecamatan'),
            'kode_pos'          => $this->request->getPost('kode_pos'),
            'subtotal'          => $subtotal,
            'ongkir'            => $ongkir,
            'total'             => $total,
            'metode_pembayaran' => 'COD',
            'status'            => 'pending',
            'catatan'           => $this->request->getPost('catatan'),
        ];

        $pesananId = $this->pesananModel->insert($pesananData);

        // Create order details
        $this->detailPesananModel->createFromCart($pesananId, $cartItems);

        // Reduce product stock
        foreach ($items as $item) {
            $this->produkModel->reduceStock($item['produk_id'], $item['jumlah']);
        }

        // Clear cart
        $this->keranjangModel->clearCart($userId);

        return redirect()->to('/checkout/sukses/' . $pesananData['kode_pesanan'])
                       ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Order success page
     */
    public function sukses(string $kode)
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $pesanan = $this->pesananModel->getByKode($kode);

        if (!$pesanan || $pesanan['user_id'] != $this->session->get('user_id')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $details = $this->detailPesananModel->getByPesanan($pesanan['id']);

        $data = [
            'title' => 'Pesanan Berhasil - Lestari Pekalongan',
            'pesanan' => $pesanan,
            'details' => $details,
        ];
        
        return view('templates/header', $data)
             . view('checkout/sukses', $data)
             . view('templates/footer');
    }
}
