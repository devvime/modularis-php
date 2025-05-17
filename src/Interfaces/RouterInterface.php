<?php

declare(strict_types=1);

namespace Viimee\Interfaces;

use Viimee\RouterGroup;

interface RouterInterface
{
    public function get(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function post(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function put(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function delete(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function patch(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function options(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function head(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): void;

    public function group(
        string $path,
        array | callable | string | null $middleware
    ): RouterGroup;
}