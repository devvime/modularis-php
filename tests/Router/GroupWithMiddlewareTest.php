<?php

use Modularis\Router;

use Modularis\Middleware\AuthMiddleware;
use Modularis\Controller\UserController;

it('executes group-level and route-level middleware classes', function () {

    $_SERVER['REQUEST_URI'] = '/admin/dashboard';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->group('/admin', AuthMiddleware::class . '@verify')->init()
        ->get('/dashboard', UserController::class . '@index', AuthMiddleware::class . '@permissions')
        ->endGroup();

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)
        ->toContain('permissions')
        ->toContain('User index');
});
