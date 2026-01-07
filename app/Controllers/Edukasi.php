<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriArtikelModel;

class Edukasi extends BaseController
{
    protected $artikelModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->kategoriModel = new KategoriArtikelModel();
    }

    /**
     * List all articles
     */
    public function index(): string
    {
        $page = $this->request->getGet('page') ?? 1;
        $limit = 9;
        $offset = ($page - 1) * $limit;

        $kategoriSlug = $this->request->getGet('kategori');
        $search = $this->request->getGet('q');

        if ($search) {
            $artikel = $this->artikelModel->search($search, $limit);
            $total = count($artikel);
        } elseif ($kategoriSlug) {
            $kategori = $this->kategoriModel->getBySlug($kategoriSlug);
            if ($kategori) {
                $artikel = $this->artikelModel->getByCategory($kategori['id'], $limit);
                $total = count($artikel);
            } else {
                $artikel = [];
                $total = 0;
            }
        } else {
            $artikel = $this->artikelModel->getPublished($limit, $offset);
            $total = $this->artikelModel->where('status', 'published')->countAllResults();
        }

        $data = [
            'title' => 'Edukasi - Lestari Pekalongan',
            'artikel' => $artikel,
            'kategori' => $this->kategoriModel->getAllWithCount(),
            'popular' => $this->artikelModel->getPopular(5),
            'current_kategori' => $kategoriSlug,
            'search' => $search,
            'pager' => [
                'current' => $page,
                'total' => ceil($total / $limit),
            ],
        ];
        
        return view('templates/header', $data)
             . view('edukasi/index', $data)
             . view('templates/footer');
    }

    /**
     * View single article
     */
    public function detail(string $slug): string
    {
        $artikel = $this->artikelModel->getBySlug($slug);

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Increment views
        $this->artikelModel->incrementViews($artikel['id']);

        // Get related articles from same category
        $related = $this->artikelModel
            ->where('kategori_id', $artikel['kategori_id'])
            ->where('id !=', $artikel['id'])
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->findAll(3);

        $data = [
            'title' => $artikel['judul'] . ' - Lestari Pekalongan',
            'artikel' => $artikel,
            'related' => $related,
            'kategori' => $this->kategoriModel->getAllWithCount(),
        ];
        
        return view('templates/header', $data)
             . view('edukasi/detail', $data)
             . view('templates/footer');
    }
}
