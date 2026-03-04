<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewsController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $reviewModel = new ReviewModel();

        // Solo publicadas
        $reviews = $reviewModel
            ->where('published', 1)
            ->orderBy('id', 'DESC')
            ->findAll(60);

        // Métricas (sobre publicadas)
        $count = count($reviews);

        $avgTotal = 0.0;
        $avgAttention = 0.0;
        $avgPunctuality = 0.0;
        $avgCleanliness = 0.0;
        $avgComfort = 0.0;

        $pctTop = 0.0; // >= 4.2
        $topCount = 0;

        if ($count > 0) {
            $sumTotal = $sumAtt = $sumPun = $sumCln = $sumComf = 0.0;

            foreach ($reviews as $r) {
                $score = (float) ($r['score_total'] ?? 0);
                $sumTotal += $score;
                $sumAtt += (float) ($r['rating_attention'] ?? 0);
                $sumPun += (float) ($r['rating_punctuality'] ?? 0);
                $sumCln += (float) ($r['rating_cleanliness'] ?? 0);
                $sumComf += (float) ($r['rating_comfort'] ?? 0);

                if ($score >= 4.2) $topCount++;
            }

            $avgTotal = round($sumTotal / $count, 2);
            $avgAttention = round($sumAtt / $count, 2);
            $avgPunctuality = round($sumPun / $count, 2);
            $avgCleanliness = round($sumCln / $count, 2);
            $avgComfort = round($sumComf / $count, 2);

            $pctTop = round(($topCount / $count) * 100, 1);
        }

        $meta = [
            'title' => $locale === 'en'
                ? 'Reviews | Discovery Adventure SV'
                : 'Reseñas | Discovery Adventure SV',
            'description' => $locale === 'en'
                ? 'Real customer reviews about our private tours and transportation service in El Salvador.'
                : 'Reseñas reales de clientes sobre nuestros tours privados y servicio de transporte en El Salvador.',
            'canonical' => current_url(),
        ];

        return view('public/reviews', [
            'locale' => $locale,
            'meta' => $meta,
            'reviews' => $reviews,
            'metrics' => [
                'count' => $count,
                'avg_total' => $avgTotal,
                'avg_attention' => $avgAttention,
                'avg_punctuality' => $avgPunctuality,
                'avg_cleanliness' => $avgCleanliness,
                'avg_comfort' => $avgComfort,
                'pct_top' => $pctTop,
            ],
        ]);
    }
}
