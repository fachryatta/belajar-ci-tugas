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

$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']);

// Route Kategori
$routes->get('kategori', 'KategoriController::index');
$routes->post('kategori/create', 'KategoriController::create');
$routes->post('kategori/edit/(:num)', 'KategoriController::edit/$1');
$routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');


