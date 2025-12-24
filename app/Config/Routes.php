<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

// ======================
// DEFAULT ROUTES
// ======================
$routes->get('/', 'HomeController::index');

// Redirect /login → /admin/login
$routes->get('login', fn() => redirect()->to('/admin/login'));

// ======================
// FRONTEND ROUTES
// ======================
$routes->get('products', 'ProductsController::index');
$routes->get('products/(:num)', 'ProductsController::detail/$1');
$routes->get('about', 'AboutController::index');
$routes->get('locations', 'LocationsController::index');
$routes->get('download/document/(:num)', 'DownloadController::document/$1');

// ======================
// ADMIN LOGIN & REGISTER (NoAuthFilter)
// ======================
$routes->get('admin/login', 'Admin\AuthController::login', ['filter' => 'noauth']);
$routes->post('admin/login', 'Admin\AuthController::loginAction', ['filter' => 'noauth']);

$routes->get('admin/register', 'Admin\AuthController::register', ['filter' => 'noauth']);
$routes->post('admin/register', 'Admin\AuthController::registerAction', ['filter' => 'noauth']);

// Forgot / Reset Password
// **pastikan AuthController memiliki method ini jika ingin diaktifkan**
$routes->get('admin/forgot-password', 'Admin\AuthController::forgotPassword', ['filter' => 'noauth']);
$routes->post('admin/forgot-password', 'Admin\AuthController::forgotPasswordAction', ['filter' => 'noauth']);
$routes->get('admin/reset-password/(:any)', 'Admin\AuthController::resetPassword/$1', ['filter' => 'noauth']);
$routes->post('admin/reset-password', 'Admin\AuthController::resetPasswordAction', ['filter' => 'noauth']);

// Logout (bebas login)
$routes->get('admin/logout', 'Admin\AuthController::logout');

// ======================
// ADMIN PANEL (Filter auth)
// ======================
$routes->group('admin', ['filter' => 'auth'], function($routes) {

    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Products
    $routes->get('products', 'Admin\ProductController::index');
    $routes->get('products/create', 'Admin\ProductController::create');
    $routes->post('products', 'Admin\ProductController::store');
    $routes->get('products/edit/(:num)', 'Admin\ProductController::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\ProductController::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\ProductController::delete/$1');

    // Documents
    $routes->get('documents', 'Admin\DocumentController::index');
    $routes->get('documents/create', 'Admin\DocumentController::create');
    $routes->post('documents', 'Admin\DocumentController::store');
    $routes->get('documents/edit/(:num)', 'Admin\DocumentController::edit/$1');
    $routes->post('documents/update/(:num)', 'Admin\DocumentController::update/$1');
    $routes->get('documents/delete/(:num)', 'Admin\DocumentController::delete/$1');

    // Locations
    $routes->get('locations', 'Admin\LocationController::index');
    $routes->get('locations/create', 'Admin\LocationController::create');
    $routes->post('locations', 'Admin\LocationController::store');
    $routes->get('locations/edit/(:num)', 'Admin\LocationController::edit/$1');
    $routes->post('locations/update/(:num)', 'Admin\LocationController::update/$1');
    $routes->get('locations/delete/(:num)', 'Admin\LocationController::delete/$1');

    // Certificates
    $routes->get('certificates', 'Admin\CertificateController::index');
    $routes->get('certificates/create', 'Admin\CertificateController::create');
    $routes->post('certificates', 'Admin\CertificateController::store');
    $routes->get('certificates/delete/(:num)', 'Admin\CertificateController::delete/$1');

    // About Us
    $routes->get('aboutus', 'Admin\AboutUsController::index');
    $routes->post('aboutus/update', 'Admin\AboutUsController::update');

    // Admin Users
    $routes->get('admins', 'Admin\AdminUserController::index');
    $routes->get('admins/create', 'Admin\AdminUserController::create');
    $routes->post('admins', 'Admin\AdminUserController::store');
    $routes->get('admins/edit/(:num)', 'Admin\AdminUserController::edit/$1');
    $routes->post('admins/update/(:num)', 'Admin\AdminUserController::update/$1');
    $routes->get('admins/delete/(:num)', 'Admin\AdminUserController::delete/$1');

    // Reports
    $routes->get('reports', 'Admin\ReportController::index');
    $routes->get('reports/export-products', 'Admin\ReportController::exportProducts');
    $routes->get('reports/export-documents', 'Admin\ReportController::exportDocuments');
    $routes->get('reports/export-locations', 'Admin\ReportController::exportLocations');
    $routes->get('reports/export-certificates', 'Admin\ReportController::exportCertificates');
    $routes->get('reports/export-activities', 'Admin\ReportController::exportActivities');
    $routes->get('reports/export-all', 'Admin\ReportController::exportAllReports');
    
    // API Admin Activity
    $routes->get('api/admin-activity', 'Admin\AdminActivityApiController::index');
});
