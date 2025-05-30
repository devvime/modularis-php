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
        return new RouterGroup(path: $path, middleware: $middleware, router: $this);        
    }
}