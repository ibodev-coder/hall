<?php

namespace App\Entities;

use CodeIgniter\Entity;

class User extends Entity
{
    //Hash Password

    public function setPassword(string $pass)
    {
        $this->attributes['password'] = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }
}
