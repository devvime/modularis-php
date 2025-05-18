<?php

declare(strict_types=1);

namespace Modularis\Controller;

use Modularis\Request;
use Modularis\Response;

class TestController
{
    public function index(Request $request, Response $response)
    {
        $response->render('Hello World!');
    }
}