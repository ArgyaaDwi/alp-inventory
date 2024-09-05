<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for Auth
$routes->get('/register', 'Auth::register');
$routes->post('/register/save', 'Auth::registerProcess');
$routes->get('/login', 'Auth::login');
$routes->post('/login/save', 'Auth::loginProcess');
$routes->post('/logout', 'Auth::logout');

// Routes for Admin
$routes->group('admin', ['filter' => 'role:1'], function ($routes) {
    $routes->get('/', 'MainController::dashboardAdmin');
    // Routes for manage category
    $routes->get('category', 'CategoryController::viewCategory');
    $routes->get('category/detail/(:num)', 'CategoryController::detailCategory/$1');
    $routes->get('category/create', 'CategoryController::addCategory');
    $routes->post('category/save', 'CategoryController::saveCategory');
    $routes->get('category/edit/(:num)', 'CategoryController::editCategory/$1');
    $routes->post('category/update/(:num)', 'CategoryController::updateCategory/$1');
    $routes->delete('category/delete/(:num)', 'CategoryController::deleteCategory/$1');
    // Routes for manage brand
    $routes->get('brand', 'BrandController::viewBrand');
    $routes->get('brand/detail/(:num)', 'BrandController::detailBrand/$1');
    $routes->get('brand/create', 'BrandController::addBrand');
    $routes->post('brand/save', 'BrandController::saveBrand');
    $routes->get('brand/edit/(:num)', 'BrandController::editBrand/$1');
    $routes->post('brand/update/(:num)', 'BrandController::updateBrand/$1');
    $routes->delete('brand/delete/(:num)', 'BrandController::deleteBrand/$1');
    // Routes for manage product
    $routes->get('product', 'ProductController::viewProduct');
    $routes->get('product/detail/(:num)', 'ProductController::detailProduct/$1');
    $routes->get('product/create', 'ProductController::addProduct');
    $routes->post('product/save', 'ProductController::saveProduct');
    $routes->get('product/edit/(:num)', 'ProductController::editProduct/$1');
    $routes->post('product/update/(:num)', 'ProductController::updateProduct/$1');
    $routes->delete('product/delete/(:num)', 'ProductController::deleteProduct/$1');
    // Routes for manage product stock
    $routes->get('product/create/stock', 'ProductController::createProductStock');
    $routes->post('product/save/stock', 'ProductController::saveProductStock');
    $routes->get('product/edit/stock/(:num)', 'ProductController::showEditProductStockForm/$1');
    $routes->post('product/update/stock/(:num)', 'ProductController::updateProductStock/$1');
    // $routes->get('uploads/(:any)', 'ProductController::getImage/$1');
    // Routes for manage department
    $routes->get('department', 'DepartmentController::viewDepartment');
    $routes->get('department/detail/(:num)', 'DepartmentController::detailDepartment/$1');
    $routes->get('department/create', 'DepartmentController::addDepartment');
    $routes->post('department/save', 'DepartmentController::saveDepartment');
    $routes->get('department/edit/(:num)', 'DepartmentController::editDepartment/$1');
    $routes->post('department/update/(:num)', 'DepartmentController::updateDepartment/$1');
    $routes->delete('department/delete/(:num)', 'DepartmentController::deleteDepartment/$1');
    // Routes for manage profile
    $routes->get('profile', 'MainController::viewProfile');
    $routes->get('profile/edit', 'MainController::editProfile');
    $routes->post('profile/update', 'MainController::updateProfile');
    // Routes for manage employee
    $routes->get('employees', 'EmployeeController::viewEmployee');
    $routes->get('employees/detail/(:num)', 'EmployeeController::detailEmployee/$1');
    $routes->get('employees/create', 'EmployeeController::addEmployee');
    $routes->post('employees/save', 'EmployeeController::saveEmployee');
    // $routes->get('uploads/employees/(:any)', 'EmployeeController::getImage/$1');
    $routes->get('uploads/(:any)', 'EmployeeController::getImage/$1');
    $routes->get('employees/edit/(:num)', 'EmployeeController::editEmployee/$1');
    $routes->post('employees/update/(:num)', 'EmployeeController::updateEmployee/$1');
    $routes->get('employees/toggle_status/(:num)', 'EmployeeController::statusChanger/$1');
    $routes->delete('employees/delete/(:num)', 'EmployeeController::deleteEmployee/$1');
    // Routes for manage transaction
    $routes->get('transaction', 'TransactionController::viewAllocation');
    $routes->get('transaction/create', 'TransactionController::allocateProduct');
    $routes->post('transaction/save', 'TransactionController::saveAllocation');
    $routes->get('transaction/detail/(:num)', 'TransactionController::detailAllocation/$1');
    // Routes for manage area
    $routes->get('area', 'AreaController::viewArea');
    $routes->get('area/detail/(:num)', 'AreaController::detailArea/$1');
    $routes->get('area/create', 'AreaController::addArea');
    $routes->post('area/save', 'AreaController::saveArea');
    $routes->get('area/edit/(:num)', 'AreaController::editArea/$1');
    $routes->post('area/update/(:num)', 'AreaController::updateArea/$1');
    $routes->delete('area/delete/(:num)', 'AreaController::deleteArea/$1');
});
$routes->get('admin/transaction/pdf', 'TransactionController::generateAllocationPdf');
$routes->get('admin/transaction/pdf/detail/(:num)', 'TransactionController::generateDetailAllocationPDF/$1');

