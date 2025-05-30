<?php

declare(strict_types=1);

namespace Modularis;

use Modularis\Request;
use Modularis\Response;
use Modularis\Interfaces\RouterManagerInterface;
use Modularis\MiddlewareManager;
use Modularis\HandlerManager;

class RouterManager extends RouterParams implements RouterManagerInterface
{
    private string $path;
    private array $routes = [];

    public function __construct()
    {
        $this->path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    public function addRoute(
        string $method,
        string $path,
        callable | string $handler,
        array | callable | string | null $middleware = null,
        array | callable | string | null $group_middleware = null
    ): void {
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middleware' => $middleware,
            'group_middleware' => $group_middleware
        ];
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->path;

        foreach ($this->routes[$method] ?? [] as $route => $handler) {

            [$regex, $paramTypes] = $this->buildRegexFromRoute($route);

            if (preg_match($regex, $path, $matches)) {
                $params = $this->extractTypedParams($matches, $paramTypes);
                $request = new Request($params);
                $response = new Response();

                MiddlewareManager::verify($handler['group_middleware'], $request, $response);
                MiddlewareManager::verify($handler['middleware'], $request, $response);
                $callbackHandler = HandlerManager::resolveHandler($handler['handler']);
                call_user_func_array($callbackHandler, [$request, $response]);
                return;
            }
        }

        header('Location: /404');
    }
}