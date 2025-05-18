<?php

use Modularis\Router;

it('parses typed route parameters', function () {

    $_SERVER['REQUEST_URI'] = '/user/42';
    $_SERVER['REQUEST_METHOD'] = 'GET';
    
    $router = new Router();

    $router->get('/user/{id:int}', function ($req, $res) {
        $res->render("User ID: " . $req->params['id']);
    });

    ob_start();
    $router->dispatch();
    $output = ob_get_clean();

    expect($output)->toBe('User ID: 42');
});