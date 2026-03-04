<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $locale = service('request')->getLocale();

        // Permitir acceder a login/attempt sin sesión
        $path = trim((string) service('uri')->getPath(), '/');
        if (str_ends_with($path, "{$locale}/admin/login") || str_ends_with($path, "{$locale}/admin/attempt")) {
            return;
        }

        if (!session()->get('admin_logged_in')) {
            return redirect()->to("/{$locale}/admin/login");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
