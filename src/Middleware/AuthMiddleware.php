<?php

declare(strict_types=1);

namespace Modularis\Middleware;

use Modularis\Request;
use Modularis\Response;

class AuthMiddleware {

    public function verify(Request $request, Response $response) {
        $response->render('verified-');
    }

    public function permissions(Request $request, Response $response) {
        $response->render('permissions-');
    }

}