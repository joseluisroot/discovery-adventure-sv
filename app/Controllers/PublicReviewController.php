<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ReviewInviteModel;
use App\Models\ReviewModel;
use CodeIgniter\HTTP\ResponseInterface;

class PublicReviewController extends BaseController
{
    public function form(string $token)
    {
        $locale = service('request')->getLocale();

        $inviteModel = new ReviewInviteModel();
        $invite = $inviteModel->where('token', $token)->first();

        if (!$invite) {
            return view('public/review_invalid', ['locale' => $locale]);
        }

        // Si ya respondió (responded_at set) o ya existe review, mostrar mensaje
        $reviewModel = new ReviewModel();
        $existing = $reviewModel->where('invite_id', $invite['id'])->first();
        if ($existing || !empty($invite['responded_at'])) {
            return view('public/review_already', ['locale' => $locale]);
        }

        return view('public/review_form', [
            'locale' => $locale,
            'token'  => $token,
        ]);
    }

    public function submit()
    {
        $locale = service('request')->getLocale();

        // Validación
        $rules = [
            'token' => 'required|min_length[10]',
            'rating_cleanliness' => 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[5]',
            'rating_comfort'     => 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[5]',
            'rating_punctuality' => 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[5]',
            'rating_attention'   => 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[5]',
            'comment'            => 'permit_empty|max_length[800]',
        ];

        if (!$this->validate($rules)) {
            return view('public/review_form', [
                'locale' => $locale,
                'token'  => $this->request->getPost('token'),
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $token = (string) $this->request->getPost('token');

        $inviteModel = new ReviewInviteModel();
        $invite = $inviteModel->where('token', $token)->first();

        if (!$invite) {
            return view('public/review_invalid', ['locale' => $locale]);
        }

        // Evitar doble envío
        $reviewModel = new ReviewModel();
        $existing = $reviewModel->where('invite_id', $invite['id'])->first();
        if ($existing || !empty($invite['responded_at'])) {
            return view('public/review_already', ['locale' => $locale]);
        }

        $clean = (int) $this->request->getPost('rating_cleanliness');
        $comfort = (int) $this->request->getPost('rating_comfort');
        $punctuality = (int) $this->request->getPost('rating_punctuality');
        $attention = (int) $this->request->getPost('rating_attention');
        $comment = trim((string) $this->request->getPost('comment'));

        // Score ponderado (atención tiene mayor peso)
        // Pesos: Atención 40%, Puntualidad 20%, Limpieza 20%, Comodidad 20%
        $score = ($attention * 0.40) + ($punctuality * 0.20) + ($clean * 0.20) + ($comfort * 0.20);
        $score = round($score, 2);

        $reviewModel->insert([
            'invite_id' => $invite['id'],
            'rating_cleanliness' => $clean,
            'rating_comfort' => $comfort,
            'rating_punctuality' => $punctuality,
            'rating_attention' => $attention,
            'comment' => $comment ?: null,
            'language' => $locale,
            'score_total' => $score,
            'published' => 0, // admin decide publicar
        ]);

        // Marcar invite como respondido
        $inviteModel->update($invite['id'], [
            'responded_at' => date('Y-m-d H:i:s'),
        ]);

        return view('public/review_thanks', [
            'locale' => $locale,
            'score'  => $score,
        ]);
    }
}
