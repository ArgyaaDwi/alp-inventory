<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields = [
        'product_name',
        'id_brand',
        'product_description',
        'product_price',
        'product_image',
        'product_placement',
        'id_category',
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes   = false;
    public function getProducts()
    {
        return $this->select('products.*, categories.category_name, brands.brand_name')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->findAll();
    }
    public function getProductWithStockDetails()
    {
        $builder = $this->db->table('products p');
        $builder->select('p.id, p.product_name, p.product_price, p.product_image, 
                          c.category_name, b.brand_name, 
                          SUM(ps.quantity) AS total_stock');
        $builder->join('product_stocks ps', 'p.id = ps.id_product', 'left');
        $builder->join('categories c', 'p.id_category = c.id', 'left');
        $builder->join('brands b', 'p.id_brand = b.id', 'left');
        $builder->groupBy('p.id, c.category_name, b.brand_name');

        return $builder->get()->getResultArray();
    }
    public function getProductWithCategoryAndBrand($id)
    {
        return $this->select('products.*, categories.category_name, brands.brand_name')
            ->join('categories', 'products.id_category = categories.id')
            ->join('brands', 'products.id_brand = brands.id')
            ->where('products.id', $id)
            ->first(); // Mengambil satu hasil berdasarkan ID
    }
}
