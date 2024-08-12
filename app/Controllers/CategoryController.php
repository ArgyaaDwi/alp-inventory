<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;

class CategoryController extends ResourceController
{
    // properti untuk menyimpan instance dari model CategoryModel dan ProductModel.
    protected $kategoriModel;

    // Method yang akan otomatis dijalankan ketika sebuah instance dari controller ini dibuat.

    public function __construct()
    {
        $this->kategoriModel = new CategoryModel();
    }
    // Method index ini akan menampilkan semua data category dari database.

    public function index()
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
            'category' => $this->kategoriModel->findAll(),
        ];
        // $category = $this->kategoriModel->findAll();

        return view('pages/category', $data);
    }
    // Method addProduct ini akan menampilkan halaman tambah category

    public function addCategory()
    {

        return view('pages/category/add_category');
    }
    // Method saveCategory ini akan menyimpan data category baru
    public function saveCategory()
    {

        $categoryName = $this->request->getVar('category_name');
        $this->kategoriModel->save([
            'category_name' => $this->request->getVar('category_name'),

        ]);
        session()->setFlashdata('success', "Kategori <strong style='color: darkgreen;'>{$categoryName}</strong> berhasil ditambahkan!");
        return redirect()->to('/category');
    }
    public function editCategory($id)
    {
        $categoryID =  $this->kategoriModel->find($id);
        return view('pages/category/edit_category', [
            'category' => $categoryID,
        ]);
    }
    public function updateCategory($id)
    {
        $this->kategoriModel->update($id, [
            'category_name' => $this->request->getVar('category_name'),
        ]);

        session()->setFlashdata('success', "Data berhasil diubah!");
        return redirect()->to('/category');
    }

    public function deleteCategory($id)
    {
        $category = $this->kategoriModel->find($id);
        if ($category) {
            $categoryName = $category['category_name'];
            $this->kategoriModel->delete($id);
            session()->setFlashdata('success', "Kategori <strong style='color: darkgreen;'>{$categoryName}</strong> berhasil dihapus!");
        } else {
            session()->setFlashdata('error', "Kategori tidak ditemukan.");
        }

        return redirect()->to('/category');
    }
}
