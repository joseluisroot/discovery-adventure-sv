<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LegalController extends BaseController
{
    public function privacy()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en' ? 'Privacy Policy | Discovery Adventure SV' : 'Política de Privacidad | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Privacy policy for Discovery Adventure SV.'
                : 'Política de privacidad de Discovery Adventure SV.',
            'canonical' => current_url(),
        ];

        return view('public/privacy', compact('locale','meta'));
    }

    public function terms()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en' ? 'Terms of Service | Discovery Adventure SV' : 'Términos del Servicio | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Terms of service for Discovery Adventure SV.'
                : 'Términos del servicio de Discovery Adventure SV.',
            'canonical' => current_url(),
        ];

        return view('public/terms', compact('locale','meta'));
    }
}
