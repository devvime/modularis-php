<?php

declare(strict_types=1);

namespace Modularis\Middleware;

use Exception;
use Modularis\Request;
use Modularis\Response;

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