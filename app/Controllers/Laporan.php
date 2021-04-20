<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new \App\Models\orders_model();
        $this->detail = new \App\Models\order_success_model();
    }
    public function transaksi()
    {
        $data = [
            'page_title' => 'Laporan Transaksi | Hall Roastery',
            'transaksi' => $this->transaksi->findAll()
        ];

        return view('pages/laporan/transaksi', $data);
    }
    public function transaksiDetail($id)
    {
        $getTransaksiDetail = $this->detail->where('id_order', $id)->get()->getResultArray();
        $getTransaksi = $this->transaksi->where('id_order', $id)->get()->getRow();
        // dd($getTransaksi->costumer);
        $data = [
            'detail' => $getTransaksiDetail,
            'transaksi_id' => $getTransaksi
        ];
        $msg = [
            'data' => view('pages/laporan/detail_transaksi', $data)
        ];
        echo json_encode($msg);
    }
    public function stokOut()
    {


        $data = [
            'page_title' => 'Laporan Bahan keluar | Hall Roastery',

        ];
        return view('pages/laporan/stokout', $data);
    }

    //--------------------------------------------------------------------

}
