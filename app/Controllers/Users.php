<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function __construct()
    {
        $this->user = new \App\Models\user_model();
    }
    public function index()
    {
        $select = [
            'username as user',
            'email as email',
            'avatar as avatar',
            'role_id as role_id',
            'role.id as role',
            'role.name as role_name '
        ];
        $this->user->select($select);
        $this->user->join('role', 'role.id=users.role_id');
        $getUser = $this->user->get()->getResultArray();
        // dd($getUser);
        $data = [
            'page_title' => 'Users | Hall Roastery',
            'users' => $getUser

        ];
        return view('pages/user/index', $data);
    }

    //--------------------------------------------------------------------

}
