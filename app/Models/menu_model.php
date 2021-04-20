<?php

namespace App\Models;

use CodeIgniter\Model;

class menu_model extends Model
{
    protected $table = ['menu'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'name', 'role_id', 'icon'];
}
