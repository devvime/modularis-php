<?php

use Modularis\Router;

beforeEach(function () {
    require_once __DIR__ . '/../../src/Middleware/AuthMiddleware.php';
    require_once __DIR__ . '/../../src/Controller/UserController.php';
});

it('executes group-level and route-level middleware classes', function () {

    $_SERVER['REQUEST_URI'] = '/admin/dashboard';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->group('/admin', 'Modularis\Middleware\AuthMiddleware@verify')->start()
        ->get('/dashboard', 'Modularis\Controller\UserController@index', 'Modularis\Middleware\AuthMiddleware@permissions');

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)
        ->toContain('permissions')
        ->toContain('User index');
});
