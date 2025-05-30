<?php

declare(strict_types=1);

namespace Modularis;

use Modularis\Interfaces\RouterInterface;
use Modularis\RouterManager;

class RouterMethods extends RouterManager implements RouterInterface
{
    public string $path = '';
    public $group_middleware = null;

    public function get(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('GET', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function post(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('POST', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function put(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('PUT', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function delete(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('DELETE', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function patch(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('PATCH', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function options(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('OPTIONS', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function head(
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null
    ): RouterMethods {
        $this->addRoute('HEAD', $this->path . $path, $handler, $middleware, $this->group_middleware);
        return $this;
    }

    public function endGround(): void{
        $this->path = '';
        $this->group_middleware = null;
    }
}