<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// --=========================================|| USER ||================================================--
// YANG DI NAVBAR
$routes->get('/', 'Pengguna::dashboard');
$routes->get('/services', 'Pengguna::services');

//register google
$routes->get('/register', 'Pengguna::index_regis');
$routes->get('/register/proses', 'Pengguna::proses_regis');

// register biasa
$routes->post('/register/auth', 'Pengguna::regis_auth');
// $routes->get('/trefle', 'plant::index');

//login
$routes->get('/login', 'Pengguna::index_login');
$routes->get('/login/proses', 'Pengguna::proses_login');
$routes->post('/login/auth', 'Pengguna::auth');

//LOGOUT
$routes->get('/logout', 'Pengguna::logout');
$routes->get('/logout-berhasil', 'Pengguna::logout_pesan');

//user page
$routes->get('/user_page', 'Pengguna::home');

//PROFILE
$routes->get('/Pengguna/editProfile/(:any)', 'Pengguna::editProfile/$1');
$routes->post('/Pengguna/updateProfile/(:any)', 'Pengguna::updateProfile/$1');
$routes->get('/Pengguna/deleteProfile/(:any)', 'Pengguna::deleteProfile/$1'); 

// --=========================================|| TANAMAN ||================================================--

//tanaman
$routes->get('/plants', 'Tanaman::index');
$routes->get('/plants/search', 'Tanaman::search');

//VEGETABLE
$routes->get('/vegetable', 'Tanaman::vegetable');
$routes->get('/vegetable/load', 'Tanaman::loadVegetables');
$routes->get('/vegetable/search', 'Tanaman::search_vegetable');

// tanaman
// TAMBAH 
$routes->get('/tanaman/tambah/(:num)', 'Tanaman::tambah/$1');
$routes->post('/tanaman/tambah', 'Tanaman::simpanTanaman'); 

$routes->get('/tanaman/detail/(:num)', 'Tanaman::detail/$1');
$routes->get('/tanaman/delete/(:num)', 'Tanaman::delete/$1');
$routes->get('/tanaman/search', 'Tanaman::search');

//update delete tanaman
$routes->get('/tanaman/edit/(:num)', 'Tanaman::edit/$1');
$routes->post('/tanaman/update/(:num)', 'Tanaman::update/$1');

$routes->post('tanaman/update/(:num)', 'Tanaman::update/$1');
// --=========================================|| KEBUN ||================================================--

//tambah kebun
$routes->get('/buat_kebun', 'Kebun::index');
$routes->post('/buat', 'Kebun::buat');

//kelola kebun
$routes->get('/kebun', 'Kebun::kebun');
$routes->get('/kebun/kebun-(:any)', 'Kebun::kebunorang/$1');
$routes->get('/kebun/detail/(:num)', 'Kebun::detail/$1');
$routes->get('/kebun/edit/(:num)', 'Kebun::edit/$1');
$routes->post('/kebun/update/(:num)', 'Kebun::update/$1');
$routes->get('/kebun/delete/(:num)', 'Kebun::delete/$1');
// Semua Kebun
$routes->get('/kebun/semua-kebun', 'Kebun::allkebun');

//komentar
$routes->post('/kebun/komentar', 'Kebun::Komentar');

// --===================================|| IMAGE PROCESSING ||============================================--
//Upload Image Processing
$routes->get('/upload_gambar', 'Tanaman::form_deteksi');
$routes->post('/tanaman/hasil', 'Tanaman::hasil');