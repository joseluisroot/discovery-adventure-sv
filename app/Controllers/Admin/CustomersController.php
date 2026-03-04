<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CustomerModel;
use CodeIgniter\HTTP\ResponseInterface;

class CustomersController extends BaseController
{
    public function index()
    {
        $locale = service('request')->getLocale();
        $model  = new CustomerModel();

        $q = trim((string) $this->request->getGet('q'));

        $builder = $model;

        if ($q !== '') {
            $builder = $builder->groupStart()
                ->like('name', $q)
                ->orLike('email', $q)
                ->orLike('phone', $q)
                ->groupEnd();
        }

        $customers = $builder->orderBy('id', 'DESC')->paginate(20);
        $pager     = $model->pager;

        return view('admin/customers/index', [
            'locale'    => $locale,
            'customers' => $customers,
            'pager'     => $pager,
            'q'         => $q,
        ]);
    }

    public function new()
    {
        $locale = service('request')->getLocale();

        return view('admin/customers/form', [
            'locale' => $locale,
            'mode'   => 'create',
            'data'   => [
                'name'     => '',
                'phone'    => '',
                'email'    => '',
                'language' => $locale, // por defecto según el sitio
            ],
            'errors' => session('errors') ?? [],
        ]);
    }

    public function create()
    {
        $locale = service('request')->getLocale();
        $model  = new CustomerModel();

        $payload = $this->request->getPost(['name', 'phone', 'email', 'language']);

        if (!$model->insert($payload)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $model->errors());
        }

        return redirect()->to("/{$locale}/admin/customers")
            ->with('success', 'Customer creado correctamente.');
    }

    public function edit(int $id)
    {
        $locale = service('request')->getLocale();
        $model  = new CustomerModel();

        $customer = $model->find($id);
        if (!$customer) {
            return redirect()->to("/{$locale}/admin/customers")
                ->with('error', 'Customer no encontrado.');
        }

        return view('admin/customers/form', [
            'locale' => $locale,
            'mode'   => 'edit',
            'id'     => $id,
            'data'   => $customer,
            'errors' => session('errors') ?? [],
        ]);
    }

    public function update(int $id)
    {
        $locale = service('request')->getLocale();
        $model  = new CustomerModel();

        if (!$model->find($id)) {
            return redirect()->to("/{$locale}/admin/customers")
                ->with('error', 'Customer no encontrado.');
        }

        $payload = $this->request->getPost(['name', 'phone', 'email', 'language']);

        if (!$model->update($id, $payload)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $model->errors());
        }

        return redirect()->to("/{$locale}/admin/customers")
            ->with('success', 'Customer actualizado correctamente.');
    }

    public function delete(int $id)
    {
        $locale = service('request')->getLocale();
        $model  = new CustomerModel();

        if (!$model->find($id)) {
            return redirect()->to("/{$locale}/admin/customers")
                ->with('error', 'Customer no encontrado.');
        }

        $model->delete($id);

        return redirect()->to("/{$locale}/admin/customers")
            ->with('success', 'Customer eliminado.');
    }
}
