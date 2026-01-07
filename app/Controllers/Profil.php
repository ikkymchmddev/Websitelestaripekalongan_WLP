<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class Profil extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    /**
     * Check if user is logged in
     */
    private function checkLogin(): ?RedirectResponse
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/auth/login')
                           ->with('error', 'Silakan login terlebih dahulu.');
        }
        return null;
    }

    /**
     * View profile
     */
    public function index()
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'title' => 'Profil Saya - Lestari Pekalongan',
            'user' => $user,
        ];
        
        return view('templates/header', $data)
             . view('profil/index', $data)
             . view('templates/footer');
    }

    /**
     * Update profile
     */
    public function update(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');

        $rules = [
            'nama'    => 'required|min_length[3]|max_length[100]',
            'telepon' => 'permit_empty|min_length[10]|max_length[20]',
            'alamat'  => 'permit_empty',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/profil')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama'    => $this->request->getPost('nama'),
            'telepon' => $this->request->getPost('telepon'),
            'alamat'  => $this->request->getPost('alamat'),
        ];

        $this->userModel->update($userId, $data);

        // Update session
        $this->session->set('user_nama', $data['nama']);

        return redirect()->to('/profil')
                       ->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Change password
     */
    public function ubahPassword(): RedirectResponse
    {
        if ($redirect = $this->checkLogin()) {
            return $redirect;
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        $rules = [
            'password_lama'  => 'required',
            'password_baru'  => 'required|min_length[6]',
            'konfirmasi_password' => 'required|matches[password_baru]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/profil')
                           ->withInput()
                           ->with('errors', $this->validator->getErrors());
        }

        // Verify old password
        if (!$this->userModel->verifyPassword($this->request->getPost('password_lama'), $user['password'])) {
            return redirect()->to('/profil')
                           ->with('error', 'Password lama salah.');
        }

        $this->userModel->update($userId, [
            'password' => $this->userModel->hashPassword($this->request->getPost('password_baru')),
        ]);

        return redirect()->to('/profil')
                       ->with('success', 'Password berhasil diubah.');
    }
}
