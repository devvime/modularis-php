<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\RouterManager;
use Viimee\RouterGroup;
use Viimee\Interfaces\RouterInterface;

class Router extends RouterManager implements RouterInterface
{
    public function get(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function patch(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('PATCH', $path, $handler, $middleware);
    }

    public function options(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('OPTIONS', $path, $handler, $middleware);
    }

    public function head(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->addRoute('HEAD', $path, $handler, $middleware);
    }

    public function group(
        string $path,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $request = new Request([]);
        $response = new Response();
        MiddlewareManager::verify($middleware, $request, $response);
        return new RouterGroup($path, $this);        
    }
}