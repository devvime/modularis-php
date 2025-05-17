<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

use Viimee\RouterGroup;

interface RouterGroupInterface
{
    public function get(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function post(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function put(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function delete(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function patch(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function options(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;

    public function head(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware
    ): RouterGroup;
}