<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'slug', 'deskripsi', 'gambar'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|is_unique[kategori_produk.slug,id,{id}]',
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
     * Get all with product count
     */
    public function getAllWithCount()
    {
        return $this->select('kategori_produk.*, COUNT(produk.id) as jumlah_produk')
                    ->join('produk', 'produk.kategori_id = kategori_produk.id', 'left')
                    ->groupBy('kategori_produk.id')
                    ->findAll();
    }
}
