<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use App\Models\ServiceModel;
use CodeIgniter\HTTP\ResponseInterface;

class ServicesController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();

        $serviceModel  = new ServiceModel();
        $customerModel = new CustomerModel();

        $q = trim((string) $this->request->getGet('q'));

        // Listado con join simple para mostrar customer name
        $builder = $serviceModel->select('services.*, customers.name as customer_name, customers.phone as customer_phone')
            ->join('customers', 'customers.id = services.customer_id', 'left');

        if ($q !== '') {
            $builder = $builder->groupStart()
                ->like('customers.name', $q)
                ->orLike('customers.phone', $q)
                ->orLike('services.origin', $q)
                ->orLike('services.destination', $q)
                ->orLike('services.status', $q)
                ->groupEnd();
        }

        $services = $builder->orderBy('services.id', 'DESC')->paginate(20);
        $pager    = $serviceModel->pager;

        return view('admin/services/index', [
            'locale'   => $locale,
            'services' => $services,
            'pager'    => $pager,
            'q'        => $q,
        ]);
    }

    // ✅ Form para crear service ya amarrado al customer
    public function newForCustomer(int $customerId)
    {
        $locale = service('request')->getLocale();

        $customerModel = new CustomerModel();
        $customer = $customerModel->find($customerId);

        if (!$customer) {
            return redirect()->to("/{$locale}/admin/customers")
                ->with('error', 'Customer no encontrado.');
        }

        return view('admin/services/form', [
            'locale'   => $locale,
            'mode'     => 'create',
            'customer' => $customer,
            'data'     => [
                'customer_id'  => $customerId,
                'service_type' => 'tour', // default
                'origin'       => '',
                'destination'  => '',
                'service_date' => date('Y-m-d'),
                'service_time' => '08:00',
                'passengers'   => 1,
                'status'       => 'pending',
                'notes'        => '',
            ],
            'errors'   => session('errors') ?? [],
        ]);
    }

    public function createForCustomer(int $customerId)
    {
        $locale = service('request')->getLocale();

        $customerModel = new CustomerModel();
        if (!$customerModel->find($customerId)) {
            return redirect()->to("/{$locale}/admin/customers")
                ->with('error', 'Customer no encontrado.');
        }

        $serviceModel = new ServiceModel();

        $payload = $this->request->getPost([
            'service_type','origin','destination',
            'service_date','service_time','passengers','status','notes'
        ]);

        $payload['customer_id'] = $customerId;
        $payload['passengers']  = (int) ($payload['passengers'] ?? 1);

        if (!$serviceModel->insert($payload)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $serviceModel->errors());
        }

        return redirect()->to("/{$locale}/admin/services")
            ->with('success', 'Servicio creado y asociado al customer.');
    }

    public function edit(int $id)
    {
        $locale = service('request')->getLocale();

        $serviceModel  = new ServiceModel();
        $customerModel = new CustomerModel();

        $service = $serviceModel->find($id);
        if (!$service) {
            return redirect()->to("/{$locale}/admin/services")
                ->with('error', 'Servicio no encontrado.');
        }

        $customer = $customerModel->find((int) $service['customer_id']);

        return view('admin/services/form', [
            'locale'   => $locale,
            'mode'     => 'edit',
            'id'       => $id,
            'customer' => $customer, // puede ser null si borraron customer
            'data'     => $service,
            'errors'   => session('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        $locale = service('request')->getLocale();

        $serviceModel = new ServiceModel();
        $service = $serviceModel->find($id);

        if (!$service) {
            return redirect()->to("/{$locale}/admin/services")
                ->with('error', 'Servicio no encontrado.');
        }

        $payload = $this->request->getPost([
            'service_type','origin','destination',
            'service_date','service_time','passengers','status','notes'
        ]);

        $payload['passengers'] = (int) ($payload['passengers'] ?? 1);

        if (!$serviceModel->update($id, $payload)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $serviceModel->errors());
        }

        return redirect()->to("/{$locale}/admin/services")
            ->with('success', 'Servicio actualizado.');
    }

    public function delete(int $id)
    {
        $locale = service('request')->getLocale();

        $serviceModel = new ServiceModel();
        if (!$serviceModel->find($id)) {
            return redirect()->to("/{$locale}/admin/services")
                ->with('error', 'Servicio no encontrado.');
        }

        $serviceModel->delete($id);

        return redirect()->to("/{$locale}/admin/services")
            ->with('success', 'Servicio eliminado.');
    }
}
