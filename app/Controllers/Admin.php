<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new \App\Models\orders_model();
        $this->detail = new \App\Models\order_success_model();
        $this->user = new \App\Models\user_model();
        $this->bahan = new \App\Models\bahan_model();
        $this->bahanin = new \App\Models\bahanin_model();
    }
    public function index()
    {
        // $user = $this->user->where('is_active', 1)->getNumRows();
        // dd($user);

        $data = [
            'page_title' => 'Dashboard | Hall Roastery Coffe Company'
        ];


        return view('pages/admin/index', $data);
    }

    //--------------------------------------------------------------------

}
