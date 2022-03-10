<?php

class Stopwatch
{
    private static $time;

    public static function start()
    {
        self::$time = microtime(true);
    }

    public static function stop()
    {
        printf(
            "[Stopwatch: %.6f ms]" . PHP_EOL,
            (microtime(true) - self::$time) * 1000
        );
        self::start();
    }
}
