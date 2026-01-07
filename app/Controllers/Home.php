<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\ProdukModel;
use App\Models\TpsModel;

class Home extends BaseController
{
    protected $artikelModel;
    protected $produkModel;
    protected $tpsModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
        $this->produkModel = new ProdukModel();
        $this->tpsModel = new TpsModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Beranda - Lestari Pekalongan',
            'artikel_terbaru' => $this->artikelModel->getPublished(3),
            'produk_unggulan' => $this->produkModel->getBestSeller(4),
            'tps_aktif' => count($this->tpsModel->getActive()),
        ];
        
        return view('templates/header', $data)
             . view('home/index', $data)
             . view('templates/footer');
    }

    public function tentang(): string
    {
        $data = [
            'title' => 'Tentang Kami - Lestari Pekalongan',
        ];
        
        return view('templates/header', $data)
             . view('home/tentang', $data)
             . view('templates/footer');
    }

    public function kontak(): string
    {
        $data = [
            'title' => 'Kontak - Lestari Pekalongan',
        ];
        
        return view('templates/header', $data)
             . view('home/kontak', $data)
             . view('templates/footer');
    }
}
