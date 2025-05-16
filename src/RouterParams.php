<?php

declare(strict_types=1);

namespace Viimee;

class RouterParams
{
    public function buildRegexFromRoute(string $route): array
    {
        $paramNames = [];

        $regex = preg_replace_callback('#\{(\w+)\}#', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '(?P<' . $matches[1] . '>[^/]+)';
        }, $route);

        return ["#^$regex$#", $paramNames];
    }

    public function extractNamedParams(array $matches): array
    {
        return array_filter(
            $matches,
            fn($key) => !is_int($key),
            ARRAY_FILTER_USE_KEY
        );
    }
}