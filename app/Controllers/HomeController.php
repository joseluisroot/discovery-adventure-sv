<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $reviewModel = new ReviewModel();

        // Solo reseñas publicadas
        $published = $reviewModel
            ->where('published', 1)
            ->orderBy('id', 'DESC')
            ->findAll(200);

        $count = count($published);

        $avgTotal = 0.0;
        $avgAttention = 0.0;

        if ($count > 0) {
            $sumTotal = 0.0;
            $sumAttention = 0.0;

            foreach ($published as $r) {
                $sumTotal += (float) ($r['score_total'] ?? 0);
                $sumAttention += (float) ($r['rating_attention'] ?? 0);
            }

            $avgTotal = round($sumTotal / $count, 2);
            $avgAttention = round($sumAttention / $count, 2);
        }

        // Top 3 reseñas para Home (las más recientes publicadas)
        $featured = array_slice($published, 0, 3);

        $meta = [
            'title' => $locale === 'en'
                ? 'Discovery Adventure SV | Private Transportation & Tours in El Salvador'
                : 'Discovery Adventure SV | Transporte Privado y Tours en El Salvador',
            'description' => $locale === 'en'
                ? 'Safe, comfortable and bilingual transportation for tourists and corporate clients. Book via WhatsApp +503 6929 6224.'
                : 'Transporte seguro, cómodo y bilingüe para turistas y clientes corporativos. Reserva por WhatsApp +503 6929 6224.',
            'canonical' => current_url(),
            'og_image' => base_url('assets/og-default.jpg'),
        ];

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'Discovery Adventure SV',
            'telephone' => '+50369296224',
            'url' => base_url($locale),
            'areaServed' => 'El Salvador',
        ];

        return view('public/home', [
            'locale' => $locale,
            'meta' => $meta,
            'schema' => $schema,
            'reviewStats' => [
                'count' => $count,
                'avg_total' => $avgTotal,
                'avg_attention' => $avgAttention,
            ],
            'featuredReviews' => $featured,
        ]);
    }
}
