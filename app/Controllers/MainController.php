<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\AreaModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\I18n\Time;

class MainController extends ResourceController
{
    protected $employeeModel;
    protected $kategoriModel;
    protected $productModel;
    protected $areaModel;
    protected $departmentModel;
    public function __construct()
    {
        $this->kategoriModel = new CategoryModel();
        $this->productModel = new ProductModel();
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->areaModel = new AreaModel();
    }

    public function dashboardAdmin()
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
            'categoryCount' => $this->kategoriModel->countAllResults(),
            'productCount' => $this->productModel->countAllResults(),
            'employeeCount' => $this->employeeModel->countAllResults(),
            'areaCount' => $this->areaModel->countAllResults(),
            // 'productCount' => $this->productModel->countAllResults()
        ];

        return view('pages/role_admin/dashboard', $data);
    }
    public function userPage()
    {
        return view('pages/role_user/dashboard');
    }

    public function viewProfile()
    {
        $locale = 'id_ID';
        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::FULL,
            \IntlDateFormatter::NONE,
            'Asia/Jakarta'
        );
        $currentDate = $formatter->format(new \DateTime());
        $userId = session()->get('employee_id');
        $user = $this->employeeModel->getEmployeeWithDepartment($userId);

        $createdTime = null;
        $sinceCreate = '-';
        $sinceUpdate = '-';
        if ($user) {
            if (!is_null($user['created_at'])) {
                $createdTime = Time::parse($user['created_at']);
                $now = Time::now();
                $differenceCreate = $createdTime->difference($now);
                $sinceCreate = $this->formatDifference($differenceCreate);
            }
            if (!is_null($user['updated_at'])) {
                $updatedTime = Time::parse($user['updated_at']);
                $differenceUpdate = $updatedTime->difference($now);
                $sinceUpdate = $this->formatDifference($differenceUpdate);
            }
        } else {
            $user = [
                'id' => '',
                'employee_name' => 'Data tidak tersedia',
                'created_at' => '',
                'updated_at' => '',
            ];
        }

        $data = [
            'user' => $user,
            'currentDate' => $currentDate,
            'sinceCreate' => $sinceCreate,
            'sinceUpdate' => $sinceUpdate
        ];
        return view('pages/role_admin/profile/profile', $data);
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

    public function editProfile()
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
        $userId = session()->get('employee_id');
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($userId);
        if (!$employee) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("User with ID $userId not found");
        }
        $data = [
            'currentDate' => $currentDate,
            'employee' => $employee,
            'departments' => $this->departmentModel->findAll(),
        ];
        return view('pages/role_admin/profile/edit', $data);
    }
    public function updateProfile()
    {
        $userId = session()->get('employee_id');
        $rules = [
            'employee_badge' => 'required|decimal',
            'employee_name' => 'required',
            'employee_address' => 'required',
            'employee_position' => 'required',
            'employee_email' => 'required',
            'employee_phone' => 'required',
            'employee_image' => [
                'rules' => 'max_size[employee_image,1024]|is_image[employee_image]|mime_in[employee_image,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar'
            ],
            'id_department' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $employee = $this->employeeModel->find($userId);
        $image = $this->request->getFile('employee_image');
        if ($image && $image->isValid()) {
            if (!empty($employee['employee_image']) && file_exists(WRITEPATH . 'uploads/' . $employee['employee_image'])) {
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
        ];
        try {
            $this->employeeModel->update($userId, $data);
            $updatedEmployee = $this->employeeModel->find($userId);
            session()->set([
                'employee_badge' => $updatedEmployee['employee_badge'],
                'employee_name' => $updatedEmployee['employee_name'],
                'employee_address' => $updatedEmployee['employee_address'],
                'employee_position' => $updatedEmployee['employee_position'],
                'employee_email' => $updatedEmployee['employee_email'],
                'employee_phone' => $updatedEmployee['employee_phone'],
                'employee_image' => $updatedEmployee['employee_image'],
                'id_department' => $updatedEmployee['id_department'],
                'updated_at' => $updatedEmployee['updated_at'],
            ]);

            session()->setFlashdata('success', 'Profil berhasil diperbarui');
        } catch (\Exception $e) {
            session()->setFlashdata('errors', 'Terjadi kesalahan saat memperbarui profil');
        }

        return redirect()->to('/admin/profile');
    }
    public function getImage($filename)
    {
        $path = WRITEPATH . 'uploads/' . $filename;

        if (file_exists($path)) {
            $mimeType = mime_content_type($path);
            return $this->response
                ->setHeader('Content-Type', $mimeType)
                ->setHeader('Content-Disposition', 'inline')
                ->setBody(file_get_contents($path));
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException($filename . ' not found');
    }
}
