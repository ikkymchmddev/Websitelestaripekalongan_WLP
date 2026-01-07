<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama', 'email', 'password', 'google_id', 'avatar',
        'telepon', 'alamat', 'role', 'status'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama'  => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Get user by email
     */
    public function getByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Get user by Google ID
     */
    public function getByGoogleId(string $googleId)
    {
        return $this->where('google_id', $googleId)->first();
    }

    /**
     * Get all members (anggota)
     */
    public function getAnggota()
    {
        return $this->where('role', 'anggota')->findAll();
    }

    /**
     * Get all admins
     */
    public function getAdmin()
    {
        return $this->where('role', 'admin')->findAll();
    }

    /**
     * Verify password
     */
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * Hash password
     */
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
