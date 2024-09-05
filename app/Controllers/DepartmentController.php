<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Config;

class DepartmentController extends BaseController
{
    protected $departemenModel;
    protected $db;
    public function __construct()
    {
        $this->departemenModel = new DepartmentModel();
        $this->db = Config::connect();
    }
    public function viewDepartment()
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
        return view('pages/role_admin/department/department', $data);
    }
    public function detailDepartment($id)
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
        $employeesByDepartment = $this->db->table('employees')
            ->select('employees.id AS employee_id, employees.*, departments.department_name')
            ->join('departments', 'employees.id_department = departments.id')
            ->where('employees.id_department', $id)
            ->get()
            ->getResultArray();
        $data = [
            'currentDate' => $currentDate,
            'department' => $this->departemenModel->find($id),
            'employeesByDepartment' => $employeesByDepartment
        ];
        return view('pages/role_admin/department/detail_department', $data);
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

        return view('pages/role_admin/department/add_department', $data);
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
        return redirect()->to('/admin/department');
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
        return view('pages/role_admin/department/edit_department', $data);
    }

    public function updateDepartment($id)
    {
        $this->departemenModel->update($id, [
            'department_name' => $this->request->getVar('department_name'),
            'department_description' => $this->request->getVar('department_description'),
            'updated_at' => Time::now(),
        ]);
        session()->setFlashdata('success', "Data berhasil diubah!");
        return redirect()->to('/admin/department');
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
        return redirect()->to('/admin/department');
    }
}
