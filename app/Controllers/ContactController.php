<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ContactController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en'
                ? 'Contact | Discovery Adventure SV'
                : 'Contacto | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Book private transportation and tours in El Salvador via WhatsApp +503 6929 6224. Fast response and bilingual service.'
                : 'Reserva transporte privado y tours en El Salvador por WhatsApp +503 6929 6224. Respuesta rápida y servicio bilingüe.',
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

        return view('public/contact', compact('locale','meta','schema'));
    }
}
