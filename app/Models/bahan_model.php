<?php

namespace App\Models;

use CodeIgniter\Model;

class bahan_model extends Model
{
    protected $table = ['bahan'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'desc', 'stok', 'satuan', 'perstok_satuan', 'perstok_ukuran', 'perstok_name'];
}
