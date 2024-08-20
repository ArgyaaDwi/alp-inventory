<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class DepartmentController extends BaseController
{
    protected $departemenModel;
    public function __construct()
    {
        $this->departemenModel = new DepartmentModel();
    }
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
            'department' => $this->departemenModel->findAll(),
        ];
        return view('pages/department/department', $data);
    }
    public function viewDepartment($id)
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
            'department' => $this->departemenModel->find($id),
        ];

        return view('pages/department/detail_department', $data);
    }

    public function addDepartment()
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

        return view('pages/department/add_department', $data);
    }
    public function saveDepartment()
    {
        $departmenName = $this->request->getVar('department_name');
        $this->departemenModel->save([
            'department_name' => $this->request->getVar('department_name'),
            'department_description' => $this->request->getVar('department_description'),
            'created_at' => Time::now(),
        ]);
        session()->setFlashdata('success', "Departemen <strong style='color: darkgreen;'>{$departmenName}</strong> berhasil ditambahkan!");
        return redirect()->to('/department');
    }

    public function editDepartment($id)
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
            'department' => $this->departemenModel->find($id),
        ];
        return view('pages/department/edit_department', $data);
    }

    public function updateDepartment($id)
    {
        $this->departemenModel->update($id, [
            'department_name' => $this->request->getVar('department_name'),
            'department_description' => $this->request->getVar('department_description'),
            'updated_at' => Time::now(),
        ]);
        session()->setFlashdata('success', "Data berhasil diubah!");
        return redirect()->to('/department');
    }

    public function deleteDepartment($id)
    {


        $department = $this->departemenModel->find($id);
        if ($department) {
            $departmentName = $department['department_name'];
            $this->departemenModel->delete($id);
            session()->setFlashdata('success', "Departemen <strong style='color: darkgreen;'>{$departmentName}</strong> berhasil dihapus!");
        } else {
            session()->setFlashdata('error', "Departemen tidak ditemukan.");
        }

        return redirect()->to('/department');
    }
}
