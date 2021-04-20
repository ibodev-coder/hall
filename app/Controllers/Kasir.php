<?php

namespace App\Controllers;

class Kasir extends BaseController
{
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
    public function index()
    {

        $max = $this->orders->selectMax('id_order', 'idMax')->get()->getRowArray();
        $kode = (int)substr($max['idMax'], 6, 5);
        $kode++;
        $prefix = "ORDER";
        $getKode = $prefix . sprintf("%03s", $kode);

        if (!session('id_order')) {
            session()->set(['id_order' => $getKode]);
        }


        $data = [
            'kategori' => $this->_kategori(),
            'item' => new \App\Models\item_model(),
        ];
        return view('pages/kasir/index', $data);
    }
    private function _kategori()
    {
        return $this->kategori->findAll();
    }
    private function _item($id = '')
    {
        return $this->item->where('kategori_id', $id)->findAll();
    }
    public function detailItem($id)
    {
        $detail = $this->item->where('id', $id)->get()->getRow();
        $data = [
            'detail' => $detail
        ];
        $msg = [
            'data' => view('pages/kasir/detail_item', $data)
        ];
        echo json_encode($msg);
    }
    public function addOrder()
    {
        $post = $this->request->getPost();
        // $data = [
        //     'id_order' => $post['id_order'],
        //     'item' => $post['item'],
        //     'qty' => $post['qty']
        // ];
        $data = [
            'id_order' => $post['id_order'],
            'item' => $post['item'],
            'qty' => $post['qty']
        ];
        $save = $this->detail->save($data);
        echo json_encode($save);
    }
    public function showOrder()
    {
        $select = [
            'items.id as id_item',
            'items.name as name',
            'items.price as price',
            'detail_order.id_order as order',
            'detail_order.qty as qty',
            'detail_order.item as itemm',
        ];
        $this->detail->join('items', 'items.id=detail_order.item');
        $list_order = $this->detail->where('id_order', session()->get('id_order'))->get()->getResultArray();

        // grand total
        $this->detail->join('items', 'items.id=detail_order.item');
        $total = $this->detail->where('id_order', session()->get('id_order'))->select('SUM(items.price*detail_order.qty)as total')->get()->getRowArray();

        $data = [
            'list_order' => $list_order,
            'total' => $total
        ];
        $msg = [
            'data' => view('pages/kasir/list_order', $data)
        ];
        echo json_encode($msg);
    }
    public function resetOrder()
    {
        $this->detail->where('id_order', session()->get('id_order'))->delete();
        session()->remove('id_order');
        return redirect()->to('/kasir');
    }
    public function deleteOrder($id = '')
    {
        $data = $this->detail->where('item', $id)->delete();
        echo json_encode($data);
    }
    public function payment()
    {
        // $post = $this->request->getPost();
        $select = [
            'items.id as id_item',
            'items.name as name',
            'items.price as price',
            'detail_order.id_order as order',
            'detail_order.qty as qty',
            'detail_order.item as itemm',
        ];
        // grand total
        $this->detail->join('items', 'items.id=detail_order.item');
        $total = $this->detail->where('id_order', session()->get('id_order'))->select('SUM(items.price*detail_order.qty)as total')->get()->getRowArray();
        $data =
            [
                'total' => $total
            ];
        $msg = ['data' => view('pages/kasir/payment')];
        echo json_encode($msg);
    }
    public function proses()
    {
        $post = $this->request->getPost();
        $id = session()->get('id_order');
        if ($post['pembayaran'] < $post['total']) {
            session()->setFlashdata('notif', 'Proses gagal,masukan jumlah uang dengan benar');
            session()->setFlashdata('param', 0);
            return redirect()->to('/kasir');
        } else {
            if ($post['total'] == null) {
                session()->setFlashdata('notif', 'Tidak ada transaksi');
                session()->setFlashdata('param', 0);
                return redirect()->to('/kasir');
            }
            $sisa = $this->request->getPost('pembayaran') - $this->request->getPost('total');

            // $save = $this->orders->save([
            //     'id' => 11,
            //     'costumer' => $post['nama'],
            //     'total_transaksi' => $post['total'],
            //     'create_at' => date("Y:m:d H:i:s"),
            //     'status' => 1,
            //     'is_dapur' => 0,
            // ]);
            $save = [
                'id_order' => session()->get('id_order'),
                'costumer' => $post['nama'],
                'total_transaksi' => $post['total'],
                'create_at' => date("Y:m:d"),
                'status' => 1,
                'is_dapur' => 0,
            ];
            if ($this->orders->save($save)) {
                $inserToSuccess = $this->detail->where('id_order', session()->get('id_order'))->findAll();
                $this->success->insertBatch($inserToSuccess);
                $this->detail->where('id_order', session()->get('id_order'))->delete();
                $this->_stokOut($id);
                /////
                $nama = $post['nama'];
                session()->setFlashdata('notif',  'Transaksi atas nama ' . $nama . ' berhasil ' . 'kembalian -Rp' . $sisa);
                session()->setFlashdata('param', 1);
                session()->remove('id_order');
                return redirect()->to('/kasir');
            }


            // dd($save);
            // $getdetail = $this->detail->where('id_order', session()->get('id_order'))->get()->getResultArray();
            // $this->success->insertBatch($getdetail);
            // $this->detail->where('id_order', session()->get('id_order'))->delete();
            // $this->_stokOut(session()->get('id_order'));
            // session()->setFlashdata('notif', 'Transaksi berhasil, Kembalian ' . number_format($sisa, 2, ',', '.'));
            // session()->setFlashdata('param', 1);
            // session()->remove('id_order');
            return redirect()->to(base_url('kasir'));
        }
    }
    private function _stokOut($id)
    {

        $order = $this->success->where('id_order', $id)->findAll();
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
                                'stok_out' => $jumlah,
                                'create_at' => date('Y:m:d')
                            ]);
                        }
                    }
                }
            }
        }
    }

    //--------------------------------------------------------------------

}
