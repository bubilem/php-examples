<?php

namespace SimpleOrmExample\Util;

class Loader
{

    public static function loadClass(string $className)
    {
        $parts = explode('\\', $className);
        array_shift($parts);
        $path = APP_PATH . implode('/', $parts) . '.php';
        if (file_exists($path)) {
            require_once $path;
        } else {
            die("Class not found!");
        }
    }
}
