<?php

namespace App\Controllers;

class Harga extends BaseController
{
    protected $item;
    protected $price;
    public function __construct()
    {
        $this->item = new \App\Models\item_model();
        $this->price = new \App\Models\price_model();
    }
    public function index()
    {
        $getItem = $this->item->where('price_id', 0)->findAll();
        $getPrice = $this->price->findAll();
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
        $this->item->select($select);
        $this->item->join('kategori', 'kategori.id=items.kategori_id');
        $this->item->join('price_item', 'price_item.id=items.price_id');
        $getAllitem = $this->item->get();
        $data = [
            'page_title' => 'Harga | Hall Roastery',
            'items' => $getItem,
            'price' => $getPrice,
            'allItem' => $getAllitem
        ];

        return view('pages/harga/index', $data);
    }
    public function save()
    {
        $post = $this->request->getPost();
        $field = [
            'id' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Item harus di isi']
            ],
            'price_id' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Harga harus di isi']
            ]
        ];
        $validation = $this->validate($field);
        if ($post) {
            if (!$validation) {
                return redirect()->to('/harga')->withInput()->with('validation', $this->validation);
            } else {
                $this->item->where('id', $this->request->getPost('id'))->set($post)->update();
                session()->setFlashdata('notif', 'Data berhasil di update');
                session()->setFlashdata('param', 1);
                return redirect()->to('/Harga');
            }
        }
    }
    public function update()
    {
    }
    public function delete()
    {
    }
    public function view()
    {
    }
    //--------------------------------------------------------------------

}
