<?php

namespace App\Models;

use CodeIgniter\Model;

class price_model extends Model
{
    protected $table = ['price_item'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'price'];
}
