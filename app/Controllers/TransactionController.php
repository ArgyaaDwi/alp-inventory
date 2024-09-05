<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StatusModel;
use App\Models\AllocationModel;
use App\Models\AreaModel;
use App\Models\EmployeeModel;
use App\Models\BrandModel;
use App\Models\ProductStockModel;
use Dompdf\Dompdf;

class TransactionController extends BaseController
{
    protected $kategoriModel;
    protected $productModel;
    protected $statusModel;
    protected $brandModel;
    protected $employeeModel;
    protected $product_stocksModel;
    protected $areaModel;
    protected $allocationModel;
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
        $this->allocationModel = new AllocationModel();
    }

    // public function viewAllocation()
    // {

    //     $locale = 'id_ID';
    //     $formatter = new \IntlDateFormatter(
    //         $locale,
    //         \IntlDateFormatter::FULL,
    //         \IntlDateFormatter::NONE,
    //         'Asia/Jakarta'
    //     );
    //     $tanggal = new \DateTime();
    //     $currentDate = $formatter->format($tanggal);

    //     $data = [
    //         'currentDate' => $currentDate,
    //         'allocations' => $this->allocationModel->getAllocations(),
    //     ];
    //     return view('pages/role_admin/transaction/transaction', $data);
    // }
        public function viewAllocation()
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
            // Ambil input filter dari request
            $allocatorId = $this->request->getVar('allocator_id');
            $month = $this->request->getVar('month');
            $year = $this->request->getVar('year');
            // Ambil alokasi dengan filter
            $allocations = $this->allocationModel->getFilteredAllocations($allocatorId, $month, $year);
            // Ambil daftar pengalokasi (anda bisa mengganti getAllocations jika perlu)
            $allocators = $this->allocationModel->getAllAllocators(); // Pastikan metode ini ada jika diperlukan
            $data = [
                'currentDate' => $currentDate,
                'allocations' => $allocations,
                'allocators' => $allocators,
    0        ];

            return view('pages/role_admin/transaction/transaction', $data);
        }


    public function generateAllocationPdf()
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

        $data = [
            'currentDate' => $currentDate,
            'allocations' => $this->allocationModel->getAllocations(),
        ];
        $html = view('pages/role_admin/transaction/transaction_pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("transaction_report_" . date("Y-m-d") . ".pdf", array("Attachment" => 0));
    }

    public function allocateProduct()
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

        $employees = $this->employeeModel->findAll();
        $statuses = $this->statusModel->findAll();
        $area = $this->areaModel->findAll();

        return view('pages/role_admin/transaction/add_transaction', [
            'products' => $products,
            'employees' => $employees,
            'statuses' => $statuses,
            'area' => $area,
            'currentDate' => $currentDate
        ]);
    }
    public function saveAllocation()
    {
        $createdBy = session()->get('employee_id');
        // $emailBy = session()->get('employee_email');

        $productId = $this->request->getPost('id_product_stock');
        $employeeId = $this->request->getPost('id_employee');
        $areaId = $this->request->getPost('id_area');
        $quantity = $this->request->getPost('quantity');
        $loanDate = $this->request->getPost('allocation_date');
        $allocationType = $this->request->getPost('allocation_type');
        $allocationNote = $this->request->getPost('allocation_note');
        if ($allocationType == 'person' && empty($employeeId)) {
            return redirect()->back()->withInput()->with('error', 'Karyawan tidak boleh kosong.');
        } elseif ($allocationType == 'area' && empty($areaId)) {
            return redirect()->back()->withInput()->with('error', 'Area tidak boleh kosong.');
        }
        if (empty($productId) || empty($quantity) || empty($loanDate)) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }
        $statusBagus = 1;
        $availableStock = $this->product_stocksModel->where('id_product', $productId)
            ->where('id_status', $statusBagus)
            ->first();
        if ($availableStock && $availableStock['quantity'] >= $quantity) {
            $this->product_stocksModel->update($availableStock['id'], [
                'quantity' => $availableStock['quantity'] - $quantity,
            ]);
            $data = [
                'id_product_stock' => $availableStock['id'],
                'allocation_type' => $allocationType,
                'id_employee' => ($allocationType === 'person') ? $employeeId : null,
                'id_area' => ($allocationType === 'area') ? $areaId : null,
                'quantity' => $quantity,
                'created_by' => $createdBy,
                'allocation_date' => $loanDate,
                'allocation_note' => $allocationNote,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            // echo 'Data to insert: <br>';
            // print_r($data);
            $this->allocationModel->insert($data);
            session()->setFlashdata('success', "Karyawan <strong style='color: darkgreen;'></strong> berhasil ditambahkan!");
        } else {
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi.');
        }
        return redirect()->to('admin/transaction');
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
    public function deleteAllocation($id)
    {
        $this->allocationModel->delete($id);
        return redirect()->to('admin/transaction');
    }
    public function detailAllocation($id)
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
        $allocationDetails = $this->allocationModel->getAllocationsDetails($id);
        $data = [
            'currentDate' => $currentDate,
            'allocationDetails' => $allocationDetails
        ];
        return view('pages/role_admin/transaction/detail_transaction', $data);
    }
    public function generateDetailAllocationPDF($id)
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
        $allocationDetails = $this->allocationModel->getAllocationsDetails($id);
        $data = [
            'currentDate' => $currentDate,
            'allocationDetails' => $allocationDetails
        ];
        $html = view('pages/role_admin/transaction/detail_transaction_pdf', $data);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("transaction_report_" . date("Y-m-d") . ".pdf", array("Attachment" => 0));
    }
}
