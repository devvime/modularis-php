<?php

use Modularis\Router;

it('executes multiple middlewares before the handler', function () {

    $_SERVER['REQUEST_URI'] = '/test';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->get('/test', fn ($req, $res) => $res->render('Final'), [
        fn ($req, $res) => print('One-'),
        fn ($req, $res) => print('Two-')
    ]);

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('One-Two-Final');
});
