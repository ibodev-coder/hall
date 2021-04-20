<?php

namespace App\Models;

use CodeIgniter\Model;

class user_model extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'email', 'password', 'telp', 'role_id', 'avatar', 'create_at', 'update_at', 'is_active'];
    protected $returnType = 'App\Entities\User';
    protected $useTimestamps = false;
}
