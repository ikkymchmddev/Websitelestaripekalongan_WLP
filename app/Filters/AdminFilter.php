<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    /**
     * Check if user is admin
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        if (!$session->get('logged_in')) {
            $session->setFlashdata('error', 'Silakan login terlebih dahulu');
            return redirect()->to('/auth/login');
        }
        
        if ($session->get('user_role') !== 'admin') {
            $session->setFlashdata('error', 'Anda tidak memiliki akses ke halaman ini');
            return redirect()->to('/');
        }
        
        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return $response;
    }
}
