<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

interface RouterInterface
{
    public function get(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function post(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function put(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function delete(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function patch(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function options(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;

    public function head(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): void;
}