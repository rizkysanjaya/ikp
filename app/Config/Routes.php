<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'Dashboard::index');

// Specific routes must come BEFORE the generic (:segment) route
$routes->get('survey/getInstansi', 'Survey::getInstansi');
$routes->post('survey/submit', 'Survey::submit');

// Generic route for unit slugs (e.g., survey/sidigi)
$routes->get('survey/(:segment)', 'Survey::index/$1');
