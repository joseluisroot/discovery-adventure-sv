<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function login()
    {
        $locale = service('request')->getLocale();

        // Si ya está logueado, manda al dashboard
        if (session()->get('admin_logged_in')) {
            return redirect()->to("/{$locale}/admin");
        }

        return view('admin/auth/login', [
            'locale' => $locale,
        ]);
    }

    public function attempt()
    {
        $locale = service('request')->getLocale();

        $email = trim((string) $this->request->getPost('email'));
        $pass  = (string) $this->request->getPost('password');

        if ($email === '' || $pass === '') {
            return redirect()->back()->withInput()->with('errors', ['Completa email y contraseña.']);
        }

        $model = new AdminUserModel();
        $user  = $model->findActiveByEmail($email);

        if (!$user || !password_verify($pass, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('errors', ['Credenciales inválidas.']);
        }

        // Regenerar sesión (seguridad)
        session()->regenerate(true);

        session()->set([
            'admin_logged_in' => true,
            'admin_user_id'   => (int) $user['id'],
            'admin_name'      => $user['name'],
            'admin_email'     => $user['email'],
        ]);

        $model->update($user['id'], [
            'last_login_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to("/{$locale}/admin")->with('success', 'Bienvenido al admin.');
    }

    public function logout()
    {
        $locale = service('request')->getLocale();
        session()->destroy();
        return redirect()->to("/{$locale}/admin/login")->with('success', 'Sesión cerrada.');
    }
}
