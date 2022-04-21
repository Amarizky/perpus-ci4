<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->add('/', 'Login::index');
$routes->group('/login', function ($routes) {
    $routes->add('admin', 'Login::login_admin');
    $routes->add('visitor', 'Login::login_visitor');
});
$routes->group('/admin', ['filter' => 'admin-auth'], function ($routes) {
    $routes->add('/',          'Admin/Books::index');
    $routes->add('categories', 'Admin/Categories::index');
    $routes->add('visitors',   'Admin/Visitors::index');
});
$routes->group('/visitor', ['filter' => 'visitor-auth'], function ($routes) {
    $routes->add('/',          'Visitor/Dashboard::index');
    $routes->add('borrow',     'Visitor/BorrowBook::index');
    $routes->add('return',     'Visitor/ReturnBook::index');
});
$routes->add('/logout', 'Login::logout');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
