<?php

namespace App\Models;

use CodeIgniter\Model;

class kategori_model extends Model
{
    protected $table = ['kategori'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'desc'];
}
