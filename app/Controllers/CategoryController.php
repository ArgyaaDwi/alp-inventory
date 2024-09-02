<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\CategoryModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Config;

class CategoryController extends ResourceController
{
    protected $kategoriModel;
    protected $db;

    public function __construct()
    {
        $this->kategoriModel = new CategoryModel();
        $this->db = Config::connect();
    }

    public function viewCategory()
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


        return view('pages/role_admin/category/category', $data);
    }
    public function detailCategory($id)
    {
        $this->db = Config::connect();

        $locale = 'id_ID';
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $tanggal = new \DateTime();
        $currentDate = $formatter->format($tanggal);
        $allocatedItems = $this->db->table('products')
            ->select('products.id AS product_id, products.*, categories.category_name, brands.brand_name')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->where('products.id_category', $id)
            ->get()
            ->getResultArray();
        $data = [
            'currentDate' => $currentDate,
            'category' => $this->kategoriModel->find($id),
            'allocatedItems' => $allocatedItems
        ];
        return view('pages/role_admin/category/detail_category', $data);
    }
    public function addCategory()
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
        ];
        return view('pages/role_admin/category/add_category', $data);
    }
    // Method saveCategory ini akan menyimpan data category baru
    public function saveCategory()
    {
        $categoryName = $this->request->getVar('category_name');
        $rules = [
            'category_name' => 'required',
            'category_description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'category_name' => $this->request->getVar('category_name'),
            'category_description' => $this->request->getVar('category_description'),
            'created_at' => Time::now(),
        ];
        try {
            $this->kategoriModel->save($data);
            session()->setFlashdata('success', "Kategori <strong style='color: darkgreen;'>{$categoryName}</strong> berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        return redirect()->to('/admin/category');
    }
    public function editCategory($id)
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
            'category' =>  $this->kategoriModel->find($id),

        ];
        return view('pages/role_admin/category/edit_category', $data);
    }
    public function updateCategory($id)
    {
        $rules = [
            'category_name' => 'required',
            'category_description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'category_name' => $this->request->getVar('category_name'),
            'category_description' => $this->request->getVar('category_description'),
            'updated_at' => Time::now(),
        ];
        try {
            $this->kategoriModel->update($id, $data);
            session()->setFlashdata('success', "Data berhasil diubah!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        return redirect()->to('/admin/category');
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
        return redirect()->to('/admin/category');
    }
}
