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
        'created_by',
        'allocation_note',
        'created_at',
        'updated_at'
    ];
    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // public function getAllocations()
    // {
    //     return $this->select('allocations.*, recipient.employee_name as recipient_name, allocator.employee_name as allocator_name, areas.area_name, products.product_name')
    //         ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left')
    //         ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left')
    //         ->join('areas', 'areas.id = allocations.id_area', 'left')
    //         ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
    //         ->join('products', 'products.id = product_stocks.id_product', 'left')
    //         ->findAll();
    // }
    public function getAllocations()
    {
        return $this->select('allocations.*, recipient.employee_name as recipient_name, allocator.employee_name as allocator_name, areas.area_name, products.product_name')
            ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left')
            ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
            ->join('products', 'products.id = product_stocks.id_product', 'left')
            ->findAll();
    }
    public function getAllAllocators()
    {
        return $this->select('allocations.*, recipient.employee_name as recipient_name, allocator.employee_name as allocator_name, allocator.id as allocator_id, areas.area_name, products.product_name')
            ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left')
            ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
            ->join('products', 'products.id = product_stocks.id_product', 'left')
            ->findAll();
    }


    public function getFilteredAllocations($allocatorId = null, $month = null, $year = null)
    {
        $builder = $this->select('allocations.*, recipient.employee_name as recipient_name, allocator.employee_name as allocator_name, allocator.id as allocator_id, areas.area_name, products.product_name')
            ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left')
            ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
            ->join('products', 'products.id = product_stocks.id_product', 'left');

        if ($allocatorId) {
            $builder->where('allocations.created_by', $allocatorId);
        }

        if ($month) {
            $builder->where('MONTH(allocations.allocation_date)', $month);
        }

        if ($year) {
            $builder->where('YEAR(allocations.allocation_date)', $year);
        }

        return $builder->findAll();
    }
    public function getProductAllocations()
    {
        return $this->select('allocations.*, employees.employee_name, areas.area_name')
            ->join('employees', 'employees.id = allocations.id_employee', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->where('allocations.id_product_stock', $_GET['id'])
            ->findAll();
    }
    // public function getProductAllocations()
    // {
    //     return $this->select('allocations.*, recipient.employee_name as recipient_name, allocator.employee_name as allocator_name, areas.area_name')
    //         ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left') // Join untuk penerima alokasi
    //         ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left') // Join untuk pengalokasi
    //         ->join('areas', 'areas.id = allocations.id_area', 'left') // Join untuk area
    //         ->where('allocations.id_product_stock', $_GET['id'])
    //         ->findAll();
    // }
    public function getProductWithCategoryAndBrand($id)
    {
        return $this->select('products.*, categories.category_name, brands.brand_name')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->where('products.id', $id)
            ->first(); // Mengambil satu hasil berdasarkan ID
    }
    public function getAllocationsDetails($id)
    {
        return $this->select('allocations.*, allocations.id as allocation_id, recipient.employee_name as recipient_name, recipient.employee_email as recipient_email, recipient.employee_phone as recipient_phone ,  recipient.id_department as recipient_department,recipient.employee_address as recipient_address ,
        allocator.employee_email as allocator_email, allocator.employee_phone as allocator_phone, allocator.employee_address as allocator_address, allocator.employee_name as allocator_name, areas.area_name, products.*, departments.department_name, categories.category_name, brands.brand_name')
            ->join('employees as recipient', 'recipient.id = allocations.id_employee', 'left')
            ->join('employees as allocator', 'allocator.id = allocations.created_by', 'left')
            ->join('areas', 'areas.id = allocations.id_area', 'left')
            ->join('departments', 'departments.id = recipient.id_department', 'left')
            ->join('product_stocks', 'product_stocks.id = allocations.id_product_stock', 'left')
            ->join('products', 'products.id = product_stocks.id_product', 'left')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->where('allocations.id', $id)
            ->first();
    }
}
