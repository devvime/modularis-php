<?php

declare(strict_types=1);

namespace Viimee;

use Viimee\Request;
use Viimee\Response;
use Viimee\Interfaces\MiddlewareManagerInterface;

class MiddlewareManager implements MiddlewareManagerInterface
{
    public static function verify(
        array | callable | string | null $middleware,
        Request $request,
        Response $response
    ): void {

        $response = new Response();

        if (is_array($middleware)) {
            foreach ($middleware as $item) {
                $callbackHandler = HandlerManager::resolveHandler($item);
                call_user_func_array($callbackHandler, [$request, $response]);
            }

            return;
        }

        if ($middleware !== null) {
            $callbackHandler = HandlerManager::resolveHandler($middleware);
            call_user_func_array($callbackHandler, [$request, $response]);
        }

    }
}
