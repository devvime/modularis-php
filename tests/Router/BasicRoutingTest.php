<?php

use Modularis\Router;

it('responds to a basic GET route', function () {

    $_SERVER['REQUEST_URI'] = '/hello';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->get('/hello', fn ($req, $res) => $res->render('Hello World'));

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('Hello World');

});
