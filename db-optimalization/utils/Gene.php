<?php

class Gene
{
    public static function price(): float
    {
        return random_int(100, 1000000) / 100;
    }

    public static function name(): string
    {
        $str = '';
        $len = random_int(3, 25);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(random_int(97, 122));
        }
        return ucfirst($str);
    }
}
