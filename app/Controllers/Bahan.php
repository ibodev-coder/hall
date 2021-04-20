<?php

namespace App\Controllers;

class Bahan extends BaseController
{
    protected $bahan;
    protected $validation;
    protected $satuan;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->bahan = new \App\Models\bahan_model();
        $this->satuan = new \App\Models\satuan_model();
    }
    public function index()
    {
        $select = [
            'bahan.id as id',
            'bahan.name as name',
            'bahan.stok as stok',
            'bahan.desc as desc',
            'bahan.satuan as satuan',
            'satuan.id as satuan_id',
            'satuan.name as satuan_name',
            'satuan.kd as alias',
            'perstok_ukuran',
            'perstok_satuan',
            'perstok_name',
        ];
        $this->bahan->select($select);
        $this->bahan->join('satuan', 'satuan.id=satuan');
        $getBahan = $this->bahan->get()->getResultArray();

        $getSatuan = $this->satuan->findAll();
        $data = [
            'page_title' => 'Bahan Produksi | Hall Roastery',
            'bahan' => $getBahan,
            'validation' => $this->validation,
            'satuan' => $getSatuan
        ];

        return view('pages/bahan/index', $data);
    }
    public function save()
    {
        $field = [
            'name' => [
                'rules' => 'required|trim|is_unique[bahan.name]',
                'errors' => [
                    'required' => 'Nama wajib di isi',
                    'is_unique' => 'Proses gagal,bahan telah terdaftar'
                ]

            ],
            'satuan' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Satuan wajib di isi']
            ]
        ];
        $validasi = $this->validate($field);
        if ($this->request->getPost()) {
            if (!$validasi) {
                return redirect()->to('/bahan')->withInput()->with('validation', $this->validation);
            } else {
                // dd($this->request->getPost('satuan'));
                // dd(
                //     [
                //         'perStok_ukuran' => $this->request->getPost('perStok_ukuran'),
                //         'perStok_satuan' => $this->request->getPost('perStok_satuan'),
                //         'perStok_name' => $this->request->getPost('perStok_name')
                //     ]
                // );
                $this->bahan->save([
                    'name' => $this->request->getPost('name'),
                    'desc' => $this->request->getPost('desc'),
                    'stok' => 0,
                    'satuan' => $this->request->getPost('satuan'),
                    'perstok_ukuran' => $this->request->getPost('perstok_ukuran'),
                    'perstok_satuan' => $this->request->getPost('perstok_satuan'),
                    'perstok_name' => $this->request->getPost('perstok_name')
                ]);
                session()->setFlashdata('notif', 'Data barhasil disimpan');
                session()->setFlashdata('param', 1);
                return redirect()->to('/bahan');
            }
        }
    }
    public function update($id)
    {
        if ($this->request->getPost()) {
            $this->bahan->where('id', $id)->set($this->request->getPost())->update();
            session()->setFlashdata('notif', 'Data di update');
            session()->setFlashdata('param', 1);
            return redirect()->to('/bahan');
        } else {
            session()->setFlashdata('notif', 'Proses gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/bahan');
        }
    }
    public function view($id)
    {
        $select = [
            'bahan.id as id',
            'bahan.name as name',
            'bahan.stok as stok',
            'bahan.desc as desc',
            'bahan.satuan as satuan',
            'satuan.id as satuan_id',
            'satuan.name as satuan_name',
            'satuan.kd as alias',
            'perstok_ukuran',
            'perstok_satuan',
            'perstok_name',
        ];
        $this->bahan->select($select);
        $this->bahan->join('satuan', 'satuan.id=satuan');
        $getView = $this->bahan->where('bahan.id', $id)->first();

        $getSatuan = $this->satuan->findAll();
        $data = [
            'page_title' => 'View Bahan | Hall Roastery',
            'bahan' => $getView,
            'satuan' => $getSatuan
        ];

        return view('/pages/bahan/view', $data);
    }
    public function delete($id)
    {
        if ($this->bahan->where('id', $id)->delete()) {
            session()->setFlashdata('notif', 'Data berhasil di hapus');
            session()->setFlashdata('param', 1);
            return redirect()->to('/bahan');
        } else {
            session()->setFlashdata('notif', 'Permintaan gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/bahan');
        }
    }

    //--------------------------------------------------------------------

}
