<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FleetController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en' ? 'Fleet | Discovery Adventure SV' : 'Flota | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Modern microbus for private transportation and tours in El Salvador. Comfortable, clean, and ideal for groups.'
                : 'Microbús moderno para transporte privado y tours en El Salvador. Cómodo, limpio e ideal para grupos.',
            'canonical' => current_url(),
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Discovery Adventure SV',
            'telephone' => '+50369296224',
            'url' => base_url($locale),
            'areaServed' => 'El Salvador',
        ];

        return view('public/fleet', compact('locale','meta','schema'));
    }
}
