<?php

namespace App\Controllers;

class Dapur extends BaseController
{
    public function __construct()
    {
        $this->transaksi = new \App\Models\orders_model();
        $this->success = new \App\Models\order_success_model();
        $this->dapur = new \App\Models\dapur_model();
    }
    public function index()
    {
        // $order = $this->transaksi->where('is_dapur', 1)->findAll();

        // $this->dapur->join('items', 'items.id=dapur.item');
        $order = $this->transaksi->where('is_dapur', 1)->findAll();
        // $count = $this->transaksi->where('is_dapur', 1)->countAllResults();
        // $param = new \App\Controllers\Kasir();
        // dd($param->count);
        $data = [
            'page_title' => 'Dapur | Hall Roastery',
            'order' => $order,
            'dapur' =>   $this->dapur



        ];

        return view('pages/dapur/index', $data);
    }
    public function endProses($id)
    {
        $this->transaksi->where('id', $id)->set([
            'is_dapur' => 0,
        ])->update();
        session()->setFlashdata('notif', 'Good Job Boys');
        session()->setFlashdata('param', 1);
        return redirect()->to('/Dapur');
    }
    public function antrian()
    {
        $order = $this->transaksi->where('is_dapur', 1)->findAll();
        $data = [

            'order' => $order,
            'dapur' =>   $this->dapur
        ];
        $msg = [
            'data' => view('pages/dapur/antrian', $data)
        ];
        echo json_encode($msg);
    }

    //--------------------------------------------------------------------

}
