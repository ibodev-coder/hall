<?php

namespace App\Models;

use CodeIgniter\Model;

class order_success_model extends Model
{
    protected $table = ['order_success'];

    protected $allowedFields = ['id_order', 'item', 'qty'];
}
