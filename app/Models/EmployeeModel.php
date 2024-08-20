<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['employee_badge', 'employee_name', 'employee_address', 'employee_position', 'employee_email', 'employee_phone', 'employee_image', 'id_department', 'is_active', 'created_at', 'updated_at', 'updated_at'];
}
