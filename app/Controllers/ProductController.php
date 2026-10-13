<?php
namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('products/index', $data);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $rules = [
            'name'           => 'required|min_length[2]',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image'          => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products', $imageName);
        }

        $model = new ProductModel();
        $model->save([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName,
            'created_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return view('products/edit', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        $rules = [
            'name'           => 'required|min_length[2]',
            'price'          => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image'          => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $image = $this->request->getFile('image');
        $imageName = $product['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products', $imageName);
        }

        $model->update($id, [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $imageName
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted!');
    }
}