<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =============================================================================
// PUBLIC ROUTES
// =============================================================================

// Home
$routes->get('/', 'Home::index');
$routes->get('/tentang', 'Home::tentang');
$routes->get('/kontak', 'Home::kontak');

// Auth
$routes->get('/auth/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::doLogin');
$routes->get('/auth/register', 'Auth::register');
$routes->post('/auth/register', 'Auth::doRegister');
$routes->get('/auth/google-callback', 'Auth::googleCallback');
$routes->get('/auth/logout', 'Auth::logout');

// Edukasi
$routes->get('/edukasi', 'Edukasi::index');
$routes->get('/edukasi/(:segment)', 'Edukasi::detail/$1');

// Produk
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/(:segment)', 'Produk::detail/$1');

// TPS
$routes->get('/tps', 'Tps::index');
$routes->get('/tps/detail/(:num)', 'Tps::detail/$1');
$routes->get('/api/tps', 'Tps::apiList');
$routes->get('/api/tps/nearby', 'Tps::apiNearby');

// =============================================================================
// MEMBER ROUTES (Anggota)
// =============================================================================

// Keranjang
$routes->get('/keranjang', 'Keranjang::index');
$routes->post('/keranjang/add', 'Keranjang::add');
$routes->post('/keranjang/update', 'Keranjang::update');
$routes->post('/keranjang/remove', 'Keranjang::remove');
$routes->get('/keranjang/remove/(:num)', 'Keranjang::remove/$1');
$routes->get('/api/keranjang/count', 'Keranjang::count');

// Checkout
$routes->get('/checkout', 'Checkout::index');
$routes->post('/checkout/proses', 'Checkout::proses');
$routes->get('/checkout/sukses/(:segment)', 'Checkout::sukses/$1');

// Pesanan
$routes->get('/pesanan', 'Pesanan::index');
$routes->get('/pesanan/(:segment)', 'Pesanan::detail/$1');
$routes->post('/pesanan/batal/(:segment)', 'Pesanan::batal/$1');

// Profil
$routes->get('/profil', 'Profil::index');
$routes->post('/profil/update', 'Profil::update');
$routes->post('/profil/ubah-password', 'Profil::ubahPassword');

// =============================================================================
// ADMIN ROUTES
// =============================================================================

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    // Dashboard
    $routes->get('/', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // Artikel
    $routes->get('artikel', 'Artikel::index');
    $routes->get('artikel/tambah', 'Artikel::tambah');
    $routes->post('artikel/simpan', 'Artikel::simpan');
    $routes->get('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->post('artikel/update/(:num)', 'Artikel::update/$1');
    $routes->post('artikel/hapus/(:num)', 'Artikel::hapus/$1');

    // Produk
    $routes->get('produk', 'Produk::index');
    $routes->get('produk/tambah', 'Produk::tambah');
    $routes->post('produk/simpan', 'Produk::simpan');
    $routes->get('produk/edit/(:num)', 'Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Produk::update/$1');
    $routes->post('produk/hapus/(:num)', 'Produk::hapus/$1');

    // TPS
    $routes->get('tps', 'Tps::index');
    $routes->get('tps/tambah', 'Tps::tambah');
    $routes->post('tps/simpan', 'Tps::simpan');
    $routes->get('tps/edit/(:num)', 'Tps::edit/$1');
    $routes->post('tps/update/(:num)', 'Tps::update/$1');
    $routes->post('tps/hapus/(:num)', 'Tps::hapus/$1');

    // Pesanan
    $routes->get('pesanan', 'Pesanan::index');
    $routes->get('pesanan/detail/(:num)', 'Pesanan::detail/$1');
    $routes->post('pesanan/status/(:num)', 'Pesanan::updateStatus/$1');

    // Anggota
    $routes->get('anggota', 'Anggota::index');
    $routes->get('anggota/detail/(:num)', 'Anggota::detail/$1');
    $routes->post('anggota/status/(:num)', 'Anggota::updateStatus/$1');
    $routes->post('anggota/hapus/(:num)', 'Anggota::hapus/$1');
});
