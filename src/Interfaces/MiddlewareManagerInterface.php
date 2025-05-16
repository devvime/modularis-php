<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

use Viimee\Request;

interface MiddlewareManagerInterface
{
    public static function verify(
        array | \Closure | null $middleware,
        Request $request
    ): void;
}
