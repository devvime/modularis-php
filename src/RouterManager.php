<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Request;
use Viimee\Response;
use Viimee\Interfaces\RouterManagerInterface;
use Viimee\MiddlewareManager;

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
        \Closure $handler,
        array | \Closure | null $middleware = null
    ): void {
        $this->routes[$method][$path] = [
            'handler' => $handler,
            'middleware' => $middleware
        ];
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->path;

        foreach ($this->routes[$method] ?? [] as $route => $handler) {

            [$regex, $paramNames] = $this->buildRegexFromRoute($route);

            if (preg_match($regex, $path, $matches)) {
                $params = $this->extractNamedParams($matches);
                $request = new Request($params);
                $response = new Response();

                MiddlewareManager::verify($handler['middleware'], $request, $response);
                call_user_func_array($handler['handler'], [$request, $response]);
                return;
            }
        }

        http_response_code(404);
        echo 'Page not found';

    }
}