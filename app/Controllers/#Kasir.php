<?php

namespace App\Controllers;

class Kasir extends BaseController
{
    public $count;
    public function __construct()
    {
        $this->item = new \App\Models\item_model();
        $this->kategori = new \App\Models\kategori_model();
        $this->price = new \App\Models\price_model();
        $this->orders = new \App\Models\orders_model();
        $this->success = new \App\Models\order_success_model();
        $this->detail = new \App\Models\detail_order_model();
        $this->bahan = new \App\Models\bahan_model();
        $this->bahanitem = new \App\Models\bahanitem_model();
        $this->stok_out = new \App\Models\stok_out_model();
        $this->dapur = new \App\Models\dapur_model();
        $this->validation = \Config\Services::validation();
    }
    public function index($id = null)
    {
        // Testing

        // for ($i = 1; $i <= 10; $i++) {
        //     echo $i;
        // }

        // Get Item
        $select = [
            'items.id as item_id',
            'items.name as name',
            'items.desc as desc',
            'items.price_id as price_id',
            'items.kategori_id',
            'kategori.id',
            'kategori.name as kategori',
            'price_item.id',
            'price_item.name as price_name',
            'price_item.price as price'


        ];
        // Item
        $this->item->select($select);
        $this->item->join('kategori', 'kategori.id=items.kategori_id');
        $this->item->join('price_item', 'price_item.id=items.price_id');
        $this->item->where('items.price_id !=', 0);
        $getItem = $this->item->get();
        // Get Table 
        $table = [
            'items.id as item_id',
            'items.name as name',
            'items.price_id as price_id',
            'id_order',
            'price_item.id',
            'price_item.price as price',
            'qty'
            // 'orders.id as order_id',
            // 'orders.costumer as costumer'
        ];
        $this->detail->select($table);
        $this->detail->join('items', 'items.id=detail_order.item');
        $this->detail->join('price_item', 'price_item.id=items.price_id');
        $getTable = $this->detail->where('id_order', session('id_costumer'))->get()->getResultArray();
        $getOrder = $this->orders->where('id', $id)->first();


        // $this->detail->select($table);
        // $this->detail->join('items', 'items.id=detail_order.item');
        // $this->detail->join('price_item', 'price_item.id=items.price_id');
        // $getTable = $this->detail->where('id_order', $id)->get()->getResultArray();
        // Get Grand total
        $this->detail->select($table);
        $this->detail->join('items', 'items.id=detail_order.item');
        $this->detail->join('price_item', 'price_item.id=items.price_id');
        $getTotal = $this->detail->where('id_order', session('id_costumer'))->select('SUM(price_item.price*qty)AS total')->get()->getRow();

        $data = [
            'page_title' => 'Transaksi Kasir',
            'item' => $getItem,
            'detail_order' => $getTable,
            'order' => $getOrder,
            'detail' => $getTable,
            'total' => $getTotal

        ];
        return view('pages/kasir/index', $data);
    }
    public function addOrders()
    {
        // cek costumer
        if (!session('costumer')) {
            // id detail



            $this->orders->save([
                'costumer' => $this->request->getPost('pelanggan'),
                'total_transaksi' => 0,
                'create_at' => date("Y:m:d H:i:s"),
                'status' => 0
            ]);
            $notify = $this->orders->resultID;

            $this->orders->selectMax('id', 'detail');
            $id_order = $this->orders->get()->getRow();
            $getID = (int)$id_order->detail;
            session()->set(['id_costumer' => $getID]);
            session()->set(['costumer' => $this->request->getPost('pelanggan')]);
        }



        $this->detail->save([
            'id_order' => session('id_costumer'),
            'item' => $this->request->getPost('id'),
            'qty' => $this->request->getPost('qty')
        ]);
        return redirect()->to('/kasir');
    }
    public function simpan()
    {
        session()->remove(['costumer', 'id_costumer']);
        return redirect()->to('/kasir');
    }
    public function payment($id)
    {
        $getOrder = $this->orders->where('id', $id)->first();

        // Get Table 
        $table = [
            'items.id as item_id',
            'items.name as name',
            'items.price_id as price_id',
            'id_order',
            'price_item.id',
            'price_item.price as price',
            'qty'
            // 'orders.id as order_id',
            // 'orders.costumer as costumer'
        ];
        $this->detail->select($table);
        $this->detail->join('items', 'items.id=detail_order.item');
        $this->detail->join('price_item', 'price_item.id=items.price_id');
        $getTable = $this->detail->where('id_order', $id)->get()->getResultArray();
        // Get Grand total
        $this->detail->select($table);
        $this->detail->join('items', 'items.id=detail_order.item');
        $this->detail->join('price_item', 'price_item.id=items.price_id');
        $getTotal = $this->detail->where('id_order', $id)->select('SUM(price_item.price*qty)AS total')->get()->getRow();

        $data = [
            'page_title' => 'Pembayaran | Hall Roastery',
            'order' => $getOrder,
            'detail' => $getTable,
            'total' => $getTotal
        ];
        return view('pages/kasir/payment', $data);
        // if (!$this->request->getPost('input_payment')) {
        //     if ($this->request->getPost('input_payment') <= $getTotal->total) {
        //         $sisa = $this->request->getPost('input_payment') - $getTotal->total;
        //         session()->setFlashdata('notif', 'Pembayaran berhasil', $sisa);
        //         session()->setFlashdata('param', 1);
        //         return redirect()->to(base_url('kasir'));
        //     } else {
        //         session()->setFlashdata('notif', 'Pembayaran tidak cukup');
        //         session()->setFlashdata('param', 0);
        //         return redirect()->to(base_url('kasir'));
        //     }
        // } else {
        //     return redirect()->to(base_url('kasir'));
        // }
    }
    public function proses($id = '')
    {

        if ($this->request->getPost('input_payment') == null || $this->request->getPost('total') == null) {
            session()->setFlashdata('notif', 'Tidak ada data yang di proses');
            session()->setFlashdata('param', 0);
            return redirect()->to(base_url('kasir'));
        } else {
            if ($this->request->getPost('input_payment')) {
                if ($this->request->getPost('input_payment') >= $this->request->getPost('total')) {
                    $sisa = $this->request->getPost('input_payment') - $this->request->getPost('total');
                    $this->orders->where('id', $id)->set([
                        'status' => 1,
                        'total_transaksi' => $this->request->getPost('total')
                    ])->update();
                    $getdetail = $this->detail->where('id_order', $id)->get()->getResultArray();
                    $this->success->insertBatch($getdetail);
                    $this->_addToDapur($id);
                    $this->detail->where('id_order', $id)->delete();
                    $this->_stokOut($id);
                    // return dd($this->_stokOut($id));
                    session()->setFlashdata('notif', 'Transaksi berhasil, Kembalian ' . number_format($sisa, 2, ',', '.'));
                    session()->setFlashdata('param', 1);

                    session()->remove(['costumer', 'id_costumer']);
                    return redirect()->to(base_url('kasir'));
                } else {
                    session()->setFlashdata('notif', 'Proses gagal,Jumlah uang tidak cukup');
                    session()->setFlashdata('param', 0);
                    return redirect()->to(base_url('kasir'));
                }
            }
        }
    }
    public function delete($id)
    {
        $this->detail->where('item', $id)->delete();
        session()->setFlashdata('notif', 'Data Berhasil di hapus');
        session()->setFlashdata('param', 1);
        return redirect()->to(base_url('kasir'));
    }
    public function reset()
    {
        $this->detail->where('id_order', session('id_costumer'))->delete();
        $this->orders->where('id', session('id_costumer'))->delete();
        session()->remove(['costumer', 'id_costumer']);
        session()->setFlashdata('notif', 'Data Berhasil di hapus');
        session()->setFlashdata('param', 1);
        return redirect()->to(base_url('kasir'));
    }
    private function _stokOut($id)
    {

        $order = $this->success->where('id_order', $id)->get()->getResultArray();
        foreach ($order as $r) {
            $qty = $r['qty'];
            //    Get item
            $getItem = $this->item->where('id', $r['item'])->get()->getResultArray();
            foreach ($getItem as $r) {
                $getBahan = $this->bahanitem->where('item_id', $r['id'])->get()->getResultArray();
                foreach ($getBahan as $r) {
                    $bahan = $this->bahan->where('id', $r['bahan_id'])->get();
                    $jumlah = $r['jumlah'];
                    foreach ($bahan->getResultArray() as $r) {
                        for ($i = 1; $i <= $qty; $i++) {
                            $this->stok_out->save([
                                'bahan_id' => $r['id'],
                                'stok_out' => $jumlah
                            ]);
                        }
                    }
                }
            }
        }


        // $item = $this->item->findAll();
        // $bahan = $this->bahan->findAll();
        // $bahanitem = $this->bahanitem->findAll();

        // $stokOut = $this->stok_out->save([
        //     'bahan_id' => $id,
        //     'stok_out' => $stok_out
        // ]);

    }
    private function _addToDapur($id)
    {
        $post = $this->request->getPost();
        $getDetail = $this->detail->where('id_order', $id)->get()->getResultArray();

        foreach ($getDetail as $r) {
            $id_item = $r['item'];
            $qty = $r['qty'];
            $getItem = $this->item->where('id', $id_item)->get()->getResultArray();
            foreach ($getItem as $r => $key) {
                $kategori = $key['kategori_id'];

                if ($kategori == 11) {
                    $this->orders->where('id', $id)->set([
                        'is_dapur' => 1,

                    ])->update();
                    // $notify = $this->orders->resultID;

                    for ($i = 0; $i <= $r; $i++) {
                        $this->dapur->save([
                            'id_order' => $id,
                            'item' => $id_item,
                            'qty' => $qty
                        ]);
                    }
                    session()->setFlashdata('notify', 1);
                } else {
                    echo 'kok gk ada ya?';
                }
            }
        }

        // $this->orders->where('id', $id)->set([
        //     'status' => 1,
        //     'total_transaksi' => $this->request->getPost('total')
        // ])->update();

        // $this->dapur->insertBatch([
        //     'id_order' => $id,
        //     'item' => $insertToDapur['item'],
        //     'qty' => $insertToDapur['qty']
        // ]);


        // dd($kategori);
    }


    //--------------------------------------------------------------------

}
