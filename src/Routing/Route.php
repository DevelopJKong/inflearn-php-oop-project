<?php

namespace php_oop_board\Routing;

use php_oop_board\Routing\RequestContext;
use php_oop_board\Http\Request;

class Route
{
    private static $contexts = [];

    public static function add($method, $path, $handler, $middlewares = [])
    {
        self::$contexts[] = new RequestContext($method, $path, $handler, $middlewares);
    }

    public static function run()
    {
        foreach (self::$contexts as $context) {
            if ($context->method === strtolower(Request::getMethod()) && is_array($urlParams = $context->match(Request::getPath()))) {
                if ($context->runMiddlewares()) {
                    return call_user_func($context->handler, ...$urlParams);
                }
                return false;
            }
        }
    }
}