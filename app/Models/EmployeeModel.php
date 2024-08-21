<?php

namespace App\Models;
    
use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['employee_badge', 'employee_name', 'employee_address', 'employee_position', 'employee_email', 'employee_phone', 'employee_image', 'id_department','id_role', 'is_active', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    public function getEmployees()
    {
        return $this->select('employees.*, departments.department_name')
            ->join('departments', 'employees.id_department = departments.id')
            ->findAll();
    }
    public function getEmployeeWithDepartment($id)
    {
        return $this->select('employees.*, departments.department_name')
            ->join('departments', 'employees.id_department = departments.id')
            ->where('employees.id', $id)
            ->first();
    }
}
