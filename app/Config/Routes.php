<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// Dashboard
$routes->group('dashboard', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('getUpdates', 'Dashboard::getUpdates');
});

// Admin
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {
    $routes->get('backup', 'Backup::index');
    $routes->get('backup/download', 'Backup::download'); // New Download Route
    
    // Menu
    $routes->group('', ['namespace' => 'App\Controllers\Admin\Menu'], function ($routes) {
        $routes->get('about', 'About::index');
        $routes->get('laporan', 'Laporan::index');
        $routes->get('responden', 'Responden::index');
        $routes->get('responden/delete/(:num)', 'Responden::delete/$1');
        $routes->get('users', 'Users::index');
        $routes->post('users/save', 'Users::save');
        $routes->get('users/delete/(:num)', 'Users::delete/$1');
    });

    // Master Data
    $routes->group('master', ['namespace' => 'App\Controllers\Admin\Master'], function ($routes) {
        $routes->get('instansi', 'Instansi::index');
        $routes->post('instansi/save', 'Instansi::save');
        $routes->get('instansi/toggle/(:segment)', 'Instansi::toggle/$1');
        $routes->get('instansi/delete/(:segment)', 'Instansi::delete/$1');
        $routes->get('pekerjaan', 'Pekerjaan::index');
        $routes->post('pekerjaan/save', 'Pekerjaan::save');
        $routes->get('pekerjaan/toggle/(:num)', 'Pekerjaan::toggle/$1');
        $routes->get('pekerjaan/delete/(:num)', 'Pekerjaan::delete/$1');
        $routes->get('pendidikan', 'Pendidikan::index');
        $routes->post('pendidikan/save', 'Pendidikan::save');
        $routes->get('pendidikan/toggle/(:segment)', 'Pendidikan::toggle/$1');
        $routes->get('pendidikan/delete/(:segment)', 'Pendidikan::delete/$1');
        $routes->get('unsur', 'Unsur::index');
        $routes->post('unsur/update', 'Unsur::update');
        $routes->get('unit', 'Unit::index');
        $routes->post('unit/save', 'Unit::save');
        $routes->get('unit/toggle/(:num)', 'Unit::toggle/$1');
        $routes->get('unit/delete/(:num)', 'Unit::delete/$1');
        $routes->get('pertanyaan', 'Pertanyaan::index');
        $routes->post('pertanyaan/save', 'Pertanyaan::save');

        $routes->get('pertanyaan/toggle/(:num)', 'Pertanyaan::toggle/$1');
        $routes->get('pertanyaan/delete/(:num)', 'Pertanyaan::delete/$1');
        $routes->get('jawaban', 'Jawaban::index');
        $routes->post('jawaban/save', 'Jawaban::save');
        $routes->get('jawaban/delete/(:num)', 'Jawaban::delete/$1');
    });
});

// Survey
$routes->group('survey', function ($routes) {
    $routes->get('getInstansi', 'Survey::getInstansi');
    $routes->post('submit', 'Survey::submit');
    $routes->get('(:segment)', 'Survey::index/$1');
});
