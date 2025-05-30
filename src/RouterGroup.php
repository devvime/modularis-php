<?php

declare(strict_types=1);

namespace Modularis;

class RouterGroup
{
    private Router $router;

    public function __construct(
        Router $router,
        string $path,
        array | callable | string | null $middleware = null
    ) {
        $this->router = $router;
        $this->router->path = $path;
        $this->router->group_middleware = $middleware;
    }

    public function init(): Router
    {
        return $this->router;
    }
}
