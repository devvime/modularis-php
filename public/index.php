<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;

$router = new Router();

$router->group('/admin', 'Modularis\Middleware\AuthMiddleware@verify')->start()
    ->get('/dashboard', 'Modularis\Controller\UserController@index', 'Modularis\Middleware\AuthMiddleware@permissions');

$router->dispatch();
