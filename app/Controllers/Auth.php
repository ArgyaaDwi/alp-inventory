<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;

class Auth extends BaseController
{
    protected $employeeModel;
    public function __construct()
    {
        // parent::__construct();
        $this->employeeModel = new EmployeeModel();
    }
    public function index()
    {
        //
    }
    public function register()
    {
        return view('auth/register');
    }
    public function registerProcess()
    {
        $rules = [
            'employee_name' => 'required',
            'employee_email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Validation errors: ' . print_r($errors, true));
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        $data = [
            'employee_name' => $this->request->getPost('employee_name'),
            'employee_email' => $this->request->getPost('employee_email'),
            'employee_password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'id_role' => 2,
            'is_active' => 1,
            'created_at' => Time::now(),
        ];
        try {
            $this->employeeModel->save($data);
            session()->setFlashdata('success', "Akun <strong>{$data['employee_name']}</strong>! berhasil dibuat\n silahkan login!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat membuat akun: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'Terjadi kesalahan saat membuat akun');
        }
        return redirect()->to('/register');
    }
    public function login()
    {
        if (session()->get('employee_id')) {
            return redirect()->to('/admin');
        }
        return view('auth/login');
    }

    public function loginProcess()
    {
        $rules = [
            'employee_email' => 'required|valid_email',
            'employee_password' => 'required'
        ];
        if (!$this->validate($rules)) {
            $errors = $this->validator->getErrors();
            log_message('error', 'Validation errors: ' . print_r($errors, true));
            return redirect()->back()->withInput()->with('errors', $errors);
        }
        $employee_email = $this->request->getPost('employee_email');
        $password = $this->request->getPost('employee_password');
        $employee = $this->employeeModel->where('employee_email', $employee_email)->first();
        if ($employee && password_verify($password, $employee['employee_password'])) {

            session()->set([
                'employee_id' => $employee['id'],
                'employee_name' => $employee['employee_name'],
                'employee_badge' => $employee['employee_badge'],
                'employee_address' => $employee['employee_address'],
                'employee_position' => $employee['employee_position'],
                'employee_email' => $employee['employee_email'],
                'employee_phone' => $employee['employee_phone'],
                'employee_image' => $employee['employee_image'],
                'id_department' => $employee['id_department'],
                'id_role' => $employee['id_role'],
                'created_at' => $employee['created_at'],
                'updated_at' => $employee['updated_at'],
                'isLoggedIn' => true
            ]);
            session()->setFlashdata('success', "Login Berhasil");
            if ($employee['id_role'] == 1) {
                return redirect()->to('/admin');
            } elseif ($employee['id_role'] == 2) {
                return redirect()->to('/user');
            } else {
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('errors', ['Email atau password salah.']);
            return redirect()->back()->withInput();
        }
    }
    public function logout()
    {

        session()->setFlashdata('success', 'Logout Berhasil');
        session()->destroy();

        return redirect()->to('/login?logout=true');
    }
}
