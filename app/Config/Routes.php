<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

$routes->group('{locale}', [
    'filter' => 'daLocale',
    'where' => ['locale' => 'es|en']
], function ($routes) {

    // Public
    $routes->get('/', 'HomeController::index');
    $routes->get('about', 'AboutController::index');
    $routes->get('services', 'ServicesController::index');
    $routes->get('tours', 'ToursController::index');
    $routes->get('corporate', 'CorporateController::index');
    $routes->get('fleet', 'FleetController::index');
    $routes->get('reviews', 'ReviewsController::index');
    $routes->get('contact', 'ContactController::index');

    // Review flow
    $routes->get('review/(:segment)', 'PublicReviewController::form/$1');
    $routes->post('review/submit', 'PublicReviewController::submit');

    $routes->get('privacy', 'LegalController::privacy');
    $routes->get('terms', 'LegalController::terms');
});

// Redirección raíz
$routes->get('/', function () {
    return redirect()->to('/es');
});

$routes->group('{locale}/admin', [
    'filter' => ['daLocale', 'adminAuth'],
    'where' => ['locale' => 'es|en']
], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('review-invites', 'Admin\ReviewInvitesController::index');
    $routes->post('review-invites/create', 'Admin\ReviewInvitesController::create');
    $routes->get('reviews', 'Admin\ReviewsController::index');
    $routes->post('reviews/publish/(:num)', 'Admin\ReviewsController::publish/$1');

    $routes->post('reviews/unpublish/(:num)', 'Admin\ReviewsController::unpublish/$1');
    $routes->post('review-invites/mark-sent/(:num)', 'Admin\ReviewInvitesController::markSent/$1');

    // ✅ SystemController PRO (lo nuevo)
    $routes->group('system', static function($routes) {
        $routes->get('ping',   'Admin\SystemController::ping');
        $routes->get('migrate','Admin\SystemController::migrate');
        $routes->get('seed',   'Admin\SystemController::seed');
        $routes->get('clear',  'Admin\SystemController::clear');
    });

    // Customers
    $routes->get('customers', 'Admin\CustomersController::index');
    $routes->get('customers/new', 'Admin\CustomersController::new');
    $routes->post('customers', 'Admin\CustomersController::create');
    $routes->get('customers/(:num)/edit', 'Admin\CustomersController::edit/$1');
    $routes->post('customers/(:num)', 'Admin\CustomersController::update/$1');
    $routes->post('customers/(:num)/delete', 'Admin\CustomersController::delete/$1');

    // Services
    $routes->get('services', 'Admin\ServicesController::index');

// Crear service asociado a un customer
    $routes->get('customers/(:num)/services/new', 'Admin\ServicesController::newForCustomer/$1');
    $routes->post('customers/(:num)/services', 'Admin\ServicesController::createForCustomer/$1');

// Editar/actualizar/eliminar service (opcional pero recomendado)
    $routes->get('services/(:num)/edit', 'Admin\ServicesController::edit/$1');
    $routes->post('services/(:num)', 'Admin\ServicesController::update/$1');
    $routes->post('services/(:num)/delete', 'Admin\ServicesController::delete/$1');


    // Auth (público dentro de admin)
    $routes->get('login', 'Admin\AuthController::login');
    $routes->post('attempt', 'Admin\AuthController::attempt');
    $routes->get('logout', 'Admin\AuthController::logout');

});