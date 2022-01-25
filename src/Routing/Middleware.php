<?php

namespace php_oop_board\Routing;

abstract class Middleware
{
    abstract public static function process();
}