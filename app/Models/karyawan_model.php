<?php

namespace App\Models;

use CodeIgniter\Model;

class karyawan_model extends Model
{
    protected $table = ['karyawan'];
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'fullname', 'place', 'date', 'address', 'img', 'account', 'status', 'role', 'salary', 'gender'];
}
