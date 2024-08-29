<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StatusModel;
use App\Models\BrandModel;
use App\Models\ProductStockModel;
use Config\Database;
use \CodeIgniter\I18n\Time;

class ProductController extends ResourceController
{
    protected $kategoriModel;
    protected $productModel;
    protected $statusModel;
    protected $brandModel;
    protected $product_stocksModel;
    protected $db;
    // Method yang akan otomatis dijalankan ketika sebuah instance dari controller ini dibuat.
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->kategoriModel = new CategoryModel();
        $this->statusModel = new StatusModel();
        $this->brandModel = new BrandModel();
        $this->product_stocksModel = new ProductStockModel();
        $this->db = Database::connect(); // Inisialisasi koneksi database

    }
    public function viewProduct()
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
        $data = [
            'currentDate' => $currentDate,
            'products' => $products,
        ];
        return view('pages/role_admin/product/product', $data);
    }

    public function getImage($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;
        if (file_exists($path)) {
            $mimeType = mime_content_type($path);
            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setHeader('Content-Disposition', 'inline')
                ->setBody(file_get_contents($path));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException($filename . ' not found');
    }
    // Method addProduct ini akan menampilkan halaman tambah produk
    public function addProduct()
    {
        $locale = 'id_ID';
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $tanggal = new \DateTime();
        $currentDate = $formatter->format($tanggal); // Format tanggal

        $data = [
            'currentDate' => $currentDate,
            'categories' => $this->kategoriModel->findAll(),
            'brands' => $this->brandModel->findAll(),
        ];
        return view('pages/role_admin/product/add_product', $data);
    }
    public function saveProduct()
    {
        $productName = $this->request->getVar('product_name');
        $rules = [
            'product_name' => 'required',
            'id_brand' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|decimal',
            'product_image' => [
                'rules' => 'uploaded[product_image]|max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Product Image'
            ],
            'product_placement' => 'required',
            'id_category' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Process the image upload
        $image = $this->request->getFile('product_image');
        $imageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads', $imageName);
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'id_brand' => $this->request->getVar('id_brand'),
            'product_description' => $this->request->getVar('product_description'),
            'product_price' => $this->request->getVar('product_price'),
            'product_image' => $imageName,
            'product_placement' => $this->request->getVar('product_placement'),
            'id_category' => $this->request->getVar('id_category'),
            'created_at' => Time::now(),
            // 'damage_description' => $this->request->getVar('damage_description'),
            // 'stock' => $this->request->getVar('stock'),
        ];
        log_message('debug', 'Data to be saved: ' . print_r($data, true));
        try {
            $this->productModel->save($data);
            session()->setFlashdata('success', "Kategori <strong style='color: darkgreen;'>{$productName}</strong> berhasil ditambahkan!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat menyimpan produk: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
        return redirect()->to('/admin/product');
    }

    public function createProductStock()
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
            'status' => $this->statusModel->findAll(),
            'products' => $this->productModel->findAll(),
        ];
        return view('pages/role_admin/product/create_product_stock', $data);
    }
    public function saveProductStock()
    {
        $rules = [
            'id_product' => 'required',
            'quantity.*' => 'required|decimal',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $idProduct = $this->request->getVar('id_product');
        $quantities = $this->request->getVar('quantity');
        $damageDescriptions = $this->request->getVar('damage_description');
        $createdAt = Time::now();
        foreach ($quantities as $statusId => $quantity) {
            $data = [
                'id_product' => $idProduct,
                'id_status' => $statusId,
                'quantity' => $quantity,
                'damage_description' => $damageDescriptions[$statusId] ?? null,  // Deskripsi kerusakan hanya untuk status tertentu
                'created_at' => $createdAt,
            ];
            log_message('debug', 'Data to be saved: ' . print_r($data, true));

            try {
                $this->product_stocksModel->save($data);
            } catch (\Exception $e) {
                log_message('error', 'Error saat menyimpan stok produk: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan stok.');
            }
        }
        session()->setFlashdata('success', "Stok berhasil ditambahkan!");
        return redirect()->to('/admin/product');
    }
    public function detailProduct($id)
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
        $product = $this->productModel->getProductWithCategoryAndBrand($id);
        $stockDetails = $this->product_stocksModel->getProductWithStockDetailes($id);
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan.");
        }
        $product['total_stock'] = $stockDetails['total_stock'] ?? 0;
        $product['good_stock'] = $stockDetails['good_stock'] ?? 0;
        $product['partial_damage_stock'] = $stockDetails['partial_damage_stock'] ?? 0;
        $product['damaged_stock'] = $stockDetails['damaged_stock'] ?? 0;
        $product['partial_damage_descriptions'] = $stockDetails['partial_damage_descriptions'] ?? '';

        $createdTime = Time::parse($product['created_at']);
        $now = Time::now();
        $differenceCreate = $createdTime->difference($now);
        $sinceUpdate = '-';
        if (!is_null($product['updated_at'])) {
            $updatedTime = Time::parse($product['updated_at']);
            $differenceUpdate = $updatedTime->difference($now);
            $sinceUpdate = $this->formatDifference($differenceUpdate);
        }
        $sinceCreate = $this->formatDifference($differenceCreate);

        $data = [
            'currentDate' => $currentDate,
            'product' => $product,
            'sinceCreate' => $sinceCreate,
            'sinceUpdate' => $sinceUpdate,
            'partialDamageDescriptions' => $product['partial_damage_descriptions']

        ];

        return view('pages/role_admin/product/detail_product', $data);
    }
    public function showEditProductStockForm($id)
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
        $product = $this->productModel->getProductWithCategoryAndBrand($id);
        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan.");
        }
        $productStocks = $this->product_stocksModel
            ->select('product_stocks.*, status.status_name')
            ->join('status', 'product_stocks.id_status = status.id')
            ->where('product_stocks.id_product', $id)
            ->findAll();
        $data = [
            'currentDate' => $currentDate,
            'product'       => $product,
            'productStocks' => $productStocks,
        ];

        return view('pages/role_admin/product/update_product_stock', $data);
    }
    public function updateProductStock($id)
    {

        $stocks = $this->request->getPost('stocks');
        if (!$stocks) {
            return redirect()->back()->with('error', 'Tidak ada data stok yang diterima.');
        }
        foreach ($stocks as $statusId => $stockData) {
            $dataToUpdate = [
                'quantity' => $stockData['quantity'],
                'damage_description' => $stockData['damage_description'] ?? null,
                'updated_at' => Time::now(),
            ];
            $this->product_stocksModel->update($stockData['id'], $dataToUpdate);
        }
        return redirect()->to('admin/product')->with('success', 'Stok produk berhasil diperbarui.');
    }


    private function formatDifference($difference)
    {
        if ($difference->getYears() > 0) {
            return $difference->getYears() . ' tahun yang lalu';
        } elseif ($difference->getMonths() > 0) {
            return $difference->getMonths() . ' bulan yang lalu';
        } elseif ($difference->getWeeks() > 0) {
            return $difference->getWeeks() . ' minggu yang lalu';
        } elseif ($difference->getDays() > 0) {
            return $difference->getDays() . ' hari yang lalu';
        } elseif ($difference->getHours() > 0) {
            return $difference->getHours() . ' jam yang lalu';
        } elseif ($difference->getMinutes() > 0) {
            return $difference->getMinutes() . ' menit yang lalu';
        } else {
            return 'Beberapa detik yang lalu';
        }
    }
    public function editProduct($id)
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
            'categories' => $this->kategoriModel->findAll(),
            'brands' => $this->brandModel->findAll(),
            'currentDate' => $currentDate,
            'product' => $this->productModel->find($id),
            'status' => $this->statusModel->findAll(),
        ];
        return view('pages/role_admin/product/edit_product', $data);
    }

    public function updateProduct($id)
    {
        $product = $this->productModel->find($id);
        $rules = [
            'product_name' => 'required',
            'id_brand' => 'required',
            'product_description' => 'required',
            'product_price' => 'required|decimal',
            'id_category' => 'required',
            'product_image' => [
                'rules' => 'max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Product Image'
            ],
            'product_placement' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $image = $this->request->getFile('product_image');
        if ($image && $image->isValid()) {
            if (!empty($product['product_image']) && file_exists(WRITEPATH . 'uploads/' . $product['product_image'])) {
                unlink(WRITEPATH . 'uploads/' . $product['product_image']);
            }
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $imageName);
        } else {
            $imageName = $product['product_image'];
        }
        try {
            $this->productModel->update($id, [
                'product_name' => $this->request->getVar('product_name'),
                'id_brand' => $this->request->getVar('id_brand'),
                'product_description' => $this->request->getVar('product_description'),
                'product_price' => $this->request->getVar('product_price'),
                'id_category' => $this->request->getVar('id_category'),
                'product_image' => $imageName,
                'product_placement' => $this->request->getVar('product_placement'),
            ]);
            session()->setFlashdata('success', "Data berhasil diubah!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat memperbarui produk: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk.');
        }

        return redirect()->to('admin/product');
    }
    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            $productName = $product['product_name'];
            $this->productModel->delete($id);
            session()->setFlashdata('success', "Produk <strong style='color: darkgreen;'>{$productName}</strong> berhasil dihapus!");
        } else {
            session()->setFlashdata('error', "Produk tidak ditemukan.");
        }
        return redirect()->to('/admin/product');
    }
}
