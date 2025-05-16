<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Interfaces\MiddlewareManagerInterface;
use Viimee\Request;
use Viimee\Response;

class MiddlewareManager implements MiddlewareManagerInterface
{
    public static function verify(
        array | \Closure | null $middleware,
        Request $request
    ): void {

        $response = new Response();

        if (is_array($middleware)) {
            foreach ($middleware as $item) {
                call_user_func($item, $request, $response);
            }

            return;
        }

        if ($middleware !== null) {
            call_user_func($middleware, $request, $response);
        }

    }
}
