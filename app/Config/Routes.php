<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Specific routes must come BEFORE the generic (:segment) route
$routes->get('survey/getInstansi', 'Survey::getInstansi');
$routes->post('survey/submit', 'Survey::submit');

// Generic route for unit slugs (e.g., survey/sidigi)
$routes->get('survey/(:segment)', 'Survey::index/$1');
