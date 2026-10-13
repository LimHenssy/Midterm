<?php
namespace App\Controllers;

use App\Models\SaleModel;
use App\Models\ProductModel;
use App\Models\CustomerModel;

class SaleController extends BaseController
{
    public function index()
    {
        $saleModel = new SaleModel();
        $data['sales'] = $saleModel->getSalesWithDetails();
        return view('sales/index', $data);
    }

    public function create()
    {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $data['products'] = $productModel->where('stock_quantity >', 0)->findAll();
        $data['customers'] = $customerModel->findAll();

        return view('sales/create', $data);
    }

    public function store()
    {
        $rules = [
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|greater_than[0]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $productId = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity = (int)$this->request->getPost('quantity');

        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        // Validation Requirement: Check stock quantity
        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()->withInput()->with('error', "Transaction Rejected! Requested quantity ({$quantity}) exceeds available stock ({$product['stock_quantity']}).");
        }

        $totalPrice = $product['price'] * $quantity;

        // Save Transaction
        $saleModel = new SaleModel();
        $saleModel->save([
            'product_id'  => $productId,
            'customer_id' => $customerId,
            'sold_by'     => session()->get('user_id'),
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // Stock reduction requirement
        $newStock = $product['stock_quantity'] - $quantity;
        $productModel->update($productId, ['stock_quantity' => $newStock]);

        return redirect()->to('/sales')->with('success', 'Sale recorded successfully!');
    }
}