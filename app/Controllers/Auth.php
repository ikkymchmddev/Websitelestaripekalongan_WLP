<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    /**
     * Login page
     */
    public function login(): string
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login - Lestari Pekalongan',
        ];
        
        return view('templates/header', $data)
             . view('auth/login', $data)
             . view('templates/footer');
    }

    /**
     * Process login
     */
    public function doLogin(): RedirectResponse
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->getByEmail($email);

        if (!$user) {
            return redirect()->to('/auth/login')
                           ->with('error', 'Email tidak ditemukan.');
        }

        if ($user['status'] !== 'aktif') {
            return redirect()->to('/auth/login')
                           ->with('error', 'Akun Anda tidak aktif.');
        }

        if (!$this->userModel->verifyPassword($password, $user['password'])) {
            return redirect()->to('/auth/login')
                           ->with('error', 'Password salah.');
        }

        $this->setUserSession($user);

        // Redirect based on role
        if ($user['role'] === 'admin') {
            return redirect()->to('/admin');
        }

        return redirect()->to('/');
    }

    /**
     * Register page
     */
    public function register(): string
    {
        if ($this->session->get('logged_in')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Daftar - Lestari Pekalongan',
        ];
        
        return view('templates/header', $data)
             . view('auth/register', $data)
             . view('templates/footer');
    }

    /**
     * Process registration
     */
    public function doRegister(): RedirectResponse
    {
        $rules = [
            'nama'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password]',
            'telepon'  => 'permit_empty|min_length[10]|max_length[20]',
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Email sudah terdaftar.',
            ],
            'konfirmasi_password' => [
                'matches' => 'Konfirmasi password tidak cocok.',
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/auth/register')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->userModel->hashPassword($this->request->getPost('password')),
            'telepon'  => $this->request->getPost('telepon'),
            'role'     => 'anggota',
            'status'   => 'aktif',
        ];

        $this->userModel->insert($data);

        return redirect()->to('/auth/login')
                       ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Google OAuth callback (mock for demo)
     */
    public function googleCallback(): RedirectResponse
    {
        // In production, this would handle Google OAuth response
        // For demo, we'll simulate a Google login
        
        $googleId = $this->request->getGet('google_id') ?? 'demo_google_123';
        $email = $this->request->getGet('email') ?? 'demo@gmail.com';
        $nama = $this->request->getGet('name') ?? 'Demo User';
        $avatar = $this->request->getGet('avatar') ?? '';

        // Check if user exists
        $user = $this->userModel->getByGoogleId($googleId);

        if (!$user) {
            // Check if email exists
            $existingUser = $this->userModel->getByEmail($email);
            
            if ($existingUser) {
                // Link Google account to existing user
                $this->userModel->update($existingUser['id'], [
                    'google_id' => $googleId,
                    'avatar'    => $avatar,
                ]);
                $user = $this->userModel->find($existingUser['id']);
            } else {
                // Create new user
                $userId = $this->userModel->insert([
                    'nama'      => $nama,
                    'email'     => $email,
                    'google_id' => $googleId,
                    'avatar'    => $avatar,
                    'role'      => 'anggota',
                    'status'    => 'aktif',
                ]);
                $user = $this->userModel->find($userId);
            }
        }

        if ($user['status'] !== 'aktif') {
            return redirect()->to('/auth/login')
                           ->with('error', 'Akun Anda tidak aktif.');
        }

        $this->setUserSession($user);

        return redirect()->to('/');
    }

    /**
     * Logout
     */
    public function logout(): RedirectResponse
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    /**
     * Set user session
     */
    private function setUserSession(array $user): void
    {
        $this->session->set([
            'user_id'   => $user['id'],
            'user_nama' => $user['nama'],
            'user_email'=> $user['email'],
            'user_role' => $user['role'],
            'user_avatar' => $user['avatar'] ?? '',
            'logged_in' => true,
        ]);
    }
}
