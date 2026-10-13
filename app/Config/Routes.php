<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');

// Protected routes
$routes->group('', ['filter' => 'auth'], function ($routes) {

    // Dashboard
    $routes->get('/dashboard', 'Dashboard::index');

    // Students
    $routes->get('/students', 'Students::index');
    $routes->get('/students/create', 'Students::create');
    $routes->post('/students/store', 'Students::store');
    $routes->get('/students/view/(:num)', 'Students::view/$1');
    $routes->get('/students/edit/(:num)', 'Students::edit/$1');
    $routes->post('/students/update/(:num)', 'Students::update/$1');
    $routes->post('/students/delete/(:num)', 'Students::delete/$1');

    // Classes
    $routes->get('/classes', 'Classes::index');
    $routes->get('/classes/create', 'Classes::create');
    $routes->post('/classes/store', 'Classes::store');
    $routes->get('/classes/view/(:num)', 'Classes::view/$1');
    $routes->get('/classes/edit/(:num)', 'Classes::edit/$1');
    $routes->post('/classes/update/(:num)', 'Classes::update/$1');
    $routes->post('/classes/delete/(:num)', 'Classes::delete/$1');

    // Sections
    $routes->get('/sections', 'Sections::index');
    $routes->get('/sections/create', 'Sections::create');
    $routes->post('/sections/store', 'Sections::store');
    $routes->get('/sections/view/(:num)', 'Sections::view/$1');
    $routes->get('/sections/edit/(:num)', 'Sections::edit/$1');
    $routes->post('/sections/update/(:num)', 'Sections::update/$1');
    $routes->post('/sections/delete/(:num)', 'Sections::delete/$1');

    // Teachers
    $routes->get('/teachers', 'Teachers::index');
    $routes->get('/teachers/create', 'Teachers::create');
    $routes->post('/teachers/store', 'Teachers::store');
    $routes->get('/teachers/view/(:num)', 'Teachers::view/$1');
    $routes->get('/teachers/edit/(:num)', 'Teachers::edit/$1');
    $routes->post('/teachers/update/(:num)', 'Teachers::update/$1');
    $routes->post('/teachers/delete/(:num)', 'Teachers::delete/$1');

    // Subjects
    $routes->get('/subjects', 'Subjects::index');
    $routes->get('/subjects/create', 'Subjects::create');
    $routes->post('/subjects/store', 'Subjects::store');
    $routes->get('/subjects/view/(:num)', 'Subjects::view/$1');
    $routes->get('/subjects/edit/(:num)', 'Subjects::edit/$1');
    $routes->post('/subjects/update/(:num)', 'Subjects::update/$1');
    $routes->post('/subjects/delete/(:num)', 'Subjects::delete/$1');

    // Attendance
    $routes->get('/attendance', 'Attendance::index');
    $routes->get('/attendance/create', 'Attendance::create');
    $routes->post('/attendance/store', 'Attendance::store');
    $routes->get('/attendance/view/(:num)', 'Attendance::view/$1');
    $routes->get('/attendance/edit/(:num)', 'Attendance::edit/$1');
    $routes->post('/attendance/update/(:num)', 'Attendance::update/$1');
    $routes->post('/attendance/delete/(:num)', 'Attendance::delete/$1');
    $routes->get('/attendance/bulk', 'Attendance::bulk');
    $routes->post('/attendance/bulk/store', 'Attendance::bulkStore');
    $routes->get('/attendance/students/(:num)', 'Attendance::students/$1');
    $routes->post('/attendance/bulk/store', 'Attendance::bulkStore');

    // Fees
    $routes->get('/fees', 'Fees::index');
    $routes->get('/fees/create', 'Fees::create');
    $routes->post('/fees/store', 'Fees::store');
    $routes->get('/fees/view/(:num)', 'Fees::view/$1');
    $routes->get('/fees/edit/(:num)', 'Fees::edit/$1');
    $routes->get('fees/history/(:num)', 'Fees::history/$1');
    $routes->post('/fees/update/(:num)', 'Fees::update/$1');
    $routes->post('/fees/delete/(:num)', 'Fees::delete/$1');
    $routes->get('/fees/receipt/(:num)', 'Fees::receipt/$1');

    // Exams
    $routes->get('/exams', 'Exams::index');
    $routes->get('/exams/create', 'Exams::create');
    $routes->post('/exams/store', 'Exams::store');
    $routes->get('/exams/view/(:num)', 'Exams::view/$1');
    $routes->get('/exams/edit/(:num)', 'Exams::edit/$1');
    $routes->post('/exams/update/(:num)', 'Exams::update/$1');
    $routes->post('/exams/delete/(:num)', 'Exams::delete/$1');
    $routes->get('/exams/subjects/add/(:num)', 'Exams::addSubject/$1');
    $routes->post('/exams/subjects/store', 'Exams::storeSubject');
    $routes->get('/exams/subjects/edit/(:num)', 'Exams::editSubject/$1');
    $routes->post('/exams/subjects/update/(:num)', 'Exams::updateSubject/$1');
    $routes->get('/exams/schedule/(:num)', 'Exams::schedule/$1');
    $routes->get('/exams/schedule/add/(:num)', 'Exams::addSchedule/$1');
    $routes->post('/exams/schedule/store', 'Exams::storeSchedule');
    $routes->get('/exams/schedule/edit/(:num)', 'Exams::editSchedule/$1');
    $routes->post('/exams/schedule/update/(:num)', 'Exams::updateSchedule/$1');
    $routes->post('/exams/schedule/delete/(:num)', 'Exams::deleteSchedule/$1');
    $routes->get('/exams/marks/(:num)/(:num)', 'Marks::index/$1/$2');
    $routes->post('/exams/marks/save', 'Marks::save');

    // Results
    $routes->get('/results', 'Results::index');
    $routes->get('/results/create', 'Results::create');
    $routes->post('/results/store', 'Results::store');
    $routes->get('/results/view/(:num)', 'Results::view/$1');
    $routes->get('/results/edit/(:num)', 'Results::edit/$1');
    $routes->post('/results/update/(:num)', 'Results::update/$1');
    $routes->post('/results/delete/(:num)', 'Results::delete/$1');

    // Notices
    $routes->get('/notices', 'Notices::index');
    $routes->get('/notices/create', 'Notices::create');
    $routes->post('/notices/store', 'Notices::store');
    $routes->get('/notices/view/(:num)', 'Notices::view/$1');
    $routes->get('/notices/edit/(:num)', 'Notices::edit/$1');
    $routes->post('/notices/update/(:num)', 'Notices::update/$1');
    $routes->post('/notices/delete/(:num)', 'Notices::delete/$1');

    // Reports
    $routes->get('/reports', 'Reports::index');

    // Settings
    $routes->get('/settings', 'Settings::index', ['filter' => 'role:admin']);
    $routes->post('/settings/save', 'Settings::save', ['filter' => 'role:admin']);
});