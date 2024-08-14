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
    public function viewProduct($id)
    {
        $product = $this->productModel->find($id);

        // Parsing waktu yang dibuat ke dalam format Time
        $createdTime = \CodeIgniter\I18n\Time::parse($product['created_at']);
        $now = \CodeIgniter\I18n\Time::now();

        // Menghitung selisih waktu
        $difference = $createdTime->difference($now);

        // Konversi manual
        $since = $createdTime->humanize();

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
            'product' => $product,
            'since' => $since
        ]);
    }


    public function editProduct($id)
    {
        $productID = $this->productModel->find($id);
        return view('pages/product/edit_product', [
            'categories' => $this->kategoriModel->findAll(),
            'product' => $productID
        ]);
    }

    public function updateProduct($id)
    {
        // Data produk lama berdasarkan id
        $product = $this->productModel->find($id);
        // Validasi
        if (!$this->validate([
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
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Proses gambar
        $image = $this->request->getFile('product_image');
        if ($image && !$image->hasMoved()) {
            // Hapus gambar lama jika ada gambar baru yang diunggah
            if (file_exists(WRITEPATH . 'uploads/' . $product['product_image'])) {
                unlink(WRITEPATH . 'uploads/' . $product['product_image']);
            }
            // Simpan gambar baru
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $imageName);
        } else {
            // Jika tidak ada gambar baru, gunakan gambar lama
            $imageName = $product['product_image'];
        }
        // Update data produk
        $this->productModel->update($id, [
            'product_name' => $this->request->getVar('product_name'),
            'brand_name' => $this->request->getVar('brand_name'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'id_category' => $this->request->getVar('id_category'),
            'stock' => $this->request->getVar('stock'),
            'product_image' => $imageName
        ]);

        return redirect()->to('/product');
    }

    public function deleteProduct($id)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            $this->productModel->delete($id);
        }
        return redirect()->to('/product');
    }
}
