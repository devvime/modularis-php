<?php

declare(strict_types=1);

namespace Modularis;

class RouterGroup
{
    private Router $router;

    public function __construct(
        string $path,
        array | callable | string | null $middleware = null,
        Router $router
    ) {
        $this->router = $router;
        $this->router->path = $path;
        $this->router->group_middleware = $middleware;
        return $this->router;
    }

    public function start(): Router
    {
        return $this->router;
    }
}
