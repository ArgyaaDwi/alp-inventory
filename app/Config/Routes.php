<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('/category', 'CategoryController::index');
$routes->get('/product', 'ProductController::index');
$routes->get('/product/create', 'ProductController::addProduct');
$routes->get('/testingbro', 'MainController::tes');
$routes->get('/testingbro/create', 'MainController::tambahKomik');
$routes->post('/testingbro/save', 'MainController::save');
$routes->get('komik/(:segment)', 'MainController::detailKomik/$1');
