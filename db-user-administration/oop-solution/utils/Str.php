<?php

/**
 * Basic string operation
 */
class Str
{
    /**
     * Encoding safe division of the string character by character into the array
     *
     * @param string $string
     * @param string $encoding
     * @return array
     */
    public static function toArray(string $string, string $encoding = 'UTF-8'): array
    {
        $strlen = mb_strlen($string);
        $array = [];
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, $encoding);
            $string = mb_substr($string, 1, $strlen, $encoding);
            $strlen = mb_strlen($string);
        }
        return $array;
    }
}
