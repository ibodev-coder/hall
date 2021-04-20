<?php

namespace App\Controllers;

class Newaccount extends BaseController
{
    public function __construct()
    {
        $this->user = new \App\Models\user_model();
        $this->role = new \App\Models\role_model();
        $this->validation = \Config\Services::validation();
        $this->userEntities = new \App\Entities\User();
        $this->karyawan = new \App\Models\karyawan_model();
    }
    public function index($id)
    {
        $role = $this->role->where('id !=', 1)->findAll();
        $karyawan = $this->karyawan->where('id', $id)->first();
        $data = [
            'page_title' => 'Create Account | Hallroastery',
            'role' => $role,
            'karyawan' => $karyawan,
            'validation' => $this->validation,
        ];
        return view('pages/account/index', $data);
    }
    public function save()
    {
        $field = [
            'username' => [
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'Username wajib di isi',
                    'is_unique' => 'Username telah terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email wajib di isi',
                    'is_unique' => 'Email telah terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Password tidak sama',
                    'required' => 'Isi Password'
                ]
            ]
        ];

        $post = $this->request->getPost();
        $validate = $this->validate($field);
        $id = $this->request->getPost('id');
        $input = [
            'username' => $post['username'],
            'email' => $post['email'],
            'password' => $post['password'],
            'role_id' => $post['role_id'],
            'avatar' => 'default.png',
            'create_at' => date('Y-m-d h:i:s'),
            'is_active' => 1
        ];

        if ($post) {
            if (!$validate) {
                return redirect()->to('/newaccount/' . $id)->withInput()->with('validation', $this->validation);
            } else {
                $this->userEntities->fill($input);
                $save = $this->user->save($this->userEntities);
                if (!$save) {
                    session()->setFlashdata('notif', 'Ada kesalahan, proses gagal');
                    session()->setFlashdata('param', 0);
                    return redirect()->to('/karyawan');
                } else {
                    $this->karyawan->set(['account' => 1])->where('id', $id)->update();
                    session()->setFlashdata('notif', 'Akun berhasil di tambahkan');
                    session()->setFlashdata('param', 1);
                    return redirect()->to('/karyawan');
                }
            }
        }
        // dd($this->validate($field));
    }


    //--------------------------------------------------------------------

}
