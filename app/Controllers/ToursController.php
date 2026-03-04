<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ToursController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $meta = [
            'title' => $locale === 'en'
                ? 'Tours | Discovery Adventure SV'
                : 'Tours | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Private tours and transportation across El Salvador. Beaches, mountains, volcanoes and iconic routes. Book via WhatsApp.'
                : 'Tours privados y transporte turístico en El Salvador. Playa, montaña, volcanes y rutas emblemáticas. Reserva por WhatsApp.',
            'canonical' => current_url(),
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'TouristTrip',
            'name' => 'Discovery Adventure SV Tours',
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'Discovery Adventure SV',
                'telephone' => '+50369296224',
                'url' => base_url($locale),
            ],
            'areaServed' => 'El Salvador',
        ];

        return view('public/tours', compact('locale','meta','schema'));
    }
}
