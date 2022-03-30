<?php
class Loader
{
    public static function load(string $className)
    {
        if (file_exists("app/$className.php")) {
            require "app/$className.php";
        } else {
            die("Unable to load class $className.");
        }
    }
}
