<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kategori_id', 'nama', 'slug', 'deskripsi', 'harga',
        'stok', 'berat', 'gambar', 'galeri', 'status', 'terjual'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama'        => 'required|min_length[3]|max_length[255]',
        'slug'        => 'required|is_unique[produk.slug,id,{id}]',
        'kategori_id' => 'required|integer',
        'harga'       => 'required|numeric',
        'stok'        => 'required|integer',
    ];

    protected $skipValidation = false;

    /**
     * Get by slug with category
     */
    public function getBySlug(string $slug)
    {
        return $this->select('produk.*, kategori_produk.nama as kategori_nama')
                    ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                    ->where('produk.slug', $slug)
                    ->first();
    }

    /**
     * Get active products
     */
    public function getActive(int $limit = 12, int $offset = 0)
    {
        return $this->select('produk.*, kategori_produk.nama as kategori_nama')
                    ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                    ->where('produk.status', 'aktif')
                    ->where('produk.stok >', 0)
                    ->orderBy('produk.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get by category
     */
    public function getByCategory(int $kategoriId, int $limit = 12)
    {
        return $this->select('produk.*, kategori_produk.nama as kategori_nama')
                    ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                    ->where('produk.kategori_id', $kategoriId)
                    ->where('produk.status', 'aktif')
                    ->orderBy('produk.created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get featured/best seller products
     */
    public function getBestSeller(int $limit = 8)
    {
        return $this->select('produk.*, kategori_produk.nama as kategori_nama')
                    ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                    ->where('produk.status', 'aktif')
                    ->orderBy('produk.terjual', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Search products
     */
    public function search(string $keyword, int $limit = 12)
    {
        return $this->select('produk.*, kategori_produk.nama as kategori_nama')
                    ->join('kategori_produk', 'kategori_produk.id = produk.kategori_id')
                    ->where('produk.status', 'aktif')
                    ->groupStart()
                        ->like('produk.nama', $keyword)
                        ->orLike('produk.deskripsi', $keyword)
                    ->groupEnd()
                    ->orderBy('produk.created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Reduce stock after order
     */
    public function reduceStock(int $id, int $qty)
    {
        $produk = $this->find($id);
        if ($produk && $produk['stok'] >= $qty) {
            return $this->update($id, [
                'stok'    => $produk['stok'] - $qty,
                'terjual' => $produk['terjual'] + $qty
            ]);
        }
        return false;
    }

    /**
     * Check stock availability
     */
    public function checkStock(int $id, int $qty): bool
    {
        $produk = $this->find($id);
        return $produk && $produk['stok'] >= $qty;
    }
}
