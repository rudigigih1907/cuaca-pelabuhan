<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('User');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'User::index');

// Routes Pelabuhan
$routes->get('/pelabuhan', 'PelabuhanController::index');
$routes->post('/pelabuhan', 'PelabuhanController::create');
$routes->get('/pelabuhan/edit/(:num)', 'PelabuhanController::edit/$1');
$routes->put('/pelabuhan/update/(:num)', 'PelabuhanController::update/$1');
$routes->delete('/pelabuhan/(:num)', 'PelabuhanController::delete/$1');

// Routes Data Cuaca
$routes->get('/cuaca', 'CuacaController::index');
$routes->get('/cuaca/get-cuaca/(:num)', 'CuacaController::get_cuaca/$1');
$routes->post('/cuaca', 'CuacaController::create');
$routes->post('/cuaca/manual', 'CuacaController::manual');
$routes->get('/cuaca/edit/(:num)', 'CuacaController::edit/$1');
$routes->put('/cuaca/update/(:num)', 'CuacaController::update/$1');
$routes->delete('/cuaca/(:num)', 'CuacaController::delete/$1');

//Routes Lampiran
$routes->get('berkas/(:num)','BerkasController::index/$1');
$routes->post('/berkas/upload', 'BerkasController::upload');
$routes->get('/berkas/downloads/(:num)', 'BerkasController::downloads/$1');
$routes->delete('/berkas/delete/(:num)', 'BerkasController::delete/$1');

//Routes Report
$routes->get('/generate-pdf/(:num)', 'CuacaController::generate_pdf/$1');
// $routes->post('/report-bulanan', 'CuacaController::reportBulanan');
$routes->match(['get', 'post'], 'report-bulanan', 'CuacaController::reportBulanan');

// Routes Login
$routes->get('/login', 'AuthController::login');
$routes->post('/auth', 'AuthController::check');
$routes->get('/logout', 'AuthController::logout');

//Routes Register
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::create');

// Routes Admin
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/user/edit/(:num)', 'Admin::edit/$1');
$routes->put('/admin/user/update/(:num)', 'Admin::update/$1');

$routes->get('create-db', function () {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('pelabuhan_cuaca')) {
        echo 'Database Created...!';
    }
});

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
