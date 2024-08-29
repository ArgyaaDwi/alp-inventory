<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StatusModel;
use App\Models\AreaModel;
use App\Models\EmployeeModel;
use App\Models\BrandModel;
use App\Models\ProductStockModel;

class TransactionController extends BaseController
{
    protected $kategoriModel;
    protected $productModel;
    protected $statusModel;
    protected $brandModel;
    protected $employeeModel;
    protected $product_stocksModel;
    protected $areaModel;
    protected $db;
    // Method yang akan otomatis dijalankan ketika sebuah instance dari controller ini dibuat.
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->kategoriModel = new CategoryModel();
        $this->statusModel = new StatusModel();
        $this->brandModel = new BrandModel();
        $this->product_stocksModel = new ProductStockModel();
        $this->employeeModel = new EmployeeModel();
        $this->areaModel = new AreaModel();
    }

    public function loanProduct()
    {
        $locale = 'id_ID';
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $tanggal = new \DateTime();
        $currentDate = $formatter->format($tanggal);
        $products = $this->productModel->getProducts();
        foreach ($products as &$product) {
            $product['stock_details'] = $this->product_stocksModel->getProductWithStockDetails($product['id']);
        }

        $products = $this->productModel->findAll();
        $employees = $this->employeeModel->findAll();
        $statuses = $this->statusModel->findAll();
        $area = $this->areaModel->findAll();

        if ($this->request->getMethod() === 'post') {
            $productId = $this->request->getPost('id_product');
            $employeeId = $this->request->getPost('id_employee');
            $quantity = $this->request->getPost('quantity');
            $statusBeforeLoan = $this->request->getPost('status_before_loan');

            // Check stock availability in product_stocks
            $availableStock = $this->product_stocksModel->where('id_product', $productId)
                ->where('id_status', $statusBeforeLoan)
                ->first();
            if ($availableStock && $availableStock['quantity'] >= $quantity) {
                // Reduce stock in product_stocks
                $this->product_stocksModel->update($availableStock['id'], [
                    'quantity' => $availableStock['quantity'] - $quantity,
                ]);

                // Create loan entry in product_loans
                $this->product_stocksModel->insert([
                    'id_product' => $productId,
                    'id_employee' => $employeeId,
                    'quantity' => $quantity,
                    'status_before_loan' => $statusBeforeLoan,
                    'loan_date' => date('Y-m-d H:i:s'),
                ]);

                return redirect()->to('/loans')->with('message', 'Produk berhasil dipinjamkan.');
            } else {
                return redirect()->back()->with('error', 'Stok tidak mencukupi.');
            }
        }

        return view('pages/role_admin/transaction/transaction', [
            'products' => $products,
            'employees' => $employees,
            'statuses' => $statuses,
            'area' => $area,
            'currentDate' => $currentDate
        ]);
    }
    public function getStockDetails($productId)
    {
        // Mengambil rincian stok produk dari model
        $stockDetails = $this->product_stocksModel->where('id_product', $productId)->findAll();

        if (!empty($stockDetails)) {
            $output = '<ul>';
            foreach ($stockDetails as $stock) {
                $statusName = $this->statusModel->find($stock['id_status'])['status_name'];
                $damageDescription = esc($stock['damage_description']) ? ' (Kerusakan: ' . esc($stock['damage_description']) . ')' : '';
                $output .= '<li>' . esc($statusName) . ': ' . esc($stock['quantity']) . $damageDescription . '</li>';
            }
            $output .= '</ul>';
        } else {
            $output = 'Tidak ada rincian stok untuk produk ini.';
        }

        return $output;
    }
}
