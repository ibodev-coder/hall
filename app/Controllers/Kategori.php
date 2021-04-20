<?php

namespace App\Controllers;


class Kategori extends BaseController
{
    protected $kategori;
    protected $validasi;
    public function __construct()
    {
        $this->kategori = new \App\Models\kategori_model();
        $this->validasi =  \Config\Services::validation();
    }
    public function index()
    {
        $kategori = $this->kategori->findAll();
        $data = [
            'page_title' => 'Kategori | Hall Roastery',
            'kategori' => $kategori
        ];
        return view('pages/kategori/index', $data);
    }
    public function save()
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
                return redirect()->to('/kategori');
            } else {
                session()->setFlashdata('notif', 'Permintaan gagal');
                session()->setFlashdata('param', 0);
                return redirect()->to('/kategori')->with('validation', $this->validasi);
            }
        }
        return;
    }
    public function delete($id)
    {
        if ($this->kategori->where('id', $id)->delete()) {
            session()->setFlashdata('notif', 'Data berhasil di hapus');
            session()->setFlashdata('param', 1);
            return redirect()->to('/kategori');
        } else {
            session()->setFlashdata('notif', 'Permintaan gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/kategori');
        }
    }
    public function view($id)
    {
        $data = [
            'page_title' => 'Edit Kategori | Hall Roastery',
            'kategori' => $this->kategori->where('id', $id)->first()
        ];


        return view('pages/kategori/view', $data);
    }
    public function update($id)
    {
        $post = $this->request->getPost();

        if ($post) {
            $this->kategori->where('id', $id)->set($post)->update();
            session()->setFlashdata('notif', 'Data berhasil di simpan');
            session()->setFlashdata('param', 1);
            return redirect()->to('/kategori');
        } else {
            session()->setFlashdata('notif', 'Permintaan gagal');
            session()->setFlashdata('param', 0);
            return redirect()->to('/kategori');
        }

        return;
    }

    //--------------------------------------------------------------------

}
