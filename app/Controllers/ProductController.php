<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StatusModel;
use Config\Database;

class ProductController extends ResourceController
{
    // properti untuk menyimpan instance dari model CategoryModel dan ProductModel.
    protected $kategoriModel;
    protected $productModel;
    protected $statusModel;
    protected $db;
    // Method yang akan otomatis dijalankan ketika sebuah instance dari controller ini dibuat.
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->kategoriModel = new CategoryModel();
        $this->statusModel = new StatusModel();
        $this->db = Database::connect(); // Inisialisasi koneksi database

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
    public function getImage($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($path)) {
            return $this->response->download($path, null, true);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException($filename . ' not found');
    }
    // Method addProduct ini akan menampilkan halaman tambah produk
    public function addProduct()
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
            'categories' => $this->kategoriModel->findAll(),
            'status' => $this->statusModel->findAll()
        ];
        // $categories = $this->kategoriModel->findAll();
        // $status = $this->statusModel->findAll();
        // $products = $this->productModel->getProducts();

        return view('pages/product/add_product', $data);
    }
    public function saveProduct()
    {
        $productName = $this->request->getVar('product_name');
        $rules = [
            'product_name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal',
            'product_image' => [
                'rules' => 'uploaded[product_image]|max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Product Image'
            ],
            'id_category' => 'required',
            'id_status' => 'required',
            'stock' => 'required|integer',
        ];

        // Add validation for damage_description if id_status is 2
        if ($this->request->getVar('id_status') == 2) {
            $rules['damage_description'] = 'required|string';
        }

        // Validate the input data
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Get id_status from the form
        $id_status = (int)$this->request->getVar('id_status');
        // Check if id_status exists in the status table
        $statusExists = $this->db->table('status')->where('id', $id_status)->countAllResults();

        if ($statusExists === 0) {
            log_message('error', 'Invalid id_status: ' . $id_status);
            return redirect()->back()->with('error', 'Status tidak valid.');
        }
        // Process the image upload
        $image = $this->request->getFile('product_image');
        $imageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads', $imageName);
        // Prepare the data for saving
        $data = [
            'product_name' => $this->request->getVar('product_name'),
            'brand_name' => $this->request->getVar('brand_name'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'product_image' => $imageName,
            'id_category' => $this->request->getVar('id_category'),
            'id_status' => $id_status,
            'damage_description' => $this->request->getVar('damage_description'),
            'stock' => $this->request->getVar('stock'),
        ];
        // Log the data for debugging
        log_message('debug', 'Data to be saved: ' . print_r($data, true));
        // Save the data to the database
        try {
            $this->productModel->save($data);
        } catch (\Exception $e) {
            log_message('error', 'Error saat menyimpan produk: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan produk.');
        }
        session()->setFlashdata('success', "Kategori <strong style='color: darkgreen;'>{$productName}</strong> berhasil ditambahkan!");

        return redirect()->to('/product');
    }



    public function viewProduct($id)
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
        $product = $this->productModel->find($id);

        if (!$product) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan.");
        }
        // Parsing waktu yang dibuat ke dalam format Time
        $createdTime = \CodeIgniter\I18n\Time::parse($product['created_at']);
        $now = \CodeIgniter\I18n\Time::now();

        // Menghitung selisih waktu
        $difference = $createdTime->difference($now);
        $since = $createdTime->humanize();

        // Konversi manual untuk mendapatkan perbedaan dalam bahasa Indonesia
        if ($difference->getYears() > 0) {
            $since = $difference->getYears() . ' tahun yang lalu';
        } elseif ($difference->getMonths() > 0) {
            $since = $difference->getMonths() . ' bulan yang lalu';
        } elseif ($difference->getWeeks() > 0) {
            $since = $difference->getWeeks() . ' minggu yang lalu';
        } elseif ($difference->getDays() > 0) {
            $since = $difference->getDays() . ' hari yang lalu';
        } elseif ($difference->getHours() > 0) {
            $since = $difference->getHours() . ' jam yang lalu';
        } elseif ($difference->getMinutes() > 0) {
            $since = $difference->getMinutes() . ' menit yang lalu';
        } else {
            $since = 'Beberapa detik yang lalu';
        }

        return view('pages/product/detail_product', [
            'currentDate' => $currentDate,
            'product' => $product,
            'since' => $since,
        ]);
    }
    public function editProduct($id)
    {
        $productID = $this->productModel->find($id);
        $status = $this->statusModel->findAll();
        return view('pages/product/edit_product', [
            'categories' => $this->kategoriModel->findAll(),
            'product' => $productID,
            'status' => $status
        ]);
    }

    public function updateProduct($id)
    {
        $product = $this->productModel->find($id);

        // Validasi input
        $rules = [
            'product_name' => 'required',
            'brand_name' => 'required',
            'description' => 'required',
            'price' => 'required|decimal',
            'id_category' => 'required',
            'stock' => 'required|integer',
            'product_image' => [
                'rules' => 'max_size[product_image,1024]|is_image[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Product Image'
            ]
        ];

        // Tambahkan validasi untuk damage_description jika id_status adalah 2
        $id_status = (int)$this->request->getVar('id_status');
        if ($id_status === 2) {
            $rules['damage_description'] = 'required|string';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Proses gambar
        $image = $this->request->getFile('product_image');
        if ($image && $image->isValid()) {
            // Hapus gambar lama jika ada gambar baru yang diunggah
            if (!empty($product['product_image']) && file_exists(WRITEPATH . 'uploads/' . $product['product_image'])) {
                unlink(WRITEPATH . 'uploads/' . $product['product_image']);
            }
            // Simpan gambar baru
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $imageName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imageName = $product['product_image'];
        }

        // Perbarui data produk
        try {
            $this->productModel->update($id, [
                'product_name' => $this->request->getVar('product_name'),
                'brand_name' => $this->request->getVar('brand_name'),
                'description' => $this->request->getVar('description'),
                'price' => $this->request->getVar('price'),
                'id_category' => $this->request->getVar('id_category'),
                'id_status' => $id_status, // Pastikan id_status juga diperbarui
                'damage_description' => $id_status === 2 ? $this->request->getVar('damage_description') : null, // Set ke null jika tidak diperlukan
                'stock' => $this->request->getVar('stock'),
                'product_image' => $imageName
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error saat memperbarui produk: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk.');
        }

        return redirect()->to('/product');
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

        return redirect()->to('/product');
    }
}
