<?php

namespace App\Controllers;

class Karyawan extends BaseController
{
    protected $karyawan;
    protected $validation;
    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->karyawan = new \App\Models\karyawan_model();
    }
    public function index()
    {
        // Get Karyawan
        $getKaryawan = $this->karyawan->findAll();


        $data = [
            'page_title' => 'Karyawan | Hall Roastery',
            'karyawan' => $getKaryawan
        ];
        return view('pages/karyawan/index', $data);
    }
    public function addKaryawan()
    {
        $data = [
            'page_title' => 'Tambah Karyawan | Hall Roastery',
            'validation' => $this->validation
        ];
        return view('pages/karyawan/addKaryawan', $data);
    }
    public function save()
    {
        $field = [
            'fullname' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Nama harus isi']
            ],
            'place' => [
                'rules' => ['required'],
                'errors' => ['required' => 'tempat lahir harus di isi']
            ],
            'date' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Tanggal lahir harus di isi']
            ],
            'address' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Alamat lahir harus di isi']
            ],
            'role' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Level lahir harus di isi']
            ],
            'status' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Status lahir harus di isi']
            ],

            'salary' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Gaji lahir harus di isi']
            ],
            'gender' => [
                'rules' => ['required'],
                'errors' => ['required' => 'Jenis Kelamin lahir harus di isi']
            ]
        ];
        $post = $this->request->getPost();
        $validate = $this->validate($field);
        if ($post) {
            if (!$validate) {
                return redirect()->to('/karyawan/addKaryawan')->withInput()->with('validation', $this->validation);
            } else {
                $save = $this->karyawan->save([
                    'fullname' => $this->request->getPost('fullname'),
                    'place' => $this->request->getPost('place'),
                    'date' => $this->request->getPost('date'),
                    'address' => $this->request->getPost('address'),
                    'role' => $this->request->getPost('role'),
                    'status' => $this->request->getPost('status'),
                    'salary' => $this->request->getPost('salary'),
                    'gender' => $this->request->getPost('gender'),
                    'img' => 'default.jpg'
                ]);
                if ($save) {
                    session()->setFlashdata('notif', 'Data berhasil disimpan');
                    session()->setFlashdata('param', 1);
                    return redirect()->to('/karyawan');
                } else {
                    session()->setFlashdata('notif', 'Proses gagal');
                    session()->setFlashdata('param', 0);
                    return redirect()->to('/karyawan');
                }
            }
        }
    }

    //--------------------------------------------------------------------

}
