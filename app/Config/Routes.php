<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
//Routes for Category
$routes->get('/category', 'CategoryController::index');
$routes->get('/category/create', 'CategoryController::addCategory');
$routes->post('/category/save', 'CategoryController::saveCategory');
$routes->get('/category/edit/(:num)', 'CategoryController::editCategory/$1');
$routes->post('/category/update/(:num)', 'CategoryController::updateCategory/$1');
$routes->delete('/category/delete/(:num)', 'CategoryController::deleteCategory/$1');


//Routes for Product
$routes->get('/product', 'ProductController::index');
$routes->get('/product/create', 'ProductController::addProduct');
$routes->get('/testingbro', 'MainController::tes');
$routes->get('/testingbro/create', 'MainController::tambahKomik');
$routes->post('/testingbro/save', 'MainController::save');
$routes->get('komik/(:segment)', 'MainController::detailKomik/$1');
