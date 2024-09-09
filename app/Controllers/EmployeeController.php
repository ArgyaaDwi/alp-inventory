<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;
use App\Models\AllocationModel;
use App\Models\DepartmentModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Config;

class EmployeeController extends BaseController
{
    protected $employeeModel;
    protected $allocationModel;
    protected $departmentModel;
    protected $db;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->allocationModel = new AllocationModel();
        $this->departmentModel = new DepartmentModel();
        $this->db = Config::connect();
    }
    public function viewEmployee()
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
            'employee' => $this->employeeModel->getEmployees(),
        ];
        return view('pages/role_admin/employees/employee', $data);
    }

    public function detailEmployee($id)
    {
        $this->db = Config::connect();

        $locale = 'id_ID';
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $currentDate = $formatter->format(new \DateTime());
        $employee = $this->employeeModel->getEmployeeWithDepartment($id);
        $allocatedItems = $this->db->table('allocations')
            ->select('allocations.id AS allocation_id, allocations.quantity, allocations.allocation_date, products.product_name, categories.category_name')
            ->join('product_stocks', 'allocations.id_product_stock = product_stocks.id')
            ->join('products', 'product_stocks.id_product = products.id')
            ->join('categories', 'products.id_category = categories.id')
            ->where('allocations.id_employee', $id)
            ->get()
            ->getResultArray();
        $createdTime = null;
        $sinceCreate = '-';
        $sinceUpdate = '-';
        if ($employee) {
            if (!is_null($employee['created_at'])) {
                $createdTime = Time::parse($employee['created_at']);
                $now = Time::now();
                $differenceCreate = $createdTime->difference($now);
                $sinceCreate = $this->formatDifference($differenceCreate);
            }
            if (!is_null($employee['updated_at'])) {
                $updatedTime = Time::parse($employee['updated_at']);
                $differenceUpdate = $updatedTime->difference($now);
                $sinceUpdate = $this->formatDifference($differenceUpdate);
            }
        } else {
            $employee = [
                'id' => '',
                'employee_name' => 'Data tidak tersedia',
                'created_at' => '',
                'updated_at' => '',
            ];
        }
        $data = [
            'currentDate' => $currentDate,
            'employee' => $employee,
            'sinceCreate' => $sinceCreate,
            'sinceUpdate' => $sinceUpdate,
            'allocatedItems' => $allocatedItems,
        ];
        return view('pages/role_admin/employees/detail_employee', $data);
    }

    private function formatDifference($difference)
    {
        if ($difference->getYears() > 0) {
            return $difference->getYears() . ' tahun yang lalu';
        } elseif ($difference->getMonths() > 0) {
            return $difference->getMonths() . ' bulan yang lalu';
        } elseif ($difference->getWeeks() > 0) {
            return $difference->getWeeks() . ' minggu yang lalu';
        } elseif ($difference->getDays() > 0) {
            return $difference->getDays() . ' hari yang lalu';
        } elseif ($difference->getHours() > 0) {
            return $difference->getHours() . ' jam yang lalu';
        } elseif ($difference->getMinutes() > 0) {
            return $difference->getMinutes() . ' menit yang lalu';
        } else {
            return 'Beberapa detik yang lalu';
        }
    }
    public function getImage($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($path)) {
            // Get the MIME type of the file
            $mimeType = mime_content_type($path);

            // Send the file with appropriate headers
            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setHeader('Content-Disposition', 'inline')
                ->setBody(file_get_contents($path));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException($filename . ' not found');
    }

    public function addEmployee()
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
            'departments' => $this->departmentModel->findAll(),
        ];
        return view('pages/role_admin/employees/add_employee', $data);
    }
    public function saveEmployee()
    {
        $employeeName = $this->request->getVar('employee_name');
        $rules = [
            'employee_badge' => 'required|decimal',
            'employee_name' => 'required',
            'employee_address' => 'required',
            'employee_position' => 'required',
            'employee_email' => 'required',
            'employee_phone' => 'required',
            'employee_image' => [
                'rules' => 'uploaded[employee_image]|max_size[employee_image,1024]|is_image[employee_image]|mime_in[employee_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar Karyawan'
            ],
            'id_department' => 'required',
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Validation errors: ' . print_r($errors, true));
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $image = $this->request->getFile('employee_image');
        $imageName = $image->getRandomName();
        $image->move(WRITEPATH . 'uploads/', $imageName);

        $data = [
            'employee_badge' => $this->request->getPost('employee_badge'),
            'employee_name' => $this->request->getPost('employee_name'),
            'employee_address' => $this->request->getPost('employee_address'),
            'employee_position' => $this->request->getPost('employee_position'),
            'employee_email' => $this->request->getPost('employee_email'),
            'employee_phone' => $this->request->getPost('employee_phone'),
            'employee_image' => $imageName,
            'id_department' => $this->request->getPost('id_department'),
            'id_role' => 2,
            'is_active' => 1,
            'created_at' => Time::now(),
        ];

        try {
            $this->employeeModel->save($data);
            session()->setFlashdata('success', "Karyawan <strong style='color: darkgreen;'>{$employeeName}</strong> berhasil ditambahkan!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat menambahkan karyawan: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'Terjadi kesalahan saat menambahkan karyawan');
        }

        return redirect()->to('/admin/employees');
    }
    public function editEmployee($id)
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
            'departments' => $this->departmentModel->findAll(),
        ];
        return view('pages/role_admin/employees/edit_employee', $data);
    }
    public function updateEmployee($id)
    {
        $employee = $this->employeeModel->find($id);
        // $employeeName = $this->request->getPost('employee_name');
        $rules = [
            'employee_badge' => 'required|decimal',
            'employee_name' => 'required',
            'employee_address' => 'required',
            'employee_position' => 'required',
            'employee_email' => 'required',
            'employee_phone' => 'required',
            'employee_image' => [
                'rules' => 'max_size[employee_image,1024]|is_image[employee_image]|mime_in[employee_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar Karyawan'
            ],
            'id_department' => 'required',
            'is_active' => 'required',
        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Validation errors: ' . print_r($errors, true));
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        $image = $this->request->getFile('employee_image');

        if ($image && $image->isValid()) {
            if (!empty($product['employee_image']) && file_exists(WRITEPATH . 'uploads/' . $employee['employee_image'])) {
                unlink(WRITEPATH . 'uploads/' . $employee['employee_image']);
            }
            $imageName = $image->getRandomName();
            $image->move(WRITEPATH . 'uploads', $imageName);
        } else {
            $imageName = $employee['employee_image'];
        }
        $data = [
            'employee_badge' => $this->request->getPost('employee_badge'),
            'employee_name' => $this->request->getPost('employee_name'),
            'employee_address' => $this->request->getPost('employee_address'),
            'employee_position' => $this->request->getPost('employee_position'),
            'employee_email' => $this->request->getPost('employee_email'),
            'employee_phone' => $this->request->getPost('employee_phone'),
            'employee_image' => $imageName,
            'id_department' => $this->request->getPost('id_department'),
            'updated_at' => Time::now(),
            'is_active' => $this->request->getPost('is_active'),
        ];
        try {
            $this->employeeModel->update($id, $data);
            session()->setFlashdata('success', "Data berhasil diubah!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat memperbarui karyawan: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'Terjadi kesalahan saat memperbarui karyawan');
        }

        return redirect()->to('/admin/employees');
    }
    public function statusChanger($id)
    {
        $employee = $this->employeeModel->find($id);

        if ($employee) {
            $newStatus = $employee['is_active'] == 1 ? 0 : 1;
            $statusText = $newStatus == 1 ? '(aktif)' : '(nonaktif)';
            $this->employeeModel->update($id, ['is_active' => $newStatus]);
            session()->setFlashdata('success', "Status karyawan <strong style='color: darkgreen;'>{$employee['employee_name']}</strong> berhasil diubah menjadi <strong style='color: darkgreen;'>{$statusText}</strong>");
            return redirect()->to('/admin/employees');
        }
        session()->setFlashdata('error', 'Karyawan tidak ditemukan.');
        return redirect()->to('/admin/employees');
    }

    public function deleteEmployee($id)
    {
        $employee = $this->employeeModel->find($id);
        if ($employee) {
            $employeeName = $employee['employee_name'];
            $this->employeeModel->delete($id);
            session()->setFlashdata('success', "Karyawan <strong style='color: darkgreen;'>{$employeeName}</strong> berhasil dihapus!");
        } else {
            session()->setFlashdata('error', "Karyawan tidak ditemukan.");
        }
        return redirect()->to('/admin/employees');
    }
}
