<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CorporateController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en'
                ? 'Corporate Transportation | Discovery Adventure SV'
                : 'Transporte Corporativo | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Reliable corporate transportation in El Salvador. Airport transfers, executive rides, events and scheduled services. Book via WhatsApp.'
                : 'Transporte corporativo confiable en El Salvador. Aeropuerto, traslados ejecutivos, eventos y servicios programados. Reserva por WhatsApp.',
            'canonical' => current_url(),
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => 'Corporate Transportation',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Discovery Adventure SV',
                'telephone' => '+50369296224',
                'url' => base_url($locale),
            ],
            'areaServed' => 'El Salvador',
        ];

        return view('public/corporate', compact('locale','meta','schema'));
    }
}
