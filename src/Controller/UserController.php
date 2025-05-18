<?php

declare(strict_types=1);

namespace Modularis\Controller;

use Modularis\Request;
use Modularis\Response;

class UserController {

    public function index(Request $request, Response $response) {
        $response->render('User index');
    }

    public function show(Request $request, Response $response) {
        $response->render('User ID: ' . $request->params['id']);
    }
    
}