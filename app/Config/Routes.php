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
// $routes->setDefaultMethod('index');
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

$routes->get('/test', 'Test::index', ['filter' => 'userNoAuth']);
$routes->get('/remoteStart', 'Test::remoteStart', ['filter' => 'userNoAuth']);
// $routes->get('/remoteStatus', 'Test::remoteStatus', ['filter' => 'userNoAuth']);
$routes->get('/remoteStop', 'Test::remoteStop', ['filter' => 'userNoAuth']);

$routes->get('/', 'Home::index', ['filter' => 'userNoAuth']);
$routes->match(['get', 'post'], 'register', 'Home::register', ['filter' => 'userNoAuth']);

// Authentication
$routes->match(['get', 'post'], 'login', 'Authentication::login', ['filter' => 'userNoAuth']);
$routes->get('logout', 'Authentication::logout');

// Dashboard
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'userAuth']);

// Map
$routes->group('map', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Map::index');
    $routes->post('SocketKey', 'Map::SocketKey');
    // $routes->post('GetLocations', 'Map::GetLocations');
    $routes->post('GetMobileLocations', 'Map::GetMobileLocations');
    $routes->post('GetUserChargingStatusByTag', 'Map::GetUserChargingStatusByTag');
    $routes->post('GetDetail', 'Map::GetDetail');
    ///New Maps
    $routes->get('GetLocations', 'Map::GetLocations');
});

// Wallet
$routes->group('wallet', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Wallet::index');
    $routes->get('topup', 'Wallet::topup');
});

// Booking
$routes->group('booking', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Booking::index');
});

// Charging
$routes->group('charging', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Charging::index');
    $routes->get('getActivePriceKw', 'Charging::getActivePriceKw');
    $routes->post('GetStation', 'Charging::getEVStation');
    $routes->post('getConnecter', 'Charging::getEVStationConnector');  
    $routes->post('getStatusConnecter', 'Charging::getEVStationConnectorStatus');
    $routes->post('getTransectionStartLast', 'Charging::getTransectionStartLast');
    $routes->post('startCharger', 'Charging::remoteStart');  
    $routes->post('stopCharger', 'Charging::remoteStop'); 
    $routes->post('addTransection', 'Charging::transection_state'); 
    $routes->post('getActiveChecgerData', 'Charging::getActiveChecgerData'); 
    $routes->post('getActiveTransections', 'Charging::getActiveTransections');
    $routes->post('getTransectionsFinish', 'Charging::getTransectionsFinish');  
    $routes->post('getStatusConnecterFinish', 'Charging::getStatusConnecterFinish');  
    $routes->get('indexPriceSetting', 'Charging::indexPriceSetting');   
    $routes->post('updatePriceKw', 'Charging::updatePriceKw');   
    $routes->post('insertPriceKw', 'Charging::insertPriceKw');
    $routes->post('summaryChargerUser', 'Charging::summaryChargerUser');
});

// Profile
$routes->group('profile', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Profile::index');
    $routes->get('history', 'Profile::history');
    $routes->post('update', 'Profile::update');
    $routes->get('data', 'Profile::data');
});

// Report
$routes->group('report', ['filter' => 'userAuth'], function ($routes) {
    $routes->get('index', 'Report::index');
});

$routes->get('news', 'General::news');
$routes->get('problem-report', 'General::problemReport');

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
