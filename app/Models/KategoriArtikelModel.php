<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriArtikelModel extends Model
{
    protected $table            = 'kategori_artikel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'slug', 'deskripsi'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|is_unique[kategori_artikel.slug,id,{id}]',
    ];

    protected $skipValidation = false;

    /**
     * Get by slug
     */
    public function getBySlug(string $slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get all with article count
     */
    public function getAllWithCount()
    {
        return $this->select('kategori_artikel.*, COUNT(artikel.id) as jumlah_artikel')
                    ->join('artikel', 'artikel.kategori_id = kategori_artikel.id', 'left')
                    ->groupBy('kategori_artikel.id')
                    ->findAll();
    }
}
