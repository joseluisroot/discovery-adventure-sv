<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class SystemController extends BaseController
{
    private function guard()
    {
        // Bloqueo global (para apagar el panel sin borrar archivos)
        if (filter_var(env('app.systemLock'), FILTER_VALIDATE_BOOLEAN) === true) {
            return $this->response->setStatusCode(403)->setBody('Locked.');
        }

        // Requerir HTTPS (recomendado)
        if (!$this->request->isSecure()) {
            return $this->response->setStatusCode(400)->setBody('HTTPS required.');
        }

        // Token
        $token = (string) $this->request->getGet('token');
        $expected = (string) env('app.systemToken');

        var_dump($token);

        if ($expected === '' || $token === '' || !hash_equals($expected, $token)) {
            return $this->response->setStatusCode(401)->setBody('Unauthorized.');
        }

        // IP allowlist (opcional)
        $allowedIp = (string) env('app.systemAllowIp');
        if ($allowedIp !== '') {
            $clientIp = (string) $this->request->getIPAddress();
            if ($clientIp !== $allowedIp) {
                return $this->response->setStatusCode(403)->setBody('Forbidden (IP not allowed).');
            }
        }

        return null; // OK
    }

    public function ping()
    {
        if ($resp = $this->guard()) return $resp;

        return $this->response->setJSON([
            'ok' => true,
            'message' => 'SystemController OK',
            'time' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Corre migraciones pendientes
     * GET /admin/system/migrate?token=...
     */
    public function migrate()
    {
        if ($resp = $this->guard()) return $resp;

        try {
            $migrations = Services::migrations();
            $migrations->latest();

            $error = $migrations->getError();
            if (!empty($error)) {
                return $this->response->setStatusCode(500)->setBody("Migration error:\n" . $error);
            }

            return $this->response->setJSON([
                'ok' => true,
                'message' => 'Migraciones ejecutadas correctamente.',
                'time' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setBody("Exception:\n" . $e->getMessage());
        }
    }

    /**
     * Seeder:
     * - GET /admin/system/seed?token=...&name=DatabaseSeeder
     * - GET /admin/system/seed?token=...&all=1   (si tienes DatabaseSeeder orquestando todo)
     */
    public function seed()
    {
        if ($resp = $this->guard()) return $resp;

        $name = (string) $this->request->getGet('name');
        $all  = (string) $this->request->getGet('all');

        // Decide cuál usar si piden all=1
        if ($all === '1' && $name === '') {
            $name = 'DatabaseSeeder';
        }

        if ($name === '') {
            return $this->response->setStatusCode(400)->setBody('Missing seeder name (?name=DatabaseSeeder).');
        }

        try {
            $seeder = Services::seeder();
            $seeder->call($name);

            return $this->response->setJSON([
                'ok' => true,
                'message' => "Seeder ejecutado: {$name}",
                'time' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setBody("Exception:\n" . $e->getMessage());
        }
    }

    /**
     * Limpieza general:
     * GET /admin/system/clear?token=...
     */
    public function clear()
    {
        if ($resp = $this->guard()) return $resp;

        $results = [
            'cache'  => null,
            'routes' => null,
            'views'  => null,
        ];

        // Cache
        try {
            $cache = Services::cache();
            $results['cache'] = $cache->clean() ? 'cleaned' : 'not cleaned';
        } catch (\Throwable $e) {
            $results['cache'] = 'error: ' . $e->getMessage();
        }

        // Routes cache (si existe)
        try {
            $path = WRITEPATH . 'cache' . DIRECTORY_SEPARATOR . 'routes.cache';
            if (is_file($path)) {
                @unlink($path);
                $results['routes'] = 'routes.cache deleted';
            } else {
                $results['routes'] = 'routes.cache not found';
            }
        } catch (\Throwable $e) {
            $results['routes'] = 'error: ' . $e->getMessage();
        }

        // Views cache (si existe)
        try {
            $viewsPath = WRITEPATH . 'cache' . DIRECTORY_SEPARATOR . 'views';
            if (is_dir($viewsPath)) {
                $this->deleteDir($viewsPath);
                $results['views'] = 'views cache deleted';
            } else {
                $results['views'] = 'views cache not found';
            }
        } catch (\Throwable $e) {
            $results['views'] = 'error: ' . $e->getMessage();
        }

        return $this->response->setJSON([
            'ok' => true,
            'message' => 'Clear ejecutado.',
            'results' => $results,
            'time' => date('Y-m-d H:i:s'),
        ]);
    }

    /**
     * Helper: borrar directorio recursivo
     */
    private function deleteDir(string $dir): void
    {
        if (!is_dir($dir)) return;

        $items = array_diff(scandir($dir), ['.', '..']);
        foreach ($items as $item) {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $this->deleteDir($path);
            } else {
                @unlink($path);
            }
        }
        @rmdir($dir);
    }
}
