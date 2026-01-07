<?php

namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table            = 'artikel';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kategori_id', 'user_id', 'judul', 'slug', 'ringkasan',
        'konten', 'gambar', 'status', 'views'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'judul'       => 'required|min_length[5]|max_length[255]',
        'slug'        => 'required|is_unique[artikel.slug,id,{id}]',
        'kategori_id' => 'required|integer',
        'konten'      => 'required',
    ];

    protected $skipValidation = false;

    /**
     * Get by slug with category and author
     */
    public function getBySlug(string $slug)
    {
        return $this->select('artikel.*, kategori_artikel.nama as kategori_nama, users.nama as penulis')
                    ->join('kategori_artikel', 'kategori_artikel.id = artikel.kategori_id')
                    ->join('users', 'users.id = artikel.user_id')
                    ->where('artikel.slug', $slug)
                    ->first();
    }

    /**
     * Get published articles
     */
    public function getPublished(int $limit = 10, int $offset = 0)
    {
        return $this->select('artikel.*, kategori_artikel.nama as kategori_nama, users.nama as penulis')
                    ->join('kategori_artikel', 'kategori_artikel.id = artikel.kategori_id')
                    ->join('users', 'users.id = artikel.user_id')
                    ->where('artikel.status', 'published')
                    ->orderBy('artikel.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    /**
     * Get by category
     */
    public function getByCategory(int $kategoriId, int $limit = 10)
    {
        return $this->select('artikel.*, kategori_artikel.nama as kategori_nama')
                    ->join('kategori_artikel', 'kategori_artikel.id = artikel.kategori_id')
                    ->where('artikel.kategori_id', $kategoriId)
                    ->where('artikel.status', 'published')
                    ->orderBy('artikel.created_at', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Increment view count
     */
    public function incrementViews(int $id)
    {
        return $this->set('views', 'views + 1', false)
                    ->where('id', $id)
                    ->update();
    }

    /**
     * Get popular articles
     */
    public function getPopular(int $limit = 5)
    {
        return $this->where('status', 'published')
                    ->orderBy('views', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Search articles
     */
    public function search(string $keyword, int $limit = 10)
    {
        return $this->select('artikel.*, kategori_artikel.nama as kategori_nama')
                    ->join('kategori_artikel', 'kategori_artikel.id = artikel.kategori_id')
                    ->where('artikel.status', 'published')
                    ->groupStart()
                        ->like('artikel.judul', $keyword)
                        ->orLike('artikel.konten', $keyword)
                        ->orLike('artikel.ringkasan', $keyword)
                    ->groupEnd()
                    ->orderBy('artikel.created_at', 'DESC')
                    ->findAll($limit);
    }
}
