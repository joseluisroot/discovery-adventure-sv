<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ReviewModel;
use App\Models\ServiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        // =========================
        // REVIEWS (tu lógica actual)
        // =========================
        $reviewModel = new ReviewModel();

        $reviews = $reviewModel->orderBy('id', 'DESC')->findAll(200);

        $total = count($reviews);

        $sumTotal = 0.0;
        $sumAttention = 0.0;
        $sumPunctuality = 0.0;
        $sumClean = 0.0;
        $sumComfort = 0.0;

        $publishedCount = 0;
        $topCount = 0;      // score >= 4.2
        $lowCount = 0;      // score < 3.5
        $needsFollowUp = []; // reseñas bajas recientes (para acción)

        foreach ($reviews as $r) {
            $score = (float) ($r['score_total'] ?? 0);
            $att   = (float) ($r['rating_attention'] ?? 0);
            $pun   = (float) ($r['rating_punctuality'] ?? 0);
            $cln   = (float) ($r['rating_cleanliness'] ?? 0);
            $comf  = (float) ($r['rating_comfort'] ?? 0);

            $sumTotal += $score;
            $sumAttention += $att;
            $sumPunctuality += $pun;
            $sumClean += $cln;
            $sumComfort += $comf;

            if ((int)($r['published'] ?? 0) === 1) $publishedCount++;

            if ($score >= 4.2) $topCount++;
            if ($score > 0 && $score < 3.5) {
                $lowCount++;
                if (count($needsFollowUp) < 5) $needsFollowUp[] = $r;
            }
        }

        $avgTotal = $total ? round($sumTotal / $total, 2) : 0.0;
        $avgAttention = $total ? round($sumAttention / $total, 2) : 0.0;
        $avgPunctuality = $total ? round($sumPunctuality / $total, 2) : 0.0;
        $avgClean = $total ? round($sumClean / $total, 2) : 0.0;
        $avgComfort = $total ? round($sumComfort / $total, 2) : 0.0;

        $topPct = $total ? round(($topCount / $total) * 100, 1) : 0.0;
        $lowPct = $total ? round(($lowCount / $total) * 100, 1) : 0.0;

        // =========================
        // OPERACIONES (Services/Customers)
        // =========================
        $serviceModel  = new ServiceModel();
        $customerModel = new CustomerModel();

        $today    = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        // KPIs Operativos (queries independientes para evitar builder “consumido”)
        $ops = [
            'customers_total' => $customerModel->countAllResults(),
            'services_total'  => $serviceModel->countAllResults(),
            'today_total'     => $serviceModel->where('service_date', $today)->countAllResults(),
            'tomorrow_total'  => $serviceModel->where('service_date', $tomorrow)->countAllResults(),
            'pending_total'   => $serviceModel->where('status', 'pending')->countAllResults(),
            'confirmed_total' => $serviceModel->where('status', 'confirmed')->countAllResults(),
        ];

        // Listas rápidas (top 8)
        $todayServices = $serviceModel->select('services.*, customers.name as customer_name, customers.phone as customer_phone')
            ->join('customers', 'customers.id = services.customer_id', 'left')
            ->where('services.service_date', $today)
            ->orderBy('services.service_time', 'ASC')
            ->findAll(8);

        $tomorrowServices = $serviceModel->select('services.*, customers.name as customer_name, customers.phone as customer_phone')
            ->join('customers', 'customers.id = services.customer_id', 'left')
            ->where('services.service_date', $tomorrow)
            ->orderBy('services.service_time', 'ASC')
            ->findAll(8);

        $pendingServices = $serviceModel->select('services.*, customers.name as customer_name, customers.phone as customer_phone')
            ->join('customers', 'customers.id = services.customer_id', 'left')
            ->whereIn('services.status', ['pending', 'confirmed'])
            ->orderBy('services.service_date', 'ASC')
            ->orderBy('services.service_time', 'ASC')
            ->findAll(8);

        return view('admin/dashboard', [
            'locale' => $locale,

            // Reviews
            'metrics' => [
                'reviews_total' => $total,
                'reviews_published' => $publishedCount,
                'avg_total' => $avgTotal,
                'avg_attention' => $avgAttention,
                'avg_punctuality' => $avgPunctuality,
                'avg_cleanliness' => $avgClean,
                'avg_comfort' => $avgComfort,
                'top_pct' => $topPct,
                'low_pct' => $lowPct,
            ],
            'needsFollowUp' => $needsFollowUp,

            // Operaciones
            'ops' => $ops,
            'today' => $today,
            'tomorrow' => $tomorrow,
            'todayServices' => $todayServices,
            'tomorrowServices' => $tomorrowServices,
            'pendingServices' => $pendingServices,
        ]);
    }
}
