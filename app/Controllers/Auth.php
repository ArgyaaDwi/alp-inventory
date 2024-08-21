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
    public function registerUser()
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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'id_role' => 2,
            'is_active' => 1,
            'created_at' => Time::now(),
        ];

        try {
            $this->employeeModel->save($data);
            session()->setFlashdata('success', "Akun berhasil dibuat untuk <strong>{$data['full_name']}</strong>!");
        } catch (\Exception $e) {
            log_message('error', 'Error saat membuat akun: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'Terjadi kesalahan saat membuat akun');
        }

        return redirect()->to('/login');
    }

    public function login()
    {
        return view('auth/login');
    }
}
