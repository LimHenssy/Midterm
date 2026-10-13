<?php
namespace App\Controllers;

use App\Models\CustomerModel;

class CustomerController extends BaseController
{
    public function index()
    {
        $model = new CustomerModel();
        $data['customers'] = $model->findAll();
        return view('customers/index', $data);
    }

    public function create()
    {
        return view('customers/create');
    }

    public function store()
    {
        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty|min_length[7]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CustomerModel();
        $model->save([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/customers')->with('success', 'Trainer added!');
    }

    public function edit($id)
    {
        $model = new CustomerModel();
        $data['customer'] = $model->find($id);
        return view('customers/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'full_name' => 'required|min_length[2]',
            'email'     => 'required|valid_email',
            'phone'     => 'permit_empty|min_length[7]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new CustomerModel();
        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to('/customers')->with('success', 'Trainer updated!');
    }

    public function delete($id)
    {
        $model = new CustomerModel();
        $model->delete($id);
        return redirect()->to('/customers')->with('success', 'Trainer removed!');
    }
}