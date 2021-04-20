<?php

namespace App\Models;

use CodeIgniter\Model;

class role_model extends Model
{
    protected $table = ['role'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name'];
}
