<?php

namespace App\Controllers;

class Bahanitem extends BaseController
{
    protected $bahan;
    protected $validation;
    protected $satuan;

    public function __construct()
    {
        $this->item = new \App\Models\item_model();
        $this->kategori = new \App\Models\kategori_model();
        $this->price = new \App\Models\price_model();
        $this->validation = \Config\Services::validation();
        $this->bahan = new \App\Models\bahan_model();
        $this->satuan = new \App\Models\satuan_model();
        $this->bahanitem = new \App\Models\bahanitem_model();
    }
    public function index()
    {
        // Get Item
        $selectItem = [
            'items.id as item_id',
            'items.name as name',
            'items.desc as desc',
            'items.price_id as price_id',
            'items.kategori_id',
            'kategori.id',
            'kategori.name as kategori',

        ];
        $this->item->select($selectItem);
        $this->item->join('kategori', 'kategori.id=items.kategori_id');

        $getItem = $this->item->get()->getResultArray();
        // Get Bahan
        $selectBahan = [
            'bahan.id as id',
            'bahan.name as name',
            'bahan.stok as stok',
            'bahan.desc as desc',
            'bahan.satuan as satuan',
            'satuan.id as satuan_id',
            'satuan.name as satuan_name',
            'satuan.kd as alias'
        ];
        $this->bahan->select($selectBahan);
        $this->bahan->join('satuan', 'satuan.id=satuan');
        $getBahan = $this->bahan->get()->getResultArray();
        // Get satuan
        $getSatuan = $this->satuan->findAll();
        $data = [
            'page_title' => 'Bahan Produksi | Hall Roastery',
            'item' => $getItem,
            'validation' => $this->validation,
            'bahan' => $getBahan,
            'satuan' => $getSatuan

        ];

        return view('pages/bahanitem/index', $data);
    }
    public function save()
    {
        $field = [
            'item' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Item harus di isi',

                ]
            ],
            'bahan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Bahan harus di isi']
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jumlah harus di isi']
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Satuan harus di isi']
            ],
        ];
        $validate = $this->validate($field);
        $post = $this->request->getPost();
        // cek item id
        $cekItem = $this->bahanitem->where('item_id', $post['item'])->get()->getFieldCount();
        if ($cekItem == 0) {
            session()->setFlashdata('notif', 'Proses gagal,item telah pernah di isi sebelumnya');
            session()->setFlashdata('param', 0);
            return redirect()->to('/bahanitem');
        }
        if ($post) {
            if (!$validate) {
                return redirect()->to('/bahanitem')->withInput()->with('validation', $this->validation);
            } else {
                $array = array();
                $bahan_id = $post['bahan'];
                foreach ($bahan_id as $key => $val) {
                    $array[] = array(
                        'item_id' => $post['item'],
                        'bahan_id' => $post['bahan'][$key],
                        'satuan' => $post['satuan'][$key],
                        'jumlah' => $post['jumlah'][$key]
                    );
                }
                $save = $this->bahanitem->insertBatch($array);

                // $save = $this->bahanitem->save([
                //     'item_id' => $post['item'],
                //     'bahan_id' => $post['bahan'],
                //     'satuan' => $post['satuan'],
                //     'jumlah' => $post['jumlah']
                // ]);
                if (!$save) {
                    session()->setFlashdata('notif', 'Data gagal di proses');
                    session()->setFlashdata('param', 0);
                    return redirect()->to('/bahanitem');
                } else {
                    session()->setFlashdata('notif', 'Data disimpan');
                    session()->setFlashdata('param', 1);
                    return redirect()->to('/bahanitem');
                }
            }
        }
    }

    //--------------------------------------------------------------------

}
