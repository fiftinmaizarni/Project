<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class NoAuthFilter implements FilterInterface
{
    public function before($request, $arguments = null)
    {
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to('/admin/dashboard');
        }
    }

    public function after($request, $response, $arguments = null)
    {
    }
}
