<?php

declare(strict_types=1);

namespace Modularis\Interfaces;

use Modularis\Request;
use Modularis\Response;

interface MiddlewareManagerInterface
{
    public static function verify(
        array | callable | string | null $middleware,
        Request $request,
        Response $response
    ): void;
}
