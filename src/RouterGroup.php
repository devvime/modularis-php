<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Interfaces\RouterGroupInterface;

class RouterGroup implements RouterGroupInterface
{
    private string $path;
    private Router $router;

    public function __construct(string $path, Router $router)
    {
        $this->path = $path;
        $this->router = $router;
    }

    public function get(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('GET', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function post(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('POST', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function put(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('PUT', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function delete(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('DELETE', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function patch(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('PATCH', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function options(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('OPTIONS', $this->path . $path, $handler, $middleware);
        return $this;
    }

    public function head(
        string $path,
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): RouterGroup {
        $this->router->addRoute('HEAD', $this->path . $path, $handler, $middleware);
        return $this;
    }
}
