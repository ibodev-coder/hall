<?php

namespace App\Models;

use CodeIgniter\Model;

class detail_order_model extends Model
{
    protected $table = ['detail_order'];

    protected $allowedFields = ['id_order', 'item', 'qty'];
}
