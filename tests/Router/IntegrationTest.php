<?php

use Modularis\Router;

use Modularis\Middleware\AuthMiddleware;
use Modularis\Controller\UserController;

it('handles full request flow with parameters and middleware', function () {

    $_SERVER['REQUEST_URI'] = '/user/123';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->get('/user/{id:int}', UserController::class . '@show', [
        AuthMiddleware::class . '@verify'
    ]);

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)
        ->toContain('verified')
        ->toContain('User ID: 123');
});
