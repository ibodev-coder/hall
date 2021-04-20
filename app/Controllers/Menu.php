<?php

namespace App\Controllers;

class Menu extends BaseController
{
    public function index()
    {
        $menu = new \App\Models\menu_model();
        $submenu = new \App\Models\sub_menu_model();
        $role = new \App\Models\role_model();
        // Query
        // Menu
        $menu->select(['role.id', 'menu.name as menu', 'role.name as role', 'menu.id as menu_id', 'role_id']);
        $menu->join('role', 'role_id=role.id');
        $getMenu = $menu->get()->getResultArray();
        // Role
        $getRole = $role->findAll();

        $data = [
            'page_title' => 'Manage Menu | Hall Roastery Coffe Company',
            'getMenu' => $getMenu,
            'role' => $getRole,
            'validation' => \Config\Services::validation(),

        ];

        return view('pages/menu/index', $data);
    }
    public function addMenu()
    {
        $validate = \Config\Services::validation();
        $menu = new \App\Models\menu_model();
        $post = $this->request->getPost();
        foreach ($post['role_id'] as $key => $val) {
            $data[] = array(
                'name' => $post['name'],
                'role_id' => $post['role_id'][$key]
            );
        };
        if ($menu->insertBatch($data)) {
            session()->setFlashdata('notif', 'Data disimpan');
            session()->setFlashdata('param', 1);
            return redirect()->to('/menu');
        } else {
            session()->setFlashdata('notif', 'Data gagal disimpan');
            return redirect()->to('/menu');
        }
    }
    public function hapusMenu($menu_id)
    {
        $menu = new \App\Models\menu_model();
        if ($menu->delete($menu_id)) {
            session()->setFlashdata('notif', 'Data dihapus');
            session()->setFlashdata('param', 1);
            return redirect()->to('/menu');
        } else {
            session()->setFlashdata('notif', 'Proses gagal');
            session()->setFlashdata('param', 0);
        }
    }
    public function updateMenu($menu_id)
    {

        $role = new \App\Models\role_model();
        $menu = new \App\Models\menu_model();
        $getmenu = $menu->where('id', $menu_id)->get()->getResultArray();

        $data = [
            'page_title' => 'Manage Menu | Hall Roastery Coffe Company',
            'getMenu' => $getmenu,
            // 'role' => $role->where('id', $getmenu->role_id)->first()
        ];

        $post = $this->request->getPost();

        return view('pages/menu/index', $data);

        // if ($post) {
        //     if ($menu->update($menu_id, $post)) {
        //         session()->setFlashdata('notif', 'Data disimpan');
        //         session()->setFlashdata('param', 1);
        //         return redirect()->to('/menu');
        //     } else {
        //         session()->setFlashdata('notif', 'Proses gagal');
        //         session()->setFlashdata('param', 0);
        //         return redirect()->to('/menu');
        //     }
        // } else {
        //     session()->setFlashdata('notif', 'Data tidak ditemukan');
        //     session()->setFlashdata('param', 0);
        //     return redirect()->to('/menu');
        // }
    }

    //--------------------------------------------------------------------

}
