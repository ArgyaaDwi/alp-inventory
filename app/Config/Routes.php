<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');

//Routes for Category
$routes->get('/category', 'CategoryController::index');
$routes->get('/category/detail/(:num)', 'CategoryController::viewCategory/$1');
$routes->get('/category/create', 'CategoryController::addCategory');
$routes->post('/category/save', 'CategoryController::saveCategory');
$routes->get('/category/edit/(:num)', 'CategoryController::editCategory/$1');
$routes->post('/category/update/(:num)', 'CategoryController::updateCategory/$1');
$routes->delete('/category/delete/(:num)', 'CategoryController::deleteCategory/$1');

//Routes for Product
$routes->get('/product', 'ProductController::index');
$routes->get('/product/create', 'ProductController::addProduct');
$routes->post('/product/save', 'ProductController::saveProduct');
$routes->get('/uploads/(:any)', 'ProductController::getImage/$1');
$routes->get('/product/detail/(:num)', 'ProductController::viewProduct/$1');
$routes->get('/product/edit/(:num)', 'ProductController::editProduct/$1');
$routes->post('/product/update/(:num)', 'ProductController::updateProduct/$1');
$routes->delete('/product/delete/(:num)', 'ProductController::deleteProduct/$1');

//Routes for Testing
$routes->get('/testingbro', 'MainController::tes');
$routes->get('/testingbro/create', 'MainController::tambahKomik');
$routes->post('/testingbro/save', 'MainController::save');
$routes->get('komik/(:segment)', 'MainController::detailKomik/$1');

$routes->get('/department', 'DepartmentController::index');
$routes->get('/department/detail/(:num)', 'DepartmentController::viewDepartment/$1');
$routes->get('/department/create', 'DepartmentController::addDepartment');
$routes->post('/department/save', 'DepartmentController::saveDepartment');
$routes->get('/department/edit/(:num)', 'DepartmentController::editDepartment/$1');
$routes->post('/department/update/(:num)', 'DepartmentController::updateDepartment/$1');
$routes->delete('/department/delete/(:num)', 'DepartmentController::deleteDepartment/$1');

$routes->get('/user/profile', 'UserController::viewProfile');

$routes->get('/employees', 'EmployeeController::index');
$routes->get('/employees/detail/(:num)', 'EmployeeController::viewEmployee/$1');
