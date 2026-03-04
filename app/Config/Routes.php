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
    'filter' => 'daLocale',
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

});