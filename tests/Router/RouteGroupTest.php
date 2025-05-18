<?php

use Modularis\Router;

it('responds to grouped routes', function () {

    $_SERVER['REQUEST_URI'] = '/api/ping';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->group('/api')->start()
        ->get('/ping', fn ($req, $res) => $res->render('pong'));

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('pong');
});