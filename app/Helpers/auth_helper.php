<?php


if (!function_exists('user')) {
    function user()
    {
        $user = new \App\Models\user_model();
        return $user->where('id', session()->get('id'))->first();
    }
}

if (!function_exists('menu')) {
    function menu()
    {
        $menu = new \App\Models\menu_model();
        return  $menu->where('role_id', session()->get('role'))->findAll();
    }
}
if (!function_exists('sub_menu')) {
    function sub_menu($menu_id)
    {
        $menu = new \App\Models\sub_menu_model();
        return $menu->where('menu_id', $menu_id)->findAll();
    }
}
if (!function_exists('set_menu')) {
    function set_menu()
    {
        $menu = new \App\Models\menu_model();
        return  $menu->findAll();
    }
}
if (!function_exists('set_sub_menu')) {
    function set_sub_menu()
    {
        $menu = new \App\Models\sub_menu_model();
        return $menu->findAll();
    }
}
