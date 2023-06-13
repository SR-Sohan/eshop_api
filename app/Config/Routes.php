<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get("/login","AuthController::index");
$routes->post("/login","AuthController::index");
$routes->get("/register","AuthController::register");
$routes->post("/register","AuthController::register");

$routes->get("/","DashboardController::index",['filter' => 'admin']);

$routes->get('/api/users','UserController::getUser');
$routes->post('/api/users', 'UserController::createUser');

$routes->get("/api/categories","CategoryController::getCategory");
$routes->get("/api/categories/(:any)","CategoryController::getCategoryById/$1");
$routes->post("/api/categories","CategoryController::postCategory");

$routes->get("/categories","CategoryController::dGetCategories",['filter' => 'admin']);
$routes->get("/add-categories","CategoryController::dPostCategories",['filter' => 'admin']);
$routes->post("/add-categories","CategoryController::dPostCategories",['filter' => 'admin']);
$routes->get('/deletecategories/(:num)', 'CategoryController::deleteCategory/$1',['filter' => 'admin']);


$routes->get("/subcategories","SubCategoryController::dGetSubCategories",['filter' => 'admin']);
$routes->get("/add-subcategories","SubCategoryController::dPostSubCategories",['filter' => 'admin']);
$routes->post("/add-subcategories","SubCategoryController::dPostSubCategories",['filter' => 'admin']);
$routes->get('/deletesubcategories/(:num)', 'SubCategoryController::deleteSubCategory/$1',['filter' => 'admin']);

$routes->get("/products","ProductController::index",['filter' => 'admin']);
$routes->get("/add-products","ProductController::create",['filter' => 'admin']);
$routes->post("/add-products","ProductController::create",['filter' => 'admin']);
$routes->get("/api/products","ProductController::getProducts");
$routes->get("/api/products/(:any)","ProductController::getProductsById/$1");



$routes->get("/api/subcategories","SubCategoryController::getSubCategory");


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
