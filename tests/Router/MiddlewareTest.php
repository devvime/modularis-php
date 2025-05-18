<?php

use Modularis\Router;

it('runs middleware before route handler', function () {

    $_SERVER['REQUEST_URI'] = '/secure';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    $router = new Router();

    $router->get('/secure', fn ($req, $res) => $res->render('Secured'), function ($req, $res) {
        echo 'Checked-';
    });

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('Checked-Secured');
});
