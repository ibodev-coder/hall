<?php

namespace App\Models;

use CodeIgniter\Model;

class satuan_model extends Model
{
    protected $table = ['satuan'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'kd'];
}
