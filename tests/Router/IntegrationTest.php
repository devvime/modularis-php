<?php

use Modularis\Router;

beforeEach(function () {
    require_once __DIR__ . '/../../src/Middleware/AuthMiddleware.php';
    require_once __DIR__ . '/../../src/Controller/UserController.php';
});

it('handles full request flow with parameters and middleware', function () {

    $_SERVER['REQUEST_URI'] = '/user/123';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->get('/user/{id:int}', 'Modularis\Controller\UserController@show', [
        'Modularis\Middleware\AuthMiddleware@verify'
    ]);

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)
        ->toContain('verified')
        ->toContain('User ID: 123');
    
});
