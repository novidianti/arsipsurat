<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login', 'Login::login_action');
$routes->post('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get('logout', 'Login::logout');

$routes->get('admin/home', 'Admin\Home::index', ['filter' => 'adminFilter']);
$routes->get('admin/jenis', 'Admin\Jenis::index', ['filter' => 'adminFilter']);
$routes->get('admin/jenis/create', 'Admin\Jenis::create', ['filter' => 'adminFilter']);
$routes->post('admin/jenis/store', 'Admin\Jenis::store', ['filter' => 'adminFilter']);
$routes->get('admin/jenis/edit/(:segment)', 'Admin\Jenis::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/jenis/update/(:segment)', 'Admin\Jenis::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/jenis/delete/(:segment)', 'Admin\Jenis::delete/$1', ['filter' => 'adminFilter']);

$routes->get('admin/disposisi', 'Admin\Disposisi::index', ['filter' => 'adminFilter']);
$routes->get('admin/disposisi/create', 'Admin\Disposisi::create', ['filter' => 'adminFilter']);
$routes->post('admin/disposisi/store', 'Admin\Disposisi::store', ['filter' => 'adminFilter']);
$routes->get('admin/disposisi/edit/(:segment)', 'Admin\Disposisi::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/disposisi/update/(:segment)', 'Admin\Disposisi::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/disposisi/delete/(:segment)', 'Admin\Disposisi::delete/$1', ['filter' => 'adminFilter']);

$routes->get('admin/users', 'Admin\Users::index', ['filter' => 'adminFilter']);
$routes->get('admin/users/create', 'Admin\Users::create', ['filter' => 'adminFilter']);
$routes->post('admin/users/store', 'Admin\Users::store', ['filter' => 'adminFilter']);
$routes->get('admin/users/edit/(:segment)', 'Admin\Users::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/users/update/(:segment)', 'Admin\Users::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/users/delete/(:segment)', 'Admin\Users::delete/$1', ['filter' => 'adminFilter']);

$routes->get('admin/dokumen', 'Admin\Dokumen::index', ['filter' => 'adminFilter']);
$routes->get('admin/dokumen/detail/(:num)', 'Admin\Dokumen::detail/$1', ['filter' => 'adminFilter']);
$routes->get('admin/dokumen/create', 'Admin\Dokumen::create', ['filter' => 'adminFilter']);
$routes->post('admin/dokumen/store', 'Admin\Dokumen::store', ['filter' => 'adminFilter']);
$routes->get('admin/dokumen/edit/(:segment)', 'Admin\Dokumen::edit/$1', ['filter' => 'adminFilter']);
$routes->post('admin/dokumen/update/(:segment)', 'Admin\Dokumen::update/$1', ['filter' => 'adminFilter']);
$routes->get('admin/dokumen/delete/(:segment)', 'Admin\Dokumen::delete/$1', ['filter' => 'adminFilter']);


$routes->get('kepala/home', 'Kepala\Home::index', ['filter' => 'kepalaFilter']);
