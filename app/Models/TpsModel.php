<?php

namespace App\Models;

use CodeIgniter\Model;

class TpsModel extends Model
{
    protected $table            = 'tps';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama', 'alamat', 'latitude', 'longitude', 'telepon',
        'jam_buka', 'jam_tutup', 'hari_operasional', 'jenis_sampah',
        'kapasitas', 'terisi', 'gambar', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama'      => 'required|min_length[3]|max_length[255]',
        'alamat'    => 'required',
        'latitude'  => 'required|decimal',
        'longitude' => 'required|decimal',
    ];

    protected $skipValidation = false;

    /**
     * Get active TPS locations
     */
    public function getActive()
    {
        return $this->where('status', 'aktif')
                    ->orderBy('nama', 'ASC')
                    ->findAll();
    }

    /**
     * Get all TPS for map (with coordinates)
     */
    public function getForMap()
    {
        return $this->select('id, nama, alamat, latitude, longitude, status, jam_buka, jam_tutup')
                    ->whereIn('status', ['aktif', 'penuh'])
                    ->findAll();
    }

    /**
     * Get TPS by status
     */
    public function getByStatus(string $status)
    {
        return $this->where('status', $status)->findAll();
    }

    /**
     * Update capacity
     */
    public function updateKapasitas(int $id, int $terisi)
    {
        $tps = $this->find($id);
        if ($tps) {
            $status = 'aktif';
            if ($terisi >= $tps['kapasitas']) {
                $status = 'penuh';
            }
            return $this->update($id, [
                'terisi' => $terisi,
                'status' => $status
            ]);
        }
        return false;
    }

    /**
     * Get nearby TPS (simple distance calculation)
     */
    public function getNearby(float $lat, float $lng, float $radius = 10)
    {
        // Using Haversine formula approximation
        return $this->select("*, 
            (6371 * acos(cos(radians({$lat})) * cos(radians(latitude)) * cos(radians(longitude) - radians({$lng})) + sin(radians({$lat})) * sin(radians(latitude)))) AS distance")
            ->where('status', 'aktif')
            ->having("distance < {$radius}")
            ->orderBy('distance', 'ASC')
            ->findAll();
    }
}
