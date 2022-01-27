<?php

namespace php_oop_board\Support;

class Theme
{
    private static $layout;

    public static function setLayout($layout)
    {
        self::$layout = $layout;
    }

    public static function view($view,$vars = [])
    {
        foreach($vars as $name => $value) {
            $$name = $value; //왜 $$??
        }
        return require_once self::$layout;
    }
}