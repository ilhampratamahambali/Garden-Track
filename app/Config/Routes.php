<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// --=========================================|| USER ||================================================--
// YANG DI NAVBAR
$routes->get('/', 'User::dashboard');
$routes->get('/services', 'User::services');

//register google
$routes->get('register', 'User::index_regis');
$routes->get('register/proses', 'User::proses_regis');

// register biasa
$routes->post('register/auth', 'User::regis_auth');
// $routes->get('/trefle', 'plant::index');

//login
$routes->get('login', 'User::index_login');
$routes->get('login/proses', 'User::proses_login');
$routes->post('login/auth', 'User::auth');

//LOGOUT
$routes->get('logout', 'User::logout');

//user page
$routes->get('user_page', 'User::home');

// --=========================================|| TANAMAN ||================================================--

//tanaman
$routes->get('/plants', 'Plants::index');
$routes->get('plants/search', 'Plants::search');

//VEGETABLE
$routes->get('/vegetable', 'Plants::vegetable');
$routes->get('vegetable/loadMore/(:num)', 'Plants::loadMore/$1');
// tanaman
$routes->get('/tanaman/tambah/(:num)', 'Plants::formTambah/$1'); // Form tambah tanaman
$routes->post('/tanaman/tambah', 'Plants::tambah'); // Proses tambah tanaman
$routes->get('/tanaman/detail/(:num)', 'Plants::detail/$1');
$routes->get('/tanaman/delete/(:num)', 'Plants::delete/$1');
$routes->get('/tanaman/search', 'Plants::search');

// --=========================================|| KEBUN ||================================================--

//tambah kebun
$routes->get('buat_kebun', 'Kebun::index');
$routes->get('/kebun', 'Kebun::index');
$routes->post('/buat', 'Kebun::buat');

//kelola kebun
$routes->get('kelola_kebun', 'Kebun::index_kelola');
$routes->get('/kebun/detail/(:num)', 'Kebun::detail/$1');
$routes->get('/kebun/edit/(:num)', 'Kebun::edit/$1');
$routes->post('/kebun/update/(:num)', 'Kebun::update/$1');
$routes->get('/kebun/delete/(:num)', 'Kebun::delete/$1');