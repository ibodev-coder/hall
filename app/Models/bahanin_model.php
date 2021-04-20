<?php

namespace App\Models;

use CodeIgniter\Model;

class bahanin_model extends Model
{
    protected $table = ['bahanin'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'bahan_id', 'stok_in', 'total_harga', 'bahanin_at', 'create_at'];
}
