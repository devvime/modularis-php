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
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    public function patch(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('PATCH', $path, $handler, $middleware);
    }

    public function options(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('OPTIONS', $path, $handler, $middleware);
    }

    public function head(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): void {
        $this->addRoute('HEAD', $path, $handler, $middleware);
    }

    public function group(
        string $path,
        array | callable | string | null $middleware = null
    ): RouterGroup {
        $request = new Request([]);
        $response = new Response();
        MiddlewareManager::verify($middleware, $request, $response);
        return new RouterGroup($path, $this);        
    }
}