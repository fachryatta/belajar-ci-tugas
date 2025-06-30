<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('login', 'AuthController::login');
$routes->post(from: 'login', to: 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('faq', 'FaqController::index', ['filter' => 'auth']);
$routes->get('contact', 'ContactController::index', ['filter' => 'auth']);

$routes->group('kategori', function($routes) {
    $routes->get('/', 'KategoriController::index');                // Tampilkan semua kategori
    $routes->get('create', 'KategoriController::create');          // Tampilkan form tambah kategori
    $routes->post('store', 'KategoriController::store');           // Proses simpan kategori baru
    $routes->post('edit/(:any)', 'KategoriController::edit/$1');    // Tampilkan form edit kategori
    $routes->post('update/(:any)', 'KategoriController::update/$1'); // Proses update kategori
    $routes->get('delete/(:any)', 'KategoriController::delete/$1'); // Hapus kategori
});

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);

$routes->resource('api', ['controller' => 'apiController']);

$routes->group('diskon', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Diskon::index');
    $routes->get('create', 'Diskon::create');
    $routes->post('store', 'Diskon::store');
    $routes->post('edit/(:any)', 'Diskon::edit/$1');
    $routes->post('update/(:any)', 'Diskon::update/$1');
    $routes->post('delete/(:any)', 'Diskon::delete/$1');
});

