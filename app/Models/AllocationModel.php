<?php

namespace App\Models;

use CodeIgniter\Model;

class AllocationModel extends Model
{
    protected $table            = 'allocations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'id_product_stock',
        'allocation_type',
        'id_employee',
        'id_area',
        'quantity',
        'allocation_date',
        'allocation_note',
        'created_at',
        'updated_at'
    ];
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    public function getAllocations()
    {
        return $this->select('allocations.*, employees.employee_name, areas.area_name, products.product_name')
            ->join('employees', 'employees.id = allocations.id_employee', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
            ->join('products', 'products.id = product_stocks.id_product', 'left')
            ->findAll();
    }
    public function getProductAllocations(){
        return $this->select('allocations.*, employees.employee_name, areas.area_name')
            ->join('employees', 'employees.id = allocations.id_employee', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->where('allocations.id_product_stock', $_GET['id'])
            ->findAll();
    }
}
