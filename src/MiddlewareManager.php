<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Request;
use Viimee\Response;
use Viimee\Interfaces\MiddlewareManagerInterface;

class MiddlewareManager implements MiddlewareManagerInterface
{
    public static function verify(
        array | \Closure | null $middleware,
        Request $request,
        Response $response
    ): void {

        $response = new Response();

        if (is_array($middleware)) {
            foreach ($middleware as $item) {
                call_user_func_array($item, [$request, $response]);
            }

            return;
        }

        if ($middleware !== null) {
            call_user_func_array($middleware, [$request, $response]);
        }

    }
}
