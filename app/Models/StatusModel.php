<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table            = 'status';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['status_name'];

    public function getStatusById($id)
    {
        return $this->find($id);
    }
}
