<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BrandModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Config;

class BrandController extends BaseController
{
    protected $brandModel;
    protected $db;

    public function __construct()
    {
        $this->brandModel = new BrandModel();
        $this->db = Config::connect();
    }

    public function viewBrand()
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
            'brand' => $this->brandModel->findAll(),
        ];
        return view('pages/role_admin/brand/brand', $data);
    }
    public function detailBrand($id)
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
        $allocatedItems = $this->db->table('products')
            ->select('products.id AS product_id, products.*, categories.category_name, brands.brand_name')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->where('products.id_brand', $id)
            ->get()
            ->getResultArray();
        $data = [
            'currentDate' => $currentDate,
            'brand' => $this->brandModel->find($id),
            'allocatedItems' => $allocatedItems
        ];
        return view('pages/role_admin/brand/detail_brand', $data);
    }
    public function addBrand()
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
        return view('pages/role_admin/brand/add_brand', $data);
    }
    // Method saveCategory ini akan menyimpan data category baru
    public function saveBrand()
    {
        $brandName = $this->request->getVar('brand_name');
        $rules = [
            'brand_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'brand_name' => $this->request->getVar('brand_name'),
            'created_at' => Time::now(),
        ];
        try {
            $this->brandModel->save($data);
            session()->setFlashdata('success', "Brand <strong style='color: darkgreen;'>{$brandName}</strong> berhasil ditambahkan!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        return redirect()->to('/admin/brand');
    }
    public function editBrand($id)
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
            'brand' =>  $this->brandModel->find($id),

        ];
        return view('pages/role_admin/brand/edit_brand', $data);
    }
    public function updateBrand($id)
    {
        $rules = [
            'brand_name' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'brand_name' => $this->request->getVar('brand_name'),
            'updated_at' => Time::now(),
        ];
        try {
            $this->brandModel->update($id, $data);
            session()->setFlashdata('success', "Data berhasil diubah!");
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        return redirect()->to('/admin/brand');
    }

    public function deleteBrand($id)
    {
        $brand = $this->brandModel->find($id);
        if ($brand) {
            $brandName = $brand['brand_name'];
            $this->brandModel->delete($id);
            session()->setFlashdata('success', "Brand <strong style='color: darkgreen;'>{$brandName}</strong> berhasil dihapus!");
        } else {
            session()->setFlashdata('error', "Brand tidak ditemukan.");
        }
        return redirect()->to('/admin/brand');
    }
}
