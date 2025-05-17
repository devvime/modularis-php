<?php

declare(strict_types=1);

namespace Viimee\Controller;

use Viimee\Request;
use Viimee\Response;

class TestController
{
    public function index(Request $request, Response $response)
    {
        $response->render('Hello World!');
    }
}