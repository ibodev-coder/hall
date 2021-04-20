<?php

namespace App\Models;

use CodeIgniter\Model;

class orders_model extends Model
{
    protected $table = ['orders'];
    // protected $primaryKey = 'id';
    protected $allowedFields = ['id_order', 'costumer', 'total_transaksi', 'create_at', 'status', 'is_dapur'];
}
