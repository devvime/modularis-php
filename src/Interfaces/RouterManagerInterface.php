<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

interface RouterManagerInterface
{
    public function add(
        string $method,
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function dispatch(): void;
}
