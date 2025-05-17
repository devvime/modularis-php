<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

interface RouterManagerInterface
{
    public function addRoute(
        string $method,
        string $path,
        callable $handler,
        array | callable | string | null $middleware
    ): void;

    public function dispatch(): void;
}
