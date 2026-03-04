<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ReviewInviteModel;
use App\Models\ServiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class ReviewInvitesController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $inviteModel  = new ReviewInviteModel();
        $serviceModel = new ServiceModel();

        // Traer invites recientes
        $invites = $inviteModel->orderBy('id', 'DESC')->findAll(60);

        // Servicios recientes para dropdown (si quieres más, sube el límite)
        $services = $serviceModel->orderBy('id', 'DESC')->findAll(200);

        // mapear servicios por id para etiqueta en tabla
        $servicesById = [];
        foreach ($services as $s) {
            $servicesById[$s['id']] = $s;
        }

        return view('admin/review_invites_index', [
            'locale' => $locale,
            'invites' => $invites,
            'services' => $services,
            'servicesById' => $servicesById,
        ]);
    }

    public function create()
    {
        $locale = service('request')->getLocale();

        // Validación mínima: service_id requerido
        $rules = [
            'service_id' => 'required|is_natural_no_zero',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $serviceId = (int) $this->request->getPost('service_id');

        // Confirmar que el servicio existe
        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($serviceId);
        if (!$service) {
            return redirect()->back()->with('errors', ['service_id' => 'Service not found']);
        }

        // Token: seguro y difícil de adivinar
        $token = bin2hex(random_bytes(20)); // 40 chars

        $inviteModel = new ReviewInviteModel();
        $inviteModel->insert([
            'service_id' => $serviceId,
            'token' => $token,
            'sent_at' => null,
            'responded_at' => null,
        ]);

        $targetLocale = (string) $this->request->getPost('target_locale');
        if (!in_array($targetLocale, ['es','en'], true)) {
            $targetLocale = $locale; // fallback al idioma actual
        }

        $reviewUrl = base_url($targetLocale . '/review/' . $token);

        $serviceType = $service['service_type'] ?? 'service';

        if ($targetLocale === 'en') {
            $msg = ($serviceType === 'corporate')
                ? "Hi! Thank you for using Discovery Adventure SV for corporate transportation. Could you rate our service here? $reviewUrl"
                : "Hi! Thanks for traveling with Discovery Adventure SV. Could you rate your tour experience here? $reviewUrl";
        } else {
            $msg = ($serviceType === 'corporate')
                ? "¡Hola! Gracias por utilizar Discovery Adventure SV para transporte corporativo. ¿Nos ayudas con tu reseña aquí? $reviewUrl"
                : "¡Hola! Gracias por viajar con Discovery Adventure SV. ¿Nos ayudas con tu reseña del tour aquí? $reviewUrl";
        }

        return redirect()->back()
            ->with('success', 'Invite created')
            ->with('reviewUrl', $reviewUrl)
            ->with('waMessage', $msg);
    }

    public function markSent(int $id)
    {
        $inviteModel = new ReviewInviteModel();
        $invite = $inviteModel->find($id);

        if (!$invite) {
            return redirect()->back()->with('errors', ['Invite not found']);
        }

        $inviteModel->update($id, [
            'sent_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('success', 'Invite marked as sent');
    }
}
