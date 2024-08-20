<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['product_name', 'brand_name', 'description', 'price', 'product_image', 'id_category', 'id_status', 'damage_description', 'stock'];
    protected $useTimestamps = true;
    protected $useSoftDeletes   = false;
    public function getProducts()
    {
        return $this->select('products.*, categories.category_name')
            ->join('categories', 'products.id_category = categories.id')
            ->findAll();
    }
}
