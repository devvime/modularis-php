<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Modularis\Router;
use Modularis\Middleware\AuthMiddleware;
use Modularis\Controller\UserController;

$router = new Router();

$router->group('/admin', AuthMiddleware::class . '@verify')->start()
    ->get('/dashboard', UserController::class . '@index', AuthMiddleware::class . '@permissions')
    ->endGround();

$router->get('/404', function() {
    echo 'Page not found.';
});

$router->dispatch();
