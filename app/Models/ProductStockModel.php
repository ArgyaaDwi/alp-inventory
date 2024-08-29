<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductStockModel extends Model
{
    protected $table            = 'product_stocks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['id_product', 'item_code', 'id_status', 'quantity', 'damage_description', 'created_at', 'updated_at'];
    // public function getProductWithStockDetails($productId)
    // {
    //     return $this->db->table('products p')
    //         ->select('p.id AS product_id, p.product_name, p.product_description, p.product_price, p.product_image, 
    //               c.category_name, b.brand_name, 
    //               COALESCE(SUM(ps.quantity), 0) AS total_stock, 
    //               s.status_name, COALESCE(SUM(ps.quantity), 0) AS status_stock, 
    //               ps.damage_description')
    //         ->join('categories c', 'p.id_category = c.id', 'left')
    //         ->join('brands b', 'p.id_brand = b.id', 'left')
    //         ->join('product_stocks ps', 'p.id = ps.id_product', 'left')
    //         ->join('status s', 'ps.id_status = s.id', 'left')
    //         ->where('p.id', $productId)
    //         ->groupBy('p.id, s.id')
    //         ->get()
    //         ->getResultArray();
    // }
    public function getProductWithStockDetails($productId)
    {
        return $this->db->table('products p')
            ->select('p.id AS product_id, p.product_name, p.product_description, p.product_price, p.product_image, 
              c.category_name, b.brand_name, 
              COALESCE(SUM(ps.quantity), 0) AS total_stock, 
              s.status_name, COALESCE(SUM(ps.quantity), 0) AS status_stock, 
              ps.damage_description')
            ->join('categories c', 'p.id_category = c.id', 'left')
            ->join('brands b', 'p.id_brand = b.id', 'left')
            ->join('product_stocks ps', 'p.id = ps.id_product', 'left')
            ->join('status s', 'ps.id_status = s.id', 'left')
            ->where('p.id', $productId)
            ->groupBy('p.id, s.id, ps.damage_description')
            ->get()
            ->getResultArray();
    }

    public function getProductWithStockDetailes($productId)
    {
        return $this->db->table('product_stocks ps')
            ->select('p.id AS product_id, 
                  COALESCE(SUM(ps.quantity), 0) AS total_stock, 
                  SUM(CASE WHEN s.status_name = "Bagus" THEN ps.quantity ELSE 0 END) AS good_stock,
                  SUM(CASE WHEN s.status_name = "Rusak Sebagian" THEN ps.quantity ELSE 0 END) AS partial_damage_stock,
                  SUM(CASE WHEN s.status_name = "Rusak" THEN ps.quantity ELSE 0 END) AS damaged_stock,
                  GROUP_CONCAT(CASE WHEN s.status_name = "Rusak Sebagian" THEN ps.damage_description ELSE NULL END SEPARATOR ", ") AS partial_damage_descriptions')
            ->join('products p', 'ps.id_product = p.id', 'left')
            ->join('status s', 'ps.id_status = s.id', 'left')
            ->where('p.id', $productId)
            ->groupBy('p.id')
            ->get()
            ->getRowArray(); 
    }
    
}