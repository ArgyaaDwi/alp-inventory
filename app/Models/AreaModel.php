<?php

namespace App\Models;

use CodeIgniter\Model;

class AreaModel extends Model
{
    protected $table            = 'areas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
      protected $useSoftDeletes   = false;
    protected $allowedFields    = ['area_name', 'area_description', 'created_at', 'updated_at'];

   
}
