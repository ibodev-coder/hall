<?php

namespace App\Models;

use CodeIgniter\Model;

class stok_out_model extends Model
{
    protected $table = ['stok_out'];
    protected $allowedFields = ['bahan_id', 'stok_out', 'create_at'];
}
