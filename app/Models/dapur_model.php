<?php

namespace App\Models;

use CodeIgniter\Model;

class dapur_model extends Model
{
    protected $table = ['dapur'];

    protected $allowedFields = ['id_order', 'item', 'qty', 'status'];
}
