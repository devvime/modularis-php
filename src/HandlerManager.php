<?php

declare(strict_types=1);

namespace Viimee;

class HandlerManager
{
    public static function resolveHandler(mixed $handler): callable
    {
        if (is_string($handler) && str_contains($handler, '@')) {
            [$class, $method] = explode('@', $handler);
            if (!class_exists($class)) {
                throw new \RuntimeException("$class class not found.");
            }

            $instance = new $class();
            if (!method_exists($instance, $method)) {
                throw new \RuntimeException("$method method not found in $class class.");
            }

            return [$instance, $method];
        }

        if (is_callable($handler)) {
            return $handler;
        }

        throw new \InvalidArgumentException("Invalid handler.");
    }
}
