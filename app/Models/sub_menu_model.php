<?php

namespace App\Models;

use CodeIgniter\Model;

class sub_menu_model extends Model
{
    protected $table = ['sub_menu'];
    protected $allowedFields = ['menu_id', 'name', 'href'];
}
