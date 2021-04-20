<?php

namespace App\Controllers;

class Owner extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new \App\Models\orders_model();
        $this->detail = new \App\Models\order_success_model();
        $this->user = new \App\Models\user_model();
        $this->bahan = new \App\Models\bahan_model();
        $this->bahanin = new \App\Models\bahanin_model();
        $this->item = new \App\Models\item_model();
        $this->karyawan = new \App\Models\karyawan_model();
    }
    public function index()
    {
        $user = $this->user->where('is_active', 1)->countAllResults();
        $now = date('Y-m-d', strtotime(date('Y-m-d')));
        $transaksi = $this->transaksi->where('create_at', $now)->countAllResults();
        $bahan = $this->bahan->countAllResults();
        $karyawan = $this->karyawan->countAllResults();
        $item = $this->item->countAllResults();
        $closeOrder = date('d-m-Y h:i', strtotime(date('d-m-Y h:i')));
        $data = [
            'page_title' => 'Dashboard | Hall Roastery Coffe Company',
            'user_active' => $user,
            'transaksi_now' => $transaksi,
            'bahan_row' => $bahan,
            'item_row' => $item,
            'karyawan_row' => $karyawan,
            'close_order' => $closeOrder
        ];


        return view('pages/owner/index', $data);
    }


    //--------------------------------------------------------------------

}
