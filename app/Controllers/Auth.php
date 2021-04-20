<?php

namespace App\Controllers;

use CodeIgniter\Model;

class Auth extends BaseController
{

    public function __construct()
    {
        // helper(['form', 'url']);
        $this->user = new \App\Models\user_model();
        $this->validation = \Config\Services::validation();
        $this->userEntities = new \App\Entities\User();
    }
    public function index()
    {

        $check_owner = $this->user->where('role_id', 1)->findAll();
        if ($check_owner) {
            return redirect()->to(base_url('/login'));
        } else {
            return redirect()->to(base_url('/register'));
        }
    }
    public function register()
    {

        $data = [
            'page_title' => 'Create Account | Hall Roastery',
            'validation' => \Config\Services::validation(),
        ];
        $user = [
            'username' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'min_length' => 'Username minimal 5 karakter'
                ]
            ],
            'email' => ['rules' => 'required|valid_email'],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'min_length' => 'Password minimal 6 karakter'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Password tidak cocok'
                ]
            ],
        ];

        if ($this->request->getPost()) {
            $post = $this->request->getPost();
            $validate = $this->validate($user);

            if (!$validate) {

                return redirect()->to('/register')->withInput()->with('validation', $this->validation);
            } else {

                $this->userEntities->fill($post);
                $this->userEntities->role_id = 1;
                $this->userEntities->is_active = 1;
                $this->userEntities->avatar = 'default.png';
                $this->userEntities->created_at = date('Y-m-d h:i:s');
                $this->user->save($this->userEntities);

                session()->setFlashdata('message', '<div class="alert alert-success" role="alert">Anda telah melakukan registrasi,activation akan di kirim ke email anda</div>');
                return redirect()->to('/login');
            }

            // return $this->_create();
        }
        // View
        return view('auth/register', $data);
    }

    public function login()
    {

        $data = [
            'page_title' => 'Login | Hall Roastery',
            'validation' => \Config\Services::validation(),
        ];
        $field = [
            'username' => [
                'rules' => 'required',

            ],
            'password' => [
                'rules' => 'required',

            ]
        ];
        if ($this->request->getPost()) {
            $post = $this->request->getPost();
            $validate = $this->validate($field);
            if (!$validate) {
                return redirect()->to('/login')->withInput()->with('validation', $this->validation);
            } else {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $checkUser = $this->user->where('username', $username)->first();
                if ($checkUser) {
                    if (!$checkUser->is_active == 0) {
                        if (password_verify($password, $checkUser->password)) {
                            $setSession = [
                                'username' => $checkUser->username,
                                'id' => $checkUser->id,
                                'role' => $checkUser->role_id,
                                'isLogged' => true
                            ];
                            // Check Role
                            session()->set($setSession);
                            if (user()->role_id == 1) {
                                $segment = '/owner';
                            } elseif (user()->role_id == 2) {
                                $segment = '/admin';
                            } elseif (user()->role_id == 3) {
                                $segment = '/kasir';
                            } else {
                                $segment = '/dapur';
                            }
                            return redirect()->to(base_url('/' . $segment));
                        } else {
                            session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Password salah,silahkan coba kembali</div>');
                        }
                    } else {
                        session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Account anda belum aktif,atau di nonaktifkan</div>');
                    }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Username tidak ditemukan</div>');
                }
            }
        }

        return view('auth/login', $data);
    }
    public function logout()
    {
        session()->setFlashdata('message', '<div class="alert alert-danger" role="alert">Anda telah logout</div>');
        session()->destroy();
        return redirect()->to('/login');
    }

    //--------------------------------------------------------------------

}
