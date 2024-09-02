<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AreaModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Config;

class AreaController extends BaseController
{
    protected $areaModel;
    protected $db;
    public function __construct()
    {
        $this->areaModel = new AreaModel();
        $this->db = Config::connect();
    }
    public function viewArea()
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
            'area' => $this->areaModel->findAll(),
        ];
        return view('pages/role_admin/area/area', $data);
    }
    public function detailArea($id)
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
        $allocatedItems = $this->db->table('allocations')
            ->select('allocations.id AS allocation_id, allocations.quantity, allocations.allocation_date, products.product_name, categories.category_name')
            ->join('product_stocks', 'allocations.id_product_stock = product_stocks.id')
            ->join('products', 'product_stocks.id_product = products.id')
            ->join('categories', 'products.id_category = categories.id')
            ->where('allocations.id_area', $id)
            ->get()
            ->getResultArray();
        $data = [
            'currentDate' => $currentDate,
            'area' => $this->areaModel->find($id),
            'allocatedItems' => $allocatedItems
        ];
        return view('pages/role_admin/area/detail_area', $data);
    }
    public function addArea()
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
            'currentDate' => $currentDate
        ];
        return view('pages/role_admin/area/add_area', $data);
    }
    public function saveArea()
    {
        $areaName = $this->request->getVar('area_name');
        $rules = [
            'area_name' => 'required',
            'area_description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'area_name' => $this->request->getVar('area_name'),
            'area_description' => $this->request->getVar('area_description'),
            'created_at' => Time::now(),
        ];
        log_message('debug', 'Data to be saved: ' . print_r($data, true));
        try {
            $this->areaModel->save($data);
            session()->setFlashdata('success', "Area <strong style='color: darkgreen;'>{$areaName}</strong> berhasil ditambahkan!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat menyimpan area: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan area.');
        }
        return redirect()->to('/admin/area');
    }
    public function editArea($id)
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
            'area' => $this->areaModel->find($id),
        ];
        return view('pages/role_admin/area/edit_area', $data);
    }
    public function updateArea($id)
    {
        $rules = [
            'area_name' => 'required',
            'area_description' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $data = [
            'area_name' => $this->request->getVar('area_name'),
            'area_description' => $this->request->getVar('area_description'),
            'updated_at' => Time::now(),
        ];
        try {
            $this->areaModel->update($id, $data);
            session()->setFlashdata('success', "Data berhasil diubah!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat mengupdate area: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate area.');
        }
        return redirect()->to('/admin/area');
    }
    public function deleteArea($id)
    {
        $area = $this->areaModel->find($id);
        $areaName = $area['area_name'];
        try {
            $this->areaModel->delete($id);
            session()->setFlashdata('success', "Area <strong style='color: darkgreen;'>{$areaName}</strong> berhasil dihapus!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat menghapus area: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus area.');
        }
        return redirect()->to('/admin/area');
    }
}
