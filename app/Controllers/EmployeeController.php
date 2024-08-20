<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
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
            'employee' => $this->employeeModel->findAll(),
        ];
        return view('pages/employees/employee', $data);
    }
    public function viewEmployee($id)
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
            'employee' => $this->employeeModel->find($id),
        ];
        return view('pages/employees/detail_employee', $data);
    }
}
