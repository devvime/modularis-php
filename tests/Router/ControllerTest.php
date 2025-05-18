<?php

use Modularis\Router;

beforeEach(function () {
    require_once __DIR__ . '/../../src/Controller/UserController.php';
});

it('calls a controller method correctly', function () {

    $_SERVER['REQUEST_URI'] = '/user';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    $router = new Router();

    $router->get('/user', 'Modularis\Controller\UserController@index');

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('User index');
});