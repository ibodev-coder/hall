<?php

namespace App\Controllers;

class BahanIn extends BaseController
{
    protected $bahan;
    protected $satuan;
    protected $validation;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bahan = new \App\Models\bahan_model();
        $this->bahanin = new \App\Models\bahanin_model();
        $this->satuan = new \App\Models\satuan_model();
    }
    public function index()
    {
        $fieldbahan = [
            'bahan.id as id',
            'bahan.name as name',
            'satuan.id as satuan_id',
            'satuan.name as satuan',
            'satuan.kd as kode'
        ];
        $this->bahan->select($fieldbahan);
        $this->bahan->join('satuan', 'satuan.id=bahan.satuan');
        $getBahan = $this->bahan->get()->getResultArray();
        $select = [
            'bahanin.id as id',
            'bahan_id as bahan',
            'stok_in as stok',
            'total_harga as total',
            'supply_id as supplier',
            'bahanin_at as bahanin_at',
            'create_at',
            'bahan.id as bahanId',
            'bahan.name as bahanName',
            'bahan.satuan as satuan_id',
            'satuan.id as satuan',
            'satuan.name as satuanName'
        ];
        $this->bahanin->select($select);
        $this->bahanin->join('bahan', 'bahan.id=bahan_id');
        $this->bahanin->join('satuan', 'satuan.id=bahan.satuan');
        $this->bahanin->orderBy('create_at', 'DESC');
        $getBahanin = $this->bahanin->get()->getResultArray();

        $data = [
            'page_title' => 'Bahan In | Hall Roastery',
            'bahan' => $getBahan,
            'bahanin' => $getBahanin,
        ];
        return view('pages/bahanIn/index', $data);
    }
    public function save()
    {
        $post = $this->request->getPost();
        if ($post) {
            if ($this->request->getPost('satuan') == 1 || $post['satuan'] == 3) {
                $convert = convert($this->request->getPost('stok'));
            } else {
                $convert = $this->request->getPost('stok');
            }

            $field =
                [
                    'bahan_id' => $this->request->getPost('bahan_id'),
                    'supply_id' => $this->request->getPost('supply_id'),
                    'stok_in' => $convert,
                    'total_harga' => $this->request->getPost('total_harga'),
                    'bahanin_at' => $this->request->getPost('bahanin_at'),
                    'create_at' => date('Y:m:d')
                ];
            if ($this->bahanin->save($field)) {
                session()->setFlashdata('notif', 'Data berhasil ditambahkan');
                session()->setFlashdata('param', 1);
                return redirect()->to('/bahanin');
            } else {
                session()->setFlashdata('notif', 'Proses gagal');
                session()->setFlashdata('param', 0);
                return redirect()->to('/bahanin');
            }
        }
    }
    public function update()
    {
    }
    public function view()
    {
    }
    public function delete()
    {
    }


    //--------------------------------------------------------------------

}
