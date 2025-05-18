<?php

declare(strict_types=1);

namespace Viimee\Middleware;

use Exception;
use Viimee\Request;
use Viimee\Response;

class TestMiddleware
{
    public function auth(Request $request, Response $response)
    {
        $response->render('Auth Middleware OK');
    }

    public function permission(Request $request, Response $response)
    {
        $response->render('Permission Middleware OK');
    }
}