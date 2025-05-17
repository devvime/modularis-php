<?php

declare(strict_types=1);

namespace Viimee;

class RouterGroup
{
    private Router $router;

    public function __construct(string $path, Router $router)
    {
        $this->router = $router;
        $this->router->path = $path;
    }

    public function start(): Router
    {
        return $this->router;
    }
}
