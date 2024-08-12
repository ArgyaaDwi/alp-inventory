<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends ResourceController
{
    // properti untuk menyimpan instance dari model CategoryModel dan ProductModel.
    protected $kategoriModel;
    protected $productModel;

    // Method yang akan otomatis dijalankan ketika sebuah instance dari controller ini dibuat.
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->kategoriModel = new CategoryModel();
    }
    // Method index ini akan menampilkan semua data product dari database.
    public function index()
    {
        $locale = 'id_ID'; // Locale Bahasa Indonesia
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
            'products' => $this->productModel->getProducts()
        ];
        // $products = $this->productModel->getProducts();
        return view('pages/product', $data);
    }

    // Method addProduct ini akan menampilkan halaman tambah produk
    public function addProduct()
    {
        $categories = $this->kategoriModel->findAll();

        // $products = $this->productModel->getProducts();

        return view('pages/product/add_product', [
            'categories' => $categories
        ]);
    }

    public function saveProduct()
    {
        if (!$this->validate([
            'product_name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal',
            'id_category' => 'required',
            'stock' => 'required|integer',
            'product_image' => [
                'rules' => 'uploaded[product_image]|max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Product Image'
            ]
        ])) {
            dd($this->validator->getErrors()); // Debugging validasi

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Proses upload gambar
        $image = $this->request->getFile('product_image');
        $imageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads', $imageName);
        // Simpan data produk ke database
        $this->productModel->save([
            'product_name' => $this->request->getPost('product_name'),
            'brand_name' => $this->request->getPost('brand_name'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'id_category' => $this->request->getPost('id_category'),
            'stock' => $this->request->getPost('stock'),
            'product_image' => $imageName
        ]);
        return redirect()->to('/product');
    }
}
