<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table            = 'detail_pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'pesanan_id', 'produk_id', 'nama_produk', 'harga', 'jumlah', 'subtotal'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'pesanan_id'  => 'required|integer',
        'produk_id'   => 'required|integer',
        'nama_produk' => 'required',
        'harga'       => 'required|numeric',
        'jumlah'      => 'required|integer',
        'subtotal'    => 'required|numeric',
    ];

    protected $skipValidation = false;

    /**
     * Get details by pesanan ID
     */
    public function getByPesanan(int $pesananId)
    {
        return $this->select('detail_pesanan.*, produk.gambar, produk.slug')
                    ->join('produk', 'produk.id = detail_pesanan.produk_id')
                    ->where('detail_pesanan.pesanan_id', $pesananId)
                    ->findAll();
    }

    /**
     * Create from cart items
     */
    public function createFromCart(int $pesananId, array $cartItems)
    {
        $data = [];
        foreach ($cartItems as $item) {
            $data[] = [
                'pesanan_id'  => $pesananId,
                'produk_id'   => $item['produk_id'],
                'nama_produk' => $item['nama'],
                'harga'       => $item['harga'],
                'jumlah'      => $item['jumlah'],
                'subtotal'    => $item['harga'] * $item['jumlah'],
            ];
        }
        return $this->insertBatch($data);
    }
}