$routes->get('uploads/profile/(:any)', 'MainController::getImage/$1');
$routes->get('uploads/product/(:any)', 'ProductController::getImage/$1');
$routes->get('product/getStockDetails/(:num)', 'TransactionController::getStockDetails/$1');

$routes->group('user', ['filter' => 'role:2'], function ($routes) {
    $routes->get('/user', 'MainController::userPage');
});



//Routes for Category
// $routes->get('/admin/category', 'CategoryController::index');
// $routes->get('/admin/category/detail/(:num)', 'CategoryController::viewCategory/$1');
// $routes->get('/admin/category/create', 'CategoryController::addCategory');
// $routes->post('/admin/category/save', 'CategoryController::saveCategory');
// $routes->get('/admin/category/edit/(:num)', 'CategoryController::editCategory/$1');
// $routes->post('/admin/category/update/(:num)', 'CategoryController::updateCategory/$1');
// $routes->delete('/admin/category/delete/(:num)', 'CategoryController::deleteCategory/$1');

//Routes for Product
// $routes->get('/admin/product', 'ProductController::index');
// $routes->get('/admin/product/create', 'ProductController::addProduct');
// $routes->post('/admin/product/save', 'ProductController::saveProduct');
// $routes->get('/admin/uploads/(:any)', 'ProductController::getImage/$1');
// $routes->get('/admin/product/detail/(:num)', 'ProductController::viewProduct/$1');
// $routes->get('/admin/product/edit/(:num)', 'ProductController::editProduct/$1');
// $routes->post('/admin/product/update/(:num)', 'ProductController::updateProduct/$1');
// $routes->delete('/admin/product/delete/(:num)', 'ProductController::deleteProduct/$1');

// Routes for Department
// $routes->get('/admin/department', 'DepartmentController::index');
// $routes->get('/admin/department/detail/(:num)', 'DepartmentController::viewDepartment/$1');
// $routes->get('/admin/department/create', 'DepartmentController::addDepartment');
// $routes->post('/admin/department/save', 'DepartmentController::saveDepartment');
// $routes->get('/admin/department/edit/(:num)', 'DepartmentController::editDepartment/$1');
// $routes->post('/admin/department/update/(:num)', 'DepartmentController::updateDepartment/$1');
// $routes->delete('/admin/department/delete/(:num)', 'DepartmentController::deleteDepartment/$1');

// Routes for Profile
// $routes->get('/admin/profile', 'MainController::viewProfile');
// $routes->get('/admin/profile/edit', 'MainController::editProfile');
// $routes->post('/admin/profile/update', 'MainController::updateProfile');

// Routes for Employee
// $routes->get('/admin/employees', 'EmployeeController::index');
// $routes->get('/admin/employees/detail/(:num)', 'EmployeeController::viewEmployee/$1');
// $routes->get('/admin/employees/create', 'EmployeeController::addEmployee');
// $routes->post('/admin/employees/save', 'EmployeeController::saveEmployee');
// $routes->get('/admin/uploads/employees/(:any)', 'EmployeeController::getImage/$1');
// $routes->get('/admin/employees/edit/(:num)', 'EmployeeController::editEmployee/$1');
// $routes->post('/admin/employees/update/(:num)', 'EmployeeController::updateEmployee/$1');
// $routes->get('/admin/employees/toggle_status/(:num)', 'EmployeeController::statusChanger/$1');
// $routes->delete('/admin/employees/delete/(:num)', 'EmployeeController::deleteEmployee/$1');
