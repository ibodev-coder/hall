<?php

namespace App\Models;

use CodeIgniter\Model;

class item_model extends Model
{
    protected $table = ['items'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'desc', 'kategori_id', 'price_id', 'price', 'img'];
}
