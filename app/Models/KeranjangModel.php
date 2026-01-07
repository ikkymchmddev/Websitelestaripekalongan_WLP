<?php

namespace App\Models;

use CodeIgniter\Model;

class KeranjangModel extends Model
{
    protected $table            = 'keranjang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'produk_id', 'jumlah'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id'   => 'required|integer',
        'produk_id' => 'required|integer',
        'jumlah'    => 'required|integer|greater_than[0]',
    ];

    protected $skipValidation = false;

    /**
     * Get cart items for user with product details
     */
    public function getByUser(int $userId)
    {
        return $this->select('keranjang.*, produk.nama, produk.harga, produk.stok, produk.gambar, produk.slug')
                    ->join('produk', 'produk.id = keranjang.produk_id')
                    ->where('keranjang.user_id', $userId)
                    ->where('produk.status', 'aktif')
                    ->findAll();
    }

    /**
     * Get cart count for user
     */
    public function getCount(int $userId): int
    {
        return $this->where('user_id', $userId)->countAllResults();
    }

    /**
     * Get cart total for user
     */
    public function getTotal(int $userId)
    {
        $items = $this->getByUser($userId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['harga'] * $item['jumlah'];
        }
        return $total;
    }

    /**
     * Add or update cart item
     */
    public function addItem(int $userId, int $produkId, int $jumlah = 1)
    {
        $existing = $this->where('user_id', $userId)
                         ->where('produk_id', $produkId)
                         ->first();
        
        if ($existing) {
            return $this->update($existing['id'], [
                'jumlah' => $existing['jumlah'] + $jumlah
            ]);
        }
        
        return $this->insert([
            'user_id'   => $userId,
            'produk_id' => $produkId,
            'jumlah'    => $jumlah
        ]);
    }

    /**
     * Update item quantity
     */
    public function updateJumlah(int $id, int $jumlah, int $userId)
    {
        return $this->where('id', $id)
                    ->where('user_id', $userId)
                    ->set('jumlah', $jumlah)
                    ->update();
    }

    /**
     * Remove item from cart
     */
    public function removeItem(int $id, int $userId)
    {
        return $this->where('id', $id)
                    ->where('user_id', $userId)
                    ->delete();
    }

    /**
     * Clear user cart
     */
    public function clearCart(int $userId)
    {
        return $this->where('user_id', $userId)->delete();
    }

    /**
     * Validate cart items stock
     */
    public function validateStock(int $userId): array
    {
        $items = $this->getByUser($userId);
        $errors = [];
        
        foreach ($items as $item) {
            if ($item['jumlah'] > $item['stok']) {
                $errors[] = [
                    'produk' => $item['nama'],
                    'requested' => $item['jumlah'],
                    'available' => $item['stok']
                ];
            }
        }
        
        return $errors;
    }
}
