<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); 
$routes->get('/about', 'About::index'); 
$routes->get('/services', 'Services::index'); 
$routes->match(['get', 'post'], '/contact', 'Contact::index'); 
$routes->get('/register', 'Register::index'); 
$routes->post('/register', 'Register::create');
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');

$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/create', 'Dashboard::create');
$routes->post('/dashboard/store', 'Dashboard::store');
$routes->get('/dashboard/view/(:num)', 'Dashboard::view/$1');
$routes->get('/dashboard/edit/(:num)', 'Dashboard::edit/$1');
$routes->post('/dashboard/update/(:num)', 'Dashboard::update/$1');
$routes->post('/dashboard/delete/(:num)', 'Dashboard::delete/$1');