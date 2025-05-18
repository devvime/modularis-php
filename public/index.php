<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

$router->get('/', 'Modularis\Controller\TestController@index', [
    'Modularis\Middleware\TestMiddleware@auth',
    'Modularis\Middleware\TestMiddleware@permission'
]);

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

$router->group('/user')->start()
    ->get('/steve/{id:int}', function ($request, $response) {
        $response->render('Deu certo! id: ' . $request->params['id']);
    })
    ->post('/create', function ($request, $response) {
        $response->render("POST name: {$request->body->name}");
    });

$router->group('/product')->start()
    ->get('/notebook/{id:int}', function ($request, $response) {
        $response->render('Notebook! id: ' . $request->params['id']);
    });

$router->dispatch();
