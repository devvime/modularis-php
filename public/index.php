<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Viimee\Router;

$router = new Router();

$router->get('/', 'Viimee\Controller\TestController@index');

$router->get('/test', function ($request, $response) {
    $response->render('Test OK!');
});

$router->get('/test/{id:int}/user/{name}', function ($request, $response) {
    $response->render("test with id: {$request->params['id']} and name: {$request->params['name']}");
});

$router->post('/test', function ($request, $response) {
    $response->render('POST ok');
});

$router->post('/test/{id:int}', function ($request, $response) {
    $response->render("POST with id: {$request->params['id']}");
});

$router->put('/test/{id:int}', function ($request, $response) {
    $response->render("PUT with id: {$request->params['id']}");
});

$router->delete('/test/{id:int}', function ($request, $response) {
    $response->render("DELETE with id: {$request->params['id']}");
});

$router->group('/user')
    ->get('/steve/{id:int}', function ($request, $response) {
        $response->render('Deu certo! id: ' . $request->params['id']);
    })
    ->post('/create', function ($request, $response) {
        $response->render("POST name: {$request->body->name}");
    });

$router->dispatch();
