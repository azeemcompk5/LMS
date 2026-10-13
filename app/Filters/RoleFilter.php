<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $role = session()->get('user_role');

        if (!$role) {
            return redirect()->to('/login');
        }

        if (!$arguments) {
            return null;
        }

        if (!in_array($role, $arguments, true)) {
            return redirect()->to('/dashboard');
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Nothing required here.
    }
}