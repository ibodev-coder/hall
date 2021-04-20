<?php

namespace App\Controllers;

class Item extends BaseController
{
    protected $item;
    protected $kategori;
    protected $price;
    protected $validation;
    public function __construct()
    {
        $this->item = new \App\Models\item_model();
        $this->bahanitem = new \App\Models\bahanitem_model();
        $this->kategori = new \App\Models\kategori_model();
        $this->price = new \App\Models\price_model();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        // Get Kategori
        $getKategori = $this->kategori->findAll();
        $select = [
            'items.id as item_id',
            'items.name as name',
            'items.desc as desc',
            'items.price_id as price_id',
            'items.kategori_id',
            'items.price as price',
            'items.img as img',
            'kategori.id',
            'kategori.name as kategori',



        ];
        $this->item->select($select);
        $this->item->join('kategori', 'kategori.id=items.kategori_id');
        // $this->item->join('price_item', 'price_item.id=items.price_id');
        $getItem = $this->item->get();

        $data = [
            'page_title' => 'Item | Hallroastery',
            'kategori' => $getKategori,
            'items' => $getItem,
            'validation' => $this->validation
        ];

        return view('pages/item/index', $data);
    }

    public function view($id)
    {
        $getKategori = $this->kategori->findAll();
        $select = [
            'items.id as item_id',
            'items.name as item_name',
            'items.desc as item_desc',
            'items.kategori_id as kategori',
            'items.price as price',
            'kategori.id as id_kategori',
            'kategori.name as kategori_name',
            'items.img as img'
        ];
        $this->item->select($select);
        $this->item->join('kategori', 'kategori.id=kategori_id');
        $this->item->where('items.id', $id);
        $getItem = $this->item->first();

        $data = [
            'page_title' => 'Update Item | Hall Roastery',
            'item' => $getItem,
            'kategori' =>  $getKategori,

        ];
        return view('pages/item/view', $data);
    }
    public function delete($id)
    {
        $this->bahanitem->where('item_id', $id)->delete();
        if ($this->item->where('id', $id)->delete()) {
            session()->setFlashdata('notif', 'Data berhasil di hapus');
            session()->setFlashdata('param', 1);
            return redirect()->to('/item');
        } else {
            session()->setFlashdata('notif', 'Permintaan gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/item');
        }
    }
    public function save()
    {
        $post = $this->request->getPost();
        $fieldValidation = [
            'name' => [
                'rules' => 'required|trim|is_unique[items.name]',
                'errors' => [
                    'required' => 'Nama harus di isi',
                    'is_unique' => 'Item telah terdaftar'
                ]
            ],
            'kategori_id' => [
                'rules' => ['required'],
                'errors' => ['required' => 'kategori harus di isi']
            ],
            // 'img' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
            'img' => [
                'uploaded[img]',
                'mime_in[img,image/jpeg,image/png,image/gif]',
                'max_size[img,5000]',
            ]
        ];
        if ($post) {
            $validation = $this->validate($fieldValidation);

            if (!$validation) {
                return redirect()->to('/item')->withInput()->with('validation', $this->validation);
            } else {
                $file = $this->request->getFile('img');

                $name = $file->getRandomName();
                $file->move('../public/assets/production/images/items', $name);
                $field = [
                    'name' => $this->request->getPost('name'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'desc' => $this->request->getPost('desc'),
                    // 'price_id' => 0
                    'price' => $this->request->getPost('price'),
                    'img' => $name



                ];

                $this->item->save($field);
                session()->setFlashdata('notif', 'Data berhasil disimpan');
                session()->setFlashdata('param', 1);
                return redirect()->to('/item');
            }
        } else {
            session()->setFlashdata('notif', 'Proses gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/item');
        }
        return;
    }
    public function update($id)
    {
        $post = $this->request->getPost();
        if ($post) {

            if ($this->request->getFile('img') == null) {
                $item = $this->item->where('id', $id)->first();
                $name = $item['img'];
            } else {
                $file = $this->request->getFile('img');
                $name = $file->getRandomName();
                $file->move('../public/assets/production/images/items', $name);
            }
            $update = [
                'name' => $this->request->getPost('name'),
                'kategori_id' => $this->request->getPost('kategori_id'),
                'desc' => $this->request->getPost('desc'),
                // 'price_id' => 0
                'price' => $this->request->getPost('price'),
                'img' => $name
            ];

            $this->item->where('id', $id)->set($update)->update();
            session()->setFlashdata('notif', 'Data berhasil disimpan');
            session()->setFlashdata('param', 1);
            return redirect()->to('/item');
        } else {
            session()->setFlashdata('notif', 'Proses gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/item');
        }
        return;
    }
    public function modalKategori()
    {
        $post = $this->request->getPost();
        $field = [
            'name' => ['rules' => 'required|is_unique[kategori.name]'],
            'desc' => ['rules' => 'trim']
        ];
        if ($post) {
            if ($this->validate($field)) {

                $this->kategori->save($post);
                session()->setFlashdata('notif', 'Kategori baru berhasil di simpan');
                session()->setFlashdata('param', 1);
                return redirect()->to('/item');
            } else {
                session()->setFlashdata('notif', 'Permintaan gagal');
                session()->setFlashdata('param', 0);
                return redirect()->to('/item')->with('validation', $this->validasi);
            }
        }
        return;
    }


    //--------------------------------------------------------------------

}
