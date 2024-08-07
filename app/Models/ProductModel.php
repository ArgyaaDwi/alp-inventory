<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['product_name', 'brand_name', 'description','price','product_image', 'id_category', 'stock'];
    protected $useTimestamps = true;
    protected $useSoftDeletes   = false;
}
