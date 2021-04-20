<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
// Auth
$routes->add('/register', 'Auth::register', ['filter' => 'register']);
$routes->add('/login', 'Auth::login');
$routes->add('/logout', 'Auth::logout');
// Menu
$routes->get('/hapusmenu/(:any)', 'Menu::hapusmenu/$1');
$routes->get('/updatemenu/(:any)', 'Menu::updatemenu/$1');
// Owner
$routes->get('/owner', 'Owner::index', ['filter' => 'access:1']);
// Karyawan
$routes->get('/karyawan', 'Karyawan::index', ['filter' => 'access:2']);
// Item
$routes->get('/item', 'Item::index', ['filter' => 'access:2']);
$routes->get('/item/delete', 'Item::index', ['filter' => 'access:2']);
$routes->get('/item/delete/(:num)', 'Item::delete/$1', ['filter' => 'access:2']);
// Kategori
$routes->get('/kategori', 'Kategori::index', ['filter' => 'access:2']);
$routes->add('/kategori/view', 'Kategori::index', ['filter' => 'access:2']);
$routes->add('/kategori/delete', 'Kategori::index', ['filter' => 'access:2']);
$routes->add('/kategori/delete/(:any)', 'Kategori::delete/$1', ['filter' => 'access:2']);
$routes->add('/kategori/view/(:any)', 'Kategori::view/$1', ['filter' => 'access:2']);
$routes->add('/kategori/update/(:any)', 'Kategori::update/$1', ['filter' => 'access:2']);
// Harga
$routes->get('/harga', 'Harga::index', ['filter' => 'access:2']);
$routes->add('/harga/save', 'Harga::save', ['filter' => 'access:2']);
$routes->add('/harga/delete/(:any)', 'Harga::delete/$1', ['filter' => 'access:2']);
$routes->add('/harga/update/(:any)', 'Harga::update/$1', ['filter' => 'access:2']);
$routes->add('/harga/view/(:any)', 'Harga::view/$1', ['filter' => 'access:2']);
// Bahan
$routes->get('/bahan', 'Bahan::index', ['filter' => 'access:2']);
$routes->get('/bahan/save', 'Bahan::save', ['filter' => 'access:2']);
$routes->get('/bahan/view/(:any)', 'Bahan::view/$1', ['filter' => 'access:2']);
$routes->get('/bahan/update/(:any)', 'Bahan::update/$1', ['filter' => 'access:2']);
// Kasir
$routes->get('/kasir', 'Kasir::index', ['filter' => 'access:2']);
// Karyawan
$routes->get('/karyawan', 'Karyawan::index', ['filter' => 'access:2']);
$routes->get('/karyawan/addKaryawan', 'Karyawan::addKaryawan', ['filter' => 'access:2']);
// Create Accout
$routes->get('/newaccount', function () {
	return redirect()->to('/karyawan');
});
$routes->get('/newaccount/(:any)', 'Newaccount::index/$1', ['filter' => 'access:2']);
$routes->get('/newaccount/save', 'Newaccount::save', ['filter' => 'access:2']);
$routes->get('/newaccount/delete', 'Newaccount::delete', ['filter' => 'access:2']);
// Laporan
// Transaksi
// $routes->get('/laporan/transaksi', 'Laporan::transaksi', ['filter' => 'access:2']);

// Level Access Management
// Admin Owner
$routes->get('/menu', 'Menu::index', ['filter' => 'access:2']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
