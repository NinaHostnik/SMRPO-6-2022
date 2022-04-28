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
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('login');
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

$routes->match(['get','post'],'/', 'UsersController::login',['filter' => 'NoAuth']);
$routes->match(['get','post'],'/admin/createUser', 'UsersController::createUser',['filter' => 'AdminAuth']);
$routes->match(['get','post'],'/profile', 'UsersController::update_user',['filter' => 'LoginAuth']);
$routes->match(['get','post'],'/dodajanjeProjekta', 'NewProjectController::createProject',['filter' => 'LoginAuth']);
$routes->match(['get','post'],'/dodajanjeUporabniskihZgodb', 'DodajanjeUporabniskihZgodbController::dodajanjeZgodbe',['filter' => 'LoginAuth']);
$routes->match(['get','post'],'/projekti', 'ProjectsController::allProjects',['filter' => 'LoginAuth']);
$routes->match(['get','post'],'/home', 'HomeController::home',['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/cardTable/(:num)', 'CardTableController::cardTable', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/dodajanjeSprintov', 'DodajanjeSprintovController::dodajanjeSprinta', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/odjava', 'UsersController::odjava', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/ponastavitevGesa', 'UsersController::ponastavitev', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/Pbacklog', 'ProjectsController::backlog', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/sprint/dodajzgodbo', 'SprintController::dodajZgodbo', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/sprint', 'SprintController::backlog', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/MyTasks', 'MyTasksController::myTasks', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/SpremeniStatus/(:any)/(:num)', 'MyTasksController::changeStatus', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/Sbacklog', 'SprintController::backlog', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/Pbacklog/dodajzgodbo', 'ProjectsController::dodajNalogo', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/Pbacklog/urediCas', 'DodajanjeUporabniskihZgodbController::urediCas', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/admin/deleteUser', 'UsersController::deleteUser', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/SprejmiNalogo/(:num)', 'MyTasksController::sprejmiNalogo', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/ZavrniNalogo/(:num)', 'MyTasksController::zavrniNalogo', ['filter' => 'LoginAuth']);
$routes->match(['get','post'], '/SprejmiZgodbo/(:num)', 'MyTasksController::potrdiZgodbo', ['filter' => 'LoginAuth']);



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
