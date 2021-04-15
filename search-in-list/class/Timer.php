<?php
class Timer
{
    private static $time;

    public static function start()
    {
        self::$time = microtime(true);
    }

    public static function check($label)
    {
        echo $label . number_format(microtime(true) - self::$time, 6) . " s\n";
        self::$time = microtime(true);
    }
}
