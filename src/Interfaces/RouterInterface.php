<?php

declare(strict_types=1);

namespace Modularis\Interfaces;

use Modularis\RouterMethods;

interface RouterInterface
{
    public function get(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function post(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function put(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function delete(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function patch(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function options(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;

    public function head(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware
    ): RouterMethods;
}