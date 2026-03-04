<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ServicesController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en'
                ? 'Services | Discovery Adventure SV'
                : 'Servicios | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Tourist and corporate transportation in El Salvador. Punctual, clean, comfortable and bilingual service. Book via WhatsApp.'
                : 'Transporte turístico y corporativo en El Salvador. Puntualidad, limpieza, comodidad y servicio bilingüe. Reserva por WhatsApp.',
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

        return view('public/services', compact('locale','meta','schema'));
    }
}
