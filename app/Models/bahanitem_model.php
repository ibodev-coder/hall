<?php

namespace App\Models;

use CodeIgniter\Model;

class bahanitem_model extends Model
{
    protected $table = ['bahanitem'];

    protected $allowedFields = ['item_id', 'bahan_id', 'jumlah', 'satuan'];
}
