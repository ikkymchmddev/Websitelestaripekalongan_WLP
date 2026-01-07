<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table            = 'pesanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'kode_pesanan', 'nama_penerima', 'telepon_penerima',
        'alamat_pengiriman', 'provinsi', 'kota', 'kecamatan', 'kode_pos',
        'subtotal', 'ongkir', 'total', 'metode_pembayaran', 'status', 'catatan'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'user_id'           => 'required|integer',
        'kode_pesanan'      => 'required|is_unique[pesanan.kode_pesanan,id,{id}]',
        'nama_penerima'     => 'required|min_length[3]',
        'telepon_penerima'  => 'required',
        'alamat_pengiriman' => 'required',
        'total'             => 'required|numeric',
    ];

    protected $skipValidation = false;

    /**
     * Generate unique order code
     */
    public function generateKode(): string
    {
        $prefix = 'LP';
        $date = date('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 4));
        return "{$prefix}{$date}{$random}";
    }

    /**
     * Get by kode pesanan
     */
    public function getByKode(string $kode)
    {
        return $this->where('kode_pesanan', $kode)->first();
    }

    /**
     * Get user orders
     */
    public function getByUser(int $userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get orders by status
     */
    public function getByStatus(string $status)
    {
        return $this->where('status', $status)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get all orders with user info
     */
    public function getAllWithUser()
    {
        return $this->select('pesanan.*, users.nama as user_nama, users.email as user_email')
                    ->join('users', 'users.id = pesanan.user_id')
                    ->orderBy('pesanan.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Update order status
     */
    public function updateStatus(int $id, string $status)
    {
        return $this->update($id, ['status' => $status]);
    }

    /**
     * Get order statistics
     */
    public function getStats()
    {
        $stats = [
            'total'       => $this->countAll(),
            'pending'     => $this->where('status', 'pending')->countAllResults(false),
            'dikonfirmasi' => $this->where('status', 'dikonfirmasi')->countAllResults(false),
            'diproses'    => $this->where('status', 'diproses')->countAllResults(false),
            'dikirim'     => $this->where('status', 'dikirim')->countAllResults(false),
            'selesai'     => $this->where('status', 'selesai')->countAllResults(false),
            'dibatalkan'  => $this->where('status', 'dibatalkan')->countAllResults(false),
        ];
        
        // Reset query builder
        $this->builder()->resetQuery();
        
        // Get total revenue from completed orders
        $revenue = $this->selectSum('total')
                        ->where('status', 'selesai')
                        ->first();
        $stats['revenue'] = $revenue['total'] ?? 0;
        
        return $stats;
    }
}
