<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Viimee\Router;
use Viimee\Request;
use Viimee\Response;

$router = new Router();

$router->get('/', function(Request $request, Response $response) {
    $response->render('Hello World!');
});

$router->get('/test', function(Request $request, Response $response) {
    $response->render('Test OK!');
});

$router->get('/test/{id}/user/{name}', function(Request $request, Response $response) {
    $response->render("test with id: {$request->params['id']} and name: {$request->params['name']}");
});

$router->post('/test', function(Request $request, Response $response) {
    $response->render('POST ok');
});

$router->post('/test/{id}', function(Request $request, Response $response) {
    $response->render("POST with id: {$request->params['id']}");
});

$router->put('/test/{id}', function(Request $request, Response $response) {
    $response->render("PUT with id: {$request->params['id']}");
});

$router->delete('/test/{id}', function(Request $request, Response $response) {
    $response->render("DELETE with id: {$request->params['id']}");
});

$router->dispatch();