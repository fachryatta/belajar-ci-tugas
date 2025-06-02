<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;

class Redirect implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Kita tidak pakai before
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $session = Services::session();

        // Jika user baru login, dan belum diarahkan sebelumnya
        if ($session->get('isLoggedIn') && !$session->get('hasRedirected')) {
            $session->set('hasRedirected', true);
            return redirect()->to('/contact');
        }
    }
}
