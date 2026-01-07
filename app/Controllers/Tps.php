<?php

namespace App\Controllers;

use App\Models\TpsModel;

class Tps extends BaseController
{
    protected $tpsModel;

    public function __construct()
    {
        $this->tpsModel = new TpsModel();
    }

    /**
     * TPS map page
     */
    public function index(): string
    {
        $tps = $this->tpsModel->getForMap();
        
        $data = [
            'title' => 'Lokasi TPS - Lestari Pekalongan',
            'tps' => $tps,
            'tps_json' => json_encode($tps),
        ];
        
        return view('templates/header', $data)
             . view('tps/index', $data)
             . view('templates/footer');
    }

    /**
     * TPS detail
     */
    public function detail(int $id): string
    {
        $tps = $this->tpsModel->find($id);

        if (!$tps) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tps['jenis_sampah_array'] = json_decode($tps['jenis_sampah'] ?? '[]', true) ?? [];
        $tps['persentase_terisi'] = $tps['kapasitas'] > 0 
            ? round(($tps['terisi'] / $tps['kapasitas']) * 100) 
            : 0;

        $data = [
            'title' => $tps['nama'] . ' - Lestari Pekalongan',
            'tps' => $tps,
        ];
        
        return view('templates/header', $data)
             . view('tps/detail', $data)
             . view('templates/footer');
    }

    /**
     * API: Get all TPS for map
     */
    public function apiList()
    {
        $tps = $this->tpsModel->getForMap();
        return $this->response->setJSON([
            'success' => true,
            'data' => $tps,
        ]);
    }

    /**
     * API: Get nearby TPS
     */
    public function apiNearby()
    {
        $lat = $this->request->getGet('lat');
        $lng = $this->request->getGet('lng');
        $radius = $this->request->getGet('radius') ?? 10;

        if (!$lat || !$lng) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Latitude dan longitude diperlukan.',
            ]);
        }

        $tps = $this->tpsModel->getNearby((float) $lat, (float) $lng, (float) $radius);
        
        return $this->response->setJSON([
            'success' => true,
            'data' => $tps,
        ]);
    }
}
