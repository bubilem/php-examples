<?php
class Loader
{
    public static function load(string $className)
    {
        if (file_exists(APP_DIR . "$className.php")) {
            require APP_DIR . "$className.php";
        } else {
            die("Unable to load class $className.");
        }
    }
}
