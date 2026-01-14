<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('survey/(:segment)', 'Survey::index/$1');
$routes->post('survey/submit', 'Survey::submit');
