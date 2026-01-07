<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriProdukModel;

class Produk extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriProdukModel();
    }

    /**
     * List all products
     */
    public function index(): string
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = 12;
        $offset = ($page - 1) * $limit;

        $kategoriSlug = $this->request->getGet('kategori');
        $search = $this->request->getGet('q');
        $sort = $this->request->getGet('sort') ?? 'terbaru';

        if ($search) {
            $produk = $this->produkModel->search($search, $limit);
            $total = count($produk);
        } elseif ($kategoriSlug) {
            $kategori = $this->kategoriModel->getBySlug($kategoriSlug);
            if ($kategori) {
                $produk = $this->produkModel->getByCategory($kategori['id'], $limit);
                $total = count($produk);
            } else {
                $produk = [];
                $total = 0;
            }
        } else {
            $produk = $this->produkModel->getActive($limit, $offset);
            $total = $this->produkModel->where('status', 'aktif')->where('stok >', 0)->countAllResults();
        }

        // Sort products
        if ($sort === 'termurah') {
            usort($produk, fn($a, $b) => $a['harga'] <=> $b['harga']);
        } elseif ($sort === 'termahal') {
            usort($produk, fn($a, $b) => $b['harga'] <=> $a['harga']);
        } elseif ($sort === 'terlaris') {
            usort($produk, fn($a, $b) => $b['terjual'] <=> $a['terjual']);
        }

        $data = [
            'title' => 'Produk Kerajinan - Lestari Pekalongan',
            'produk' => $produk,
            'kategori' => $this->kategoriModel->getAllWithCount(),
            'current_kategori' => $kategoriSlug,
            'search' => $search,
            'sort' => $sort,
            'pager' => [
                'current' => $page,
                'total' => ceil($total / $limit),
            ],
        ];
        
        return view('templates/header', $data)
             . view('produk/index', $data)
             . view('templates/footer');
    }

    /**
     * View single product
     */
    public function detail(string $slug): string
    {
        $produk = $this->produkModel->getBySlug($slug);

        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Parse gallery images
        $produk['galeri_array'] = json_decode($produk['galeri'] ?? '[]', true) ?? [];

        // Get related products from same category
        $related = $this->produkModel
            ->where('kategori_id', $produk['kategori_id'])
            ->where('id !=', $produk['id'])
            ->where('status', 'aktif')
            ->orderBy('terjual', 'DESC')
            ->findAll(4);

        $data = [
            'title' => $produk['nama'] . ' - Lestari Pekalongan',
            'produk' => $produk,
            'related' => $related,
        ];
        
        return view('templates/header', $data)
             . view('produk/detail', $data)
             . view('templates/footer');
    }
}
