<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Interfaces\RouterInterface;
use Viimee\RouterManager;

class Router extends RouterManager implements RouterInterface
{
    public function get(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('POST', $path, $handler, $middleware);
    }

    public function put(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('PUT', $path, $handler, $middleware);
    }

    public function delete(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('DELETE', $path, $handler, $middleware);
    }

    public function patch(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('PATCH', $path, $handler, $middleware);
    }

    public function options(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('OPTIONS', $path, $handler, $middleware);
    }

    public function head(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->add('HEAD', $path, $handler, $middleware);
    }
}
