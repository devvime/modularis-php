<?php

use Modularis\Router;

use Modularis\Controller\UserController;

it('calls a controller method correctly', function () {

    $_SERVER['REQUEST_URI'] = '/user';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    $router = new Router();

    $router->get('/user', UserController::class . '@index');

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('User index');
});