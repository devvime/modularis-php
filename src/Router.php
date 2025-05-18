<?php

declare(strict_types=1);

namespace Modularis;

use Modularis\RouterGroup;
use Modularis\RouterMethods;

class Router extends RouterMethods
{
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