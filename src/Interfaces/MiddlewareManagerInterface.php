<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

use Viimee\Request;
use Viimee\Response;

interface MiddlewareManagerInterface
{
    public static function verify(
        array | \Closure | null $middleware,
        Request $request,
        Response $response
    ): void;
}
