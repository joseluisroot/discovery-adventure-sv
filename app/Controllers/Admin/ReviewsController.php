<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewsController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();
        $reviewModel = new ReviewModel();

        $published = $this->request->getGet('published'); // '1' | '0' | null
        $minScore  = $this->request->getGet('minScore');  // e.g 4.0
        $low       = $this->request->getGet('low');       // '1'

        $builder = $reviewModel->builder();

        if ($published === '1' || $published === '0') {
            $builder->where('published', (int) $published);
        }

        if ($minScore !== null && $minScore !== '') {
            $builder->where('score_total >=', (float) $minScore);
        }

        if ($low === '1') {
            $builder->where('score_total <', 3.5);
        }

        $reviews = $builder->orderBy('id', 'DESC')->get(80)->getResultArray();

        // Métricas (sobre el set filtrado)
        $total = count($reviews);
        $avgTotal = 0.0;
        $avgAttention = 0.0;

        if ($total > 0) {
            $sumTotal = 0.0;
            $sumAttention = 0.0;
            foreach ($reviews as $r) {
                $sumTotal += (float) ($r['score_total'] ?? 0);
                $sumAttention += (float) ($r['rating_attention'] ?? 0);
            }
            $avgTotal = round($sumTotal / $total, 2);
            $avgAttention = round($sumAttention / $total, 2);
        }

        return view('admin/reviews_index', [
            'locale' => $locale,
            'reviews' => $reviews,
            'filters' => [
                'published' => $published,
                'minScore' => $minScore,
                'low' => $low,
            ],
            'metrics' => [
                'count' => $total,
                'avg_total' => $avgTotal,
                'avg_attention' => $avgAttention,
            ],
        ]);
    }

    public function publish(int $id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel->find($id);

        $score = (float)($review['score_total'] ?? 0);
        if ($score < 4.2) {
            return redirect()->back()->with('errors', ['This review score is below 4.2. Consider not publishing it.']);
        }

        if (!$review) {
            return redirect()->back()->with('errors', ['Review not found']);
        }

        $reviewModel->update($id, [
            'published' => 1
        ]);

        return redirect()->back()->with('success', 'Review published');
    }

    public function unpublish(int $id)
    {
        $reviewModel = new ReviewModel();
        $review = $reviewModel->find($id);

        if (!$review) {
            return redirect()->back()->with('errors', ['Review not found']);
        }

        $reviewModel->update($id, [
            'published' => 0
        ]);

        return redirect()->back()->with('success', 'Review unpublished');
    }
}
